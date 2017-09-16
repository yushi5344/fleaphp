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
 * 定义 Comments 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage Blog
 * @version $Id: Comments.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Comments 类封装了对数据表 blog_comments 的操作
 *
 * @package Example
 * @subpackage Blog
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Table_Comments extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'comments';

    /**
     * 该数据表的主键字段名
     *
     * @var string
     */
    var $primaryKey = 'comment_id';

    var $belongsTo = array(
        array(
            'tableClass' => 'Table_Posts',
            'foreignKey' => 'post_id',
            'mappingName' => 'post',
    		'counterCache' => 'comments_count',
    		'fields' => array('post_id', 'title'),
        ),
    );


	/**
	 * _beforeCreate() 事件在创建记录时引发
	 *
	 * 我们在这个事件中调用 _processTags() 完成对 tags 的处理工作。
     *
     * @param array $row
     *
     * @return boolean
     */
	function _beforeCreate(& $row)
	{
        require_once APP_DIR . '/Helper/bbcode.php';
        $row['body'] = bbencode_all($row['body'], 'comment');
        return true;
	}
}
