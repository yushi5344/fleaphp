<?php

FLEA::loadClass('FLEA_Controller_Action');

class Controller_Default extends FLEA_Controller_Action
{
	function actionIndex()
	{
	    $roles = $this->_dispatcher->getUserRoles();
	    if (empty($roles)) {
	        // 初始时，让用户具有 ROOT 角色
	        $user = array('user_id' => 1, 'username' => 'dualface');
	        $this->_dispatcher->setUser($user, array('ROOT'));
	    }

	    /**
	     * 获得当前用户角色
	     */
	    $currentRoles = $this->_dispatcher->getUserRoles();

	    $tableSysRolesGroup =& FLEA::getSingleton('Table_SysRolesGroup');
	    /* @var $tableSysRolesGroups Table_SysRolesGroup */

	    $viewdata = array(
	       'groups' => $tableSysRolesGroup->findAll(null, 'group_id ASC'),
	       'requestUri' => isset($_GET['requestUri']) ? $_GET['requestUri'] : null,
	       'currentRoles' => $currentRoles,
	       'currentRolesText' => implode(', ', $currentRoles),
	    );

		$this->_executeView('default_index.html', $viewdata);
	}

	function actionUpdateRoles()
	{
	    $tableSysRoles =& FLEA::getSingleton('Table_SysRoles');
	    /* @var $tableSysRoles Table_SysRoles */

	    /**
	     * 从数据库查询角色信息
	     *
	     * 在实际应用程序中，由于角色信息是和用户关联的。
	     * 所以还要更新用户和角色的关联关系。
	     */
	    $selected = (array)$_POST['roles'];
	    $roles = array();
	    foreach ($selected as $roleid) {
	        $role = $tableSysRoles->find((int)$roleid);
	        $roles[] = $role['rolename'];
	    }

	    /**
	     * 更新用户角色
	     */
	    $user = array('user_id' => 1, 'username' => 'dualface');
	    $this->_dispatcher->setUser($user, $roles);

	    redirect(url());
	}
}
