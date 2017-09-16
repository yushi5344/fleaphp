<?php

FLEA::loadClass('FLEA_Db_TableDataGateway');

class Table_Photos extends FLEA_Db_TableDataGateway
{
    var $tableName = 'photos';
    var $primaryKey = 'photo_id';
}
