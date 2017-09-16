<?php

FLEA::loadClass('FLEA_Db_TableDataGateway');

class Table_SysMenu extends FLEA_Db_TableDataGateway
{
	var $tableName = 'sysmenu';
	var $primaryKey = 'menu_id';
}
