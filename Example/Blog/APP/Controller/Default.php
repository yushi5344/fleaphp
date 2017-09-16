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
 * 定义 Controller_Default 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage Blog
 * @version $Id: Default.php 1013 2007-11-09 01:34:54Z qeeyuan $
 */

/**
 * Controller_Default 类是 Blog 示例的默认控制器
 *
 * @package Example
 * @subpackage Blog
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_Default extends FLEA_Controller_Action
{
    /**
     * 显示所有日志
     */
    function actionIndex()
    {
        $tagid = isset($_GET['tag_id']) ? (int)$_GET['tag_id'] : null;

        /**
         * 读取所有日志
         */
        $tablePosts = FLEA::getSingleton('Table_Posts');
        /* @var $tablePosts Table_Posts */
        // 禁用评论的关联
        $tablePosts->disableLink('comments');

        $viewdata = array();

        if ($tagid) {
            $tableTags = FLEA::getSingleton('Table_Tags');
            /* @var $tableTags Table_Tags */
            $viewdata['current_tag'] = $tableTags->find($tagid);
            $conditions = array('tags.tag_id' => $tagid);
        } else {
            $conditions = null;
        }

        $viewdata['posts'] = $tablePosts->findAll($conditions, 'created DESC');
        $this->_executeView(TPL_DIR . '/default_index.php', $viewdata);
    }

    /**
     * 查看日志及评论
     */
    function actionView()
    {
        $tablePosts = FLEA::getSingleton('Table_Posts');
        /* @var $tablePosts Table_Posts */
        $post = $tablePosts->find((int)$_GET['post_id']);
        if (!$post) { redirect($this->_url()); }
        
        $tableTags =& $tablePosts->getLinkTable('tags');
        $link =& $tableTags->getLink('posts');
        $link->fields = array('post_id', 'title', 'created');
        $link->limit = 10;
        $tablePosts->assembleRecursionRow('tags', $post);
        $this->_executeView(TPL_DIR . '/default_view.php', array('post' => & $post));
    }

    /**
     * 添加日志评论
     */
    function actionSubmitComment()
    {
        /**
         * 由于有可能存在恶意提交数据的情况，所以这里我们将有效的数据复制到另一个数组中
         */
        $row = array(
            'post_id' => (int)$_POST['post_id'],
            'body'    => strip_tags($_POST['body']),
        );
        $tableComments =& FLEA::getSingleton('Table_Comments');
        /* @var $tableComments Table_Comments */
        $tableComments->create($row);
        redirect($this->_url('view', array('post_id' => $row['post_id'])));
    }

    /**
     * 显示创建日志或修改日志的表单
     */
    function actionEdit() {
        $tablePosts = FLEA::getSingleton('Table_Posts');
        /* @var $tablePosts Table_Posts */
        if (isset($_GET['post_id'])) {
            $post = $tablePosts->find((int)$_GET['post_id']);
        }
        if (empty($post)) {
            $post = array('post_id' => null, 'title' => '', 'body' => '', 'tags' => array());
        }
        /**
         * FLEA::initWebControls() 初始化 WebControls 机制，并且返回一个 UI 对象。
         * 利用该对象的 control() 方法，可以创建各种各样的页面控件。
         */
        $this->_executeView(TPL_DIR . '/default_edit.php', array('post' => $post, 'ui' => FLEA::initWebControls()));
    }


    /**
     * 根据用户提交的数据，创建新日志条目或更新已有的日志条目
     */
    function actionSubmitPost() {
        /**
         * 创建和更新记录就这么简单？
         *
         * 是的，因为对 tags 进行处理的代码，我们封装在 Table_Posts 类中。
         *
         * 在 MVC 模式里面，控制器不应该包含任何“业务逻辑”代码。因此像
         * 处理 tags 这样的工作，需要交给模型（Model）去做。
         */
        $row = array(
            'post_id' => !empty($_POST['post_id']) ? (int)$_POST['post_id'] : null,
            'title'   => strip_tags($_POST['title']),
            'body'    => strip_tags($_POST['body']),
            'tags'    => strip_tags($_POST['tags']),
        );
        $tablePosts = FLEA::getSingleton('Table_Posts');
        /* @var $tablePosts Table_Posts */
        $tablePosts->save($row);

        /**
         * 添加完成，重定向浏览器
         */
        if (!empty($row['post_id'])) {
            redirect($this->_url('view', array('post_id' => $row['post_id'])));
        } else {
            redirect($this->_url());
        }
    }

    /**
     * 删除日志
     */
    function actionDelete() {
        $tablePosts = FLEA::getSingleton('Table_Posts');
        /* @var $tablePosts Table_Posts */
        $tablePosts->removeByPkv((int)$_GET['post_id']);
        redirect($this->_url());
    }

    /**
     * 删除评论
     */
    function actionDeleteComment()
    {
        $tableComments = FLEA::getSingleton('Table_Comments');
        /* @var $tableComments Table_Comments */
        $comment = $tableComments->find((int)$_GET['comment_id']);
        $tableComments->remove($comment);
        redirect($this->_url('view', array('post_id' => $comment['post']['post_id'])));
    }

    /**
     * 覆盖显示模板的方法，以便处理每个页面都需要的显示内容
     *
     * @param string $tplname
     * @param array $viewdata
     */
    function _executeView($tplname, $viewdata = null)
    {
        if (!is_array($viewdata)) { $viewdata = array(); }

        /**
         * 读取所有 Tags
         */
        $tableTags = FLEA::getSingleton('Table_Tags');
        /* @var $tableTags Table_Tags */
        $viewdata['tags'] = $tableTags->findAll(null, 'label ASC');

        /**
         * 读取最近 5 条评论
         */
        $tableComments = FLEA::getSingleton('Table_Comments');
        /* @var $tableComments Table_Comments */
        $viewdata['comments'] = $tableComments->findAll(null, 'created DESC', 5);

        return parent::_executeView($tplname, $viewdata);
    }

    /**
     * 用 BBCode 格式化输出内容
     *
     * @param string $body
     *
     * @return string
     */
    function _formatPost($body)
    {
        require_once APP_DIR . '/Helper/bbcode.php';
        return bbencode_all($body, 'post');
    }

}
