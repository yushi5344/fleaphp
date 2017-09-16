<?php

FLEA::loadClass('FLEA_Db_TableDataGateway');

class Table_SysRolesGroup extends FLEA_Db_TableDataGateway
{
	var $tableName = 'sysroles_group';
	var $primaryKey = 'group_id';

	var $hasMany = array(
		array(
			'tableClass' => 'Table_SysRoles',
			'foreignKey' => 'group_id',
			'mappingName' => 'roles',
			'sort' => 'description ASC',
		)
	);
}
