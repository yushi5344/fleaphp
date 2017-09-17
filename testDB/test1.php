<?php
/**
 * Created by PhpStorm.
 * User: yushi
 * Date: 2017/9/17
 * Time: 8:47
 */
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
//从FLEA_Db_Table_dataGateway出posts类
class Posts extends FLEA_Db_TableDataGateway{
    //指定数据表名称
    var $tableName='posts';
    //指定主键字段名
    var $primaryKey='post_id';
}

//构造posts示例。
$modelPosts=&new Posts();
//创建一条新纪录
/*
$row=array(
    'title'=>'First Post',
    'body'=>'First Post body'
);
$newPosdId=$modelPosts->create($row);
//echo $newPosdId;

//读取记录
$_posta=$modelPosts->find($newPosdId);
dump($_posta);
//修改记录内容
$_posta['title']='new title';
$modelPosts->update($_posta);
//重新查询被修改后的记录
$updataedPost=$modelPosts->find($newPosdId);
//输出内容
dump($updataedPost);
*/
//删除记录
$posts=$modelPosts->findAll(array('title'=>'First Post'));
//dump($posts);
foreach($posts as $posda){
    //$modelPosts->remove($posda);
    //或者使用
    $modelPosts->removeByPkv($posda[$modelPosts->primaryKey]);
}