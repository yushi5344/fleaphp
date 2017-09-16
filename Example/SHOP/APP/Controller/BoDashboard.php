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
 * 定义 Controller_BoDashboard 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: BoDashboard.php 1121 2008-06-06 07:02:18Z dualface $
 */

// {{{ includes
FLEA::loadClass('Controller_BoBase');
// }}}

/**
 * 实现后台界面的显示
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_BoDashboard extends Controller_BoBase
{
    /**
     * 显示 frames 页面
     */
    function actionIndex() {
        include(APP_DIR . '/BoDashboardIndex.php');
    }

    /**
     * 显示顶部导航栏
     */
    function actionTopNav() {
        $dispatcher =& $this->_getDispatcher();
        $user = $dispatcher->getUser();
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/BoDashboardTopnav.php');
    }

    /**
     * 显示左侧菜单
     */
    function actionSidebar() {
        // 首先定义菜单
        $catalog = FLEA::loadFile('Config_Menu.php');
        // 借助 FLEA_Dispatcher_Auth 对用户角色和控制器 ACT 进行验证
        $dispatcher =& $this->_getDispatcher();
        include(APP_DIR . '/BoDashboardSidebar.php');
    }

    /**
     * 显示欢迎信息
     */
    function actionWelcome() {
        $dispatcher =& FLEA::getSingleton(FLEA::getAppInf('dispatcher'));
        /* @var $dispatcher FLEA_Dispatcher_Auth */
        if ($dispatcher->check('BoDashboard', 'phpinfo') &&
            function_exists('phpinfo'))
        {
            $enablePhpinfo = true;
        } else {
            $enablePhpinfo = false;
        }
        include(APP_DIR . '/BoDashboardWelcome.php');
    }

    /**
     * 显示系统信息
     */
    function actionPhpInfo() {
    	echo '在线演示，屏蔽了 phpinfo';
        // phpinfo();
    }

    /**
     * 设置当前界面语言
     */
    function actionChangeLang() {
        $_SESSION['LANG'] = $_GET['lang'];
        redirect($this->_url());
    }
}
