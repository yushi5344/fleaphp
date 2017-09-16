<?php
/////////////////////////////////////////////////////////////////////////////
// 这个文件是 FleaPHP 项目的一部分
//
// Copyright (c) 2005 - 2006 FleaPHP.org (www.fleaphp.org)
//
// 要查看完整的版权信息和许可信息，请查看源代码中附带的 COPYRIGHT 文件，
// 或者访问 http://www.fleaphp.org/ 获得详细信息。
/////////////////////////////////////////////////////////////////////////////

/**
 * 定义 Table_Data 类
 *
 * @copyright Copyright (c) 2005 - 2006 FleaPHP.org (www.fleaphp.org)
 * @author 廖宇雷 dualface@gmail.com
 * @package Example
 * @subpackage Blog
 * @version $Id: Data.php 976 2007-10-10 06:09:05Z qeeyuan $
 */

// {{{ includes
/**
 * FleaPHP 不会默认载入 FLEA_Db_TableDataGateway 类的定义，
 * 因此需要明确载入。
 */
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_Data 类封装了对数据表 import_data 的操作
 *
 * @package Example
 * @subpackage Blog
 * @author 廖宇雷 dualface@gmail.com
 * @version 1.0
 */
class Table_Data extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名称
     *
     * 对于每一个从 FLEA_Db_TableDataGateway 派生的类，
     * tableName 和 primaryKey 成员变量都是必须定义的。
     *
     * @var string
     */
    var $tableName = 'data';

    /**
     * 该数据表的主键字段名
     *
     * @var string
     */
    var $primaryKey = 'id';
}
