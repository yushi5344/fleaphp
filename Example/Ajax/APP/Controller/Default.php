<?php
/////////////////////////////////////////////////////////////////////////////
// FleaPHP Framework
//
// Copyright (c) 2005 - 2007 FleaPHP.org (www.fleaphp.org)
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
 * @subpackage Ajax
 * @version $Id: Default.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * Controller_Default 类是 Ajax 示例程序的默认控制器
 *
 * @package Example
 * @subpackage Ajax
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_Default extends FLEA_Controller_Action
{
    /**
     * 显示默认页面
     */
    function actionIndex()
    {
        $ajax =& FLEA::initAjax();
        $ui =& FLEA::initWebControls();

        /**
         * 为了避免 IE 的 bug，所以这里用 updateValue 属性来更新指定控件的 value。
         * 如果是更新 <div></div> 标签间的内容，用 update 属性即可。
         */
        $this->_registerEvent('#buttonTest1', 'click', 'OnTest1', array(
            'targetValue' => '#memoTest1Result',
            'data' => '#textboxTest1',
            'success' => 'function (data) { alert(data); }',
        ));

        $this->_registerEvent('#formTest2', 'submit', 'OnTest2', array(
            'params' => array('more_param' => 123, 'another_param' => 'Let\'s go'),
            'targetValue' => '#memoTest2Result',
            'clearTarget' => true,
            'success' => 'function (data) { alert(data); }',
        ));

        /**
         * 由于这个测试是更新 <div></div> 标签间的内容，所以用 update 属性即可
         *
         * onComplete 是一个模版中的 JS 函数，用于解析从服务器端返回的 JSON 字符串
         */
        $this->_registerEvent('#buttonTest3', 'click', 'OnTest3', array(
            'success' => 'onTest3Complete',
        ));

        /**
         * 准备显示数据，输出模版
         */
        $viewData = array(
            'ajax' => & $ajax,
            'ui' => & $ui,
        );
        $this->_executeView(TPL_DIR . '/tpl-index.php', $viewData);
    }

    /**
     * Test1
     */
    function actionOnTest1()
    {
        $username = $_POST['textboxTest1'];
        echo h("I see, {$username}.");
    }

    /**
     * Test2
     */
    function actionOnTest2()
    {
        echo "\$_POST:\n";
        print_r($_POST);
        echo "\$_GET:\n";
        print_r($_GET);
    }

    /**
     * Test3
     */
    function actionOnTest3()
    {
        $t = time();
        $arr = array(
            array('title' => '列表项目 1', 'created' => date('Y-m-d H:i:s', $t++)),
            array('title' => '列表项目 2', 'created' => date('Y-m-d H:i:s', $t++)),
            array('title' => '列表项目 3', 'created' => date('Y-m-d H:i:s', $t++)),
            array('title' => '列表项目 4', 'created' => date('Y-m-d H:i:s', $t++)),
            array('title' => '列表项目 5', 'created' => date('Y-m-d H:i:s', $t++)),
            array('title' => '列表项目 6', 'created' => date('Y-m-d H:i:s', $t++)),
        );

        FLEA::loadClass('FLEA_Ajax');
        echo json_encode($arr);
        exit;
    }
}
