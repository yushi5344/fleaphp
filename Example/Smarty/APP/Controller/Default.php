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
 * @subpackage Smarty
 * @version $Id: Default.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * Controller_Default 类是 Smarty 示例的默认控制器
 *
 * @package Example
 * @subpackage Smarty
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_Default extends FLEA_Controller_Action
{
    /**
     * 默认控制器方法
     */
    function actionIndex() {
        $smarty =& $this->_getView();
        /* @var $smarty Smarty */
        $smarty->assign('my_var', 'The smarty template engine.');
        $smarty->display('tpl-index.html');
    }

    /**
     * 演示另一种使用 Smarty 的方法
     */
    function actionAlternative() {
        $viewData = array(
            'my_var' => 'The smarty template engine.',
        );
        $this->_executeView('tpl-alternative.html', $viewData);
    }
}
