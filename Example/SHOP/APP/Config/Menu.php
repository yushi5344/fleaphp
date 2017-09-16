<?php
/////////////////////////////////////////////////////////////////////////////
// FleaPHP Framework
//
// Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
//
// 许可协议，请查看源代码中附带的 LICENSE.txt 文件，
// 或者访问 http://www.fleaphp.org/ 获得详细信息。
/////////////////////////////////////////////////////////////////////////////

/**
 * 定义后台管理界面左侧的菜单
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: Menu.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

$catalog = array();

$menu = array();
$menu[] = array(_T('ui_w_menu_create_product'), 'BoProducts', 'create');
$menu[] = array(_T('ui_w_menu_list_product'), 'BoProducts');
$menu[] = array('<span style="color: red;">' . _T('ui_w_menu_list_classes') . '</span>', 'BoProductClasses');
$catalog[] = array(_T('ui_w_catalog_products'), $menu);

$menu = array();
$menu[] = array(_T('ui_u_change_password_menu'), 'BoPreference', 'changePassword');
$catalog[] = array(_T('ui_u_preference_catalog'), $menu);

return $catalog;
