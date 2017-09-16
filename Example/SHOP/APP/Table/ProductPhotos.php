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
 * 定义 Table_ProductPhotos 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: ProductPhotos.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_ProductPhotos 提供商品照片的数据库访问服务
 *
 * @package package
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Table_ProductPhotos extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'product_photos';

    /**
     * 主键字段名
     *
     * @var string
     */
    var $primaryKey = 'photo_id';
}
