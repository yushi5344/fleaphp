<?php
/*********************************************************************\
 *  Copyright (c) 1998-2013, TH. All Rights Reserved.
 *  Author :yushi
 *  FName  :test2.php
 *  Time   :2017/9/17  10:04
 *  Remark :
 * \*********************************************************************/

require ('../FLEA/FLEA.php');
//FLEA::init();
//准备数据库信息
$dsn=array(
    'driver'=>'mysql',
    'host'=>'localhost',
    'login'=>'root',
    'password'=>'root',
    'database'=>'test',
);
//获取数据库访问对象
//$dbo=&FLEA::getDBO($dsn);
//连接到数据库
//if($dbo->connect()){
//    echo '连接成功';
//}
//指定数据库连接设置，TableDATAGateway会自动取出dbDSN设置来连接数据库
set_app_inf('dbDSN',$dsn);
FLEA::init();

//由于FLEA_Db_TableDataGateway不是自动载入的，因此需要明确载入。
FLEA::loadClass('FLEA_Db_TableDataGateway');

class Users extends FLEA_Db_TableDataGateway{

    var $tableName='users';
    var $primaryKey='user_id';

    var $hasOne=array(
        'tableClass'=>'Profiles',
        'foreignKey'=>'user_id',
        'mappingName'=>'profile'
    );
}

class Profiles extends FLEA_Db_TableDataGateway{
    var $tableName='profiles';
    var $primaryKey='profile_id';

}
//插入一条user记录、

$modeluses=& new Users();
$row=array('username'=>'guomin');
$newuserid=$modeluses->create($row);




$modelprofiles=& new Profiles();
$row=array(
    'address'=>'sichuan zigong',
    'postcode'=>'654000',
    'user_id'=>$newuserid
);

$modelprofiles->create($row);

$user=$modeluses->find($newuserid);
dump($user);