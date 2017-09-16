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
 * 定义 Tags 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage Blog
 * @version $Id: Tags.php 1013 2007-11-09 01:34:54Z qeeyuan $
 */

// {{{ includes
/**
 * FleaPHP 不会默认载入 FLEA_Db_TableDataGateway 类的定义，
 * 因此需要明确载入。
 */
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Tags 类封装了对数据表 blog_posts 的操作
 *
 * @package Example
 * @subpackage Blog
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Table_Tags extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'tags';

    /**
     * 该数据表的主键字段名
     *
     * @var string
     */
    var $primaryKey = 'tag_id';

    var $manyToMany = array(
        array(
            'tableClass' => 'Table_Posts',
            'joinTable' => 'posts_has_tags',
            'mappingName' => 'posts',
        ),
    );

}
