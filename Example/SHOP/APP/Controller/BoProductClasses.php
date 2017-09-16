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
 * 定义 Controller_BoProductClasses 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: BoProductClasses.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('Controller_BoBase');
// }}}

/**
 * Controller_BoProductClasses 提供了操作商品分类的后台界面功能
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_BoProductClasses extends Controller_BoBase
{
    /**
     * 操作分类的对象
     *
     * @var Model_ProductClasses
     */
    var $_modelClasses;

    /**
     * 构造函数
     *
     * @return Controller_BoProductClasses
     */
    function Controller_BoProductClasses() {
        parent::Controller_BoBase();
        $this->_modelClasses =& FLEA::getSingleton('Model_ProductClasses');
    }

    /**
     * 显示分类列表
     */
    function actionIndex() {
        /**
         * 读取指定父分类下的直接子分类
         */
        $parentId = isset($_GET['parent_id']) ? (int)$_GET['parent_id'] : 0;
        if ($parentId) {
            $parent = $this->_modelClasses->getClass($parentId);
            if (!$parent) {
                js_alert(sprintf(_T('ui_c_invalid_parent_id'), $parentId),
                    '', $this->_url());
            }
            $subClasses = $this->_modelClasses->getSubClasses($parent);

            /**
             * 确定当前分类到顶级分类的完整路径
             */
            $path = $this->_modelClasses->getPath($parent);
            $path[] = $parent;
        } else {
            $parent = null;
            $path = null;
            $subClasses = $this->_modelClasses->getAllTopClasses();
        }

        foreach ($subClasses as $offset => $class) {
            $subClasses[$offset]['child_count'] = $this->_modelClasses->calcAllChildCount($class);
        }

        $this->_setBack();
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/BoProductClassesIndex.php');
    }

    /**
     * 创建新分类
     */
    function actionCreate() {
        $class = array(
            'class_id'  => null,
            'name'      => null,
            'parent_id' => isset($_GET['parent_id']) ? (int)$_GET['parent_id'] : 0,
        );
        $this->_editClass($class);
    }

    /**
     * 修改分类
     */
    function actionEdit() {
        $class = $this->_modelClasses->getClass((int)$_GET['class_id']);
        if (!$class) {
            js_alert(sprintf(_T('ui_c_invalid_class_id'), $_GET['class_id']),
                '', $this->_getBack());
        }
        $this->_editClass($class);
    }

    /**
     * 显示添加或修改分类信息页面
     *
     * @param array $class
     */
    function _editClass($class) {
        $parentId = $class['parent_id'];
        if ($parentId) {
            $parent = $this->_modelClasses->getClass($parentId);
            if (!$parent) {
                js_alert(sprintf(_T('ui_c_invalid_parent_id'), $parentId),
                    '', $this->_url());
            }

            /**
             * 确定当前分类到顶级分类的完整路径
             */
            $path = $this->_modelClasses->getPath($parent);
            $path[] = $parent;
        } else {
            $parent = array(
                'class_id' => 0,
                'name' => _T('ui_c_new_top_class'),
            );
            $path = array($parent);
        }
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/BoProductClassesEdit.php');
    }

    /**
     * 保存分类信息到数据库
     */
    function actionSave() {
        $class = array(
            'name' => $_POST['name'],
        );

        __TRY();
        if ($_POST['class_id']) {
            // 更新分类
            $class['class_id'] = $_POST['class_id'];
            $this->_modelClasses->updateClass($class);
        } else {
            // 创建分类
            $this->_modelClasses->createClass($class, $_POST['parent_id']);
        }

        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            js_alert($ex->getMessage(), '', $this->_getBack());
        }
        $this->_goBack();
    }

    /**
     * 删除分类
     */
    function actionRemove() {
        __TRY();
        $this->_modelClasses->removeClassById($_GET['class_id']);
        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            js_alert($ex->getMessage(), '', $this->_getBack());
        }
        $this->_goBack();
    }
}
