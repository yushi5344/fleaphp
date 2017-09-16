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
 * 定义 Table_Products 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: Products.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_Products 提供商品信息的数据库访问服务
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Table_Products extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'products';

    /**
     * 主键字段
     *
     * @var string
     */
    var $primaryKey = 'product_id';

    /**
     * 商品属于商品类别
     *
     * @var array
     */
    var $manyToMany = array(
        'tableClass' => 'Table_ProductClasses',
        'mappingName' => 'classes',
        'joinTable' => 'products_to_classes',
    );

    /**
     * 商品有多张（0-n）照片
     *
     * @var array
     */
    var $hasMany = array(
        'tableClass' => 'Table_ProductPhotos',
        'mappingName' => 'photos',
    );
}
