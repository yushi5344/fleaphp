<?php

FLEA::loadClass('FLEA_Rbac_RolesManager');

class Table_SysRoles extends FLEA_Rbac_RolesManager
{
	var $tableName = 'sysroles';
	var $primaryKey = 'role_id';
}
