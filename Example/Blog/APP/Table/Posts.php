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
 * 定义 Table_Posts 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage Blog
 * @version $Id: Posts.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
/**
 * FleaPHP 不会默认载入 FLEA_Db_TableDataGateway 类的定义，
 * 因此需要明确载入。
 */
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_Posts 类封装了对数据表 blog_posts 的操作
 *
 * @package Example
 * @subpackage Blog
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Table_Posts extends FLEA_Db_TableDataGateway
{
    /**
     * 数据表名称
     *
     * 对于每一个从 FLEA_Db_TableDataGateway 派生的类，
     * tableName 和 primaryKey 成员变量都是必须定义的。
     *
     * @var string
     */
    var $tableName = 'posts';

    /**
     * 该数据表的主键字段名
     *
     * @var string
     */
    var $primaryKey = 'post_id';

    /**
     * 定义多对多关联（MANY_TO_MANY）
     *
     * 关于多对多关联的详细信息，请参考文档和 FLEA_Db_TableDataGateway 中的相关注释。
     *
     * @var array
     */
    var $manyToMany = array(
        'tableClass' => 'Table_Tags',
        'mappingName' => 'tags',
        'joinTable' => 'posts_has_tags',
        'counterCache' => 'tags_count',
    );

	/**
	 * 定义一对多关联（HAS_MANY）
	 *
	 * @var array
	 */
	var $hasMany = array(
		'tableClass' => 'Table_Comments',
		'mappingName' => 'comments',
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
	    return $this->_processTags($row);
	}

	/**
	 * _beforeUpdate() 事件在更新记录时引发
     *
     * @param array $row
     *
     * @return boolean
     */
	function _beforeUpdate(& $row)
	{
	    return $this->_processTags($row);
	}

    /**
     * 完成对日志条目所关联的 tags 的处理
     *
     * @param array $row
     *
     * @return boolean
     */
    function _processTags(& $row) {
        // 读出数据库现有的所有 tags
        $tableTags =& FLEA::getSingleton('Table_Tags');
        /* @var $tableTags Table_Tags */
        $rowset = $tableTags->findAll(null);

        /**
         * 将记录集转换为名值对
         */
        FLEA::loadHelper('array');
        $existsTags = array_to_hashmap($rowset, 'label');

        // 处理用户输入的 tags
        $labels = explode(' ', $row['tags']);
        array_remove_empty($labels);

        $tags = array();
        foreach ($labels as $label) {
            $label = strtolower($label);
            if (isset($existsTags[$label])) {
                // 将日志登记到现有 tag
                $tags[] = $existsTags[$label];
            } else {
                // 创建新 tag，并登记日志
                $tags[] = array('label' => $label);
            }
        }

        $row['tags'] = $tags;
        return true;
    }
}
