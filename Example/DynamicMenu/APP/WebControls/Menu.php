<?php

function _ctlMenu($name, $attribs)
{
	$cacheId = 'WebControl.DynamicMenu.' . $name;
	if (defined('DEPLOY_MODE') && DEPLOY_MODE) {
	    $lifetime = 900;
	} else {
	    $lifetime = 0;
	}
	$rowset = FLEA::getCache($cacheId, $lifetime);
	if (!$rowset) {
		$tableSysMenu =& FLEA::getSingleton('Table_SysMenu');
		/* @var $tableSysMenu Table_SysMenu */
		$rowset = $tableSysMenu->findAll(null, 'parent_id ASC, order_pos ASC');
		FLEA::writeCache($cacheId, $rowset);
	}

	/**
	 * 首先用 RBAC 过滤不能访问的菜单项
	 */
	$dispatcher =& FLEA::getSingleton(FLEA::getAppInf('dispatcher'));
	/* @var $dispatcher FLEA_Dispatcher_Auth */
	foreach ($rowset as $offset => $row) {
		if ($row['controller'] == '') { continue; }
		if (!$dispatcher->check($row['controller'], $row['action'])) {
			unset($rowset[$offset]);
		} else {
			$args = array();
			parse_str($row['args'], $args);
			$rowset[$offset]['url'] = url($row['controller'], $row['action'], $args);
		}
	}

	/**
	 * 转换为树形结构
	 */
	FLEA::loadHelper('array');
	$menu = array_to_tree($rowset, 'menu_id', 'parent_id', 'submenu');

	/**
	 * 缓存菜单
	 */
	$mainMenu =& new Helper_Menu($menu);

	$output = "var {$name} = ";
	$output .= $mainMenu->returnJsArray(true);
	$output .= ";\n";

	echo <<<EOT

<div id="mainMenuBar"></div>

<link href="scripts/ThemeOffice/theme.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="scripts/JSCookMenu.js"></script>
<script language="javascript" type="text/javascript" src="scripts/ThemeOffice/theme.js"></script>

<script language="javascript" type="text/javascript">
{{$output}}

cmDraw ('mainMenuBar', myMenu, 'hbr', cmThemeOffice);
</script>

EOT;

}


class Helper_Menu
{
	var $_menu = array();

	var $_refs = array();

	function Helper_Menu($menu = null)
	{
	    $this->_removeEmptyMenu($menu);
		if (is_array($menu)) {
			$this->_menu = $menu;
		}
	}

	function addMenu($menu, $parent = null)
	{
		static $menuid = 0;
		if (!is_array($menu)) { return false; }

		$menuid++;
		$menu['id'] = $menuid;

		if (isset($parent) && is_array($parent)) {
			if (!isset($parent['id'])) { return false; }
			$id = $parent['id'];
			if (!isset($this->_refs[$id])) { return false; }
			$parent =& $this->_refs[$id];
			if (!isset($parent['submenu']) || !is_array($parent['submenu'])) {
				$parent['submenu'] = array();
			}
			$parent['submenu'][$menuid] = $menu;
			$this->_refs[$menuid] =& $parent['submenu'][$menuid];

			return $menu;
		}

		$this->_menu[$menuid] = $menu;
		$this->_refs[$menuid] =& $this->_menu[$menuid];
		return $menu;
	}

	function getAllMenu()
	{
		return $this->_menu;
	}

	function returnJsArray($format = false)
	{
		return "[\n" . $this->_dumpJsArray($this->_menu, 1, $format) . "\n]";
	}

	function _dumpJsArray(& $menus, $level = 1, $format = false)
	{
		$out = '';
		$prefix = ($format) ? str_repeat('    ', $level) : '';
		foreach ($menus as $menu) {
			if (isset($menu['split']) && $menu['split'] != false) {
				$out .= $prefix . '_cmSplit';
			} else {
				$out .= $prefix . '[';
				if (isset($menu['icon'])) {
					$out .= '\'' . addslashes($menu['icon']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['title'])) {
					$out .= '\'' . addslashes($menu['title']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['url'])) {
					$out .= '\'' . addslashes($menu['url']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['target'])) {
					$out .= '\'' . addslashes($menu['target']) . '\', ';
				} else {
					$out .= 'null, ';
				}
				if (isset($menu['description'])) {
					$out .= '\'' . addslashes($menu['description']) . '\'';
				} else {
					$out .= 'null';
				}
				if (isset($menu['submenu']) && is_array($menu['submenu'])) {
					$out .= ",\n";
					$out .= $this->_dumpJsArray($menu['submenu'], $level + 1, $format);
					$out .= "\n{$prefix}";
				}
				$out .= ']';
			}
			$out .= ",\n";
		}
		return substr($out, 0, -2);
	}

    function _removeEmptyMenu(& $menus)
    {
    	$count = 0;
    	$keys = array_keys($menus);
    	foreach ($keys as $offset => $key) {
    	    $cur =& $menus[$key];
    	    if (isset($keys[$offset + 1])) {
    	        $next = $menus[$keys[$offset + 1]];
    	    } else {
    	        $next = null;
    	    }
    	    if ((is_null($next) || $next['split']) && $cur['split']) {
    	        /**
    	         * 如果当前菜单项是分隔符，而下一个菜单项也是分隔符或已经没有下一个菜单项则删除当前菜单项
    	         */
    	        unset($menus[$key]);
    	        continue;
    	    }

    		if (isset($cur['submenu']) && is_array($cur['submenu'])) {
    		    /**
    		     * 处理子菜单
    		     */
    			if ($this->_removeEmptyMenu($cur['submenu']) == 0) {
    			    /**
    			     * 如果没有子菜单项，则删除当前菜单项
    			     */
    				unset($menus[$key]);
    			}
    		} else {
    			if ($cur['split'] == false) {
    				if (!isset($cur['url']) || $cur['title'] == '') {
    					unset($menus[$key]);
    				} else {
    					$count++;
    				}
    			}
    		}
    	}
    	return $count;
    }
}
