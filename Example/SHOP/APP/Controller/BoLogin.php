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
 * 定义 Conroller_BoLogin 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: BoLogin.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * Controller_BoLogin 实现了用户登录和注销
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_BoLogin extends FLEA_Controller_Action
{
    /**
     * 构造函数
     *
     * @return Controller_BoLogin
     */
    function Controller_BoLogin() {
        load_language('ui');
    }

    /**
     * 显示登录界面
     */
    function actionIndex() {
    	$ui =& FLEA::initWebControls();
        require(APP_DIR . '/BoLoginIndex.php');
    }

    /**
     * 注销
     */
    function actionLogout() {
        session_destroy();
        $msg = _T('ui_l_logout');
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/BoLoginIndex.php');
    }

    /**
     * 登录
     */
    function actionLogin() {
        $imgcode =& FLEA::getSingleton('FLEA_Helper_ImgCode');
        /* @var $imgcode FLEA_Helper_ImgCode */
        do {
            if (!$imgcode->check($_POST['imgcode'])) {
                $msg = _T('ui_l_invalid_imgcode');
                break;
            }
            $imgcode->clear();

            /**
             * 验证用户名和密码是否正确
             */
            $sysusers =& FLEA::getSingleton('Model_SysUsers');
            /* @var $sysusers Model_SysUsers */
            $user = $sysusers->findByUsername($_POST['username']);
            if (!$user) {
                $msg = _T('ui_l_invalid_username');
                break;
            }

            if (!$sysusers->checkPassword($_POST['password'],
                $user[$sysusers->passwordField]))
            {
                $msg = _T('ui_l_invalid_password');
                break;
            }

            /**
             * 登录成功，通过 RBAC 保存用户信息和角色
             */
            $data = array();
            $data['USERNAME'] = $user[$sysusers->usernameField];
            $data['ID'] = $user[$sysusers->primaryKey];

            $rbac =& FLEA::getSingleton('FLEA_Rbac');
            /* @var $rbac FLEA_Rbac */
            $rbac->setUser($data, $sysusers->fetchRoles($user));

            // 保存用户选择的语言
            $_SESSION['LANG'] = $_POST['language'];

            // 重定向
            redirect(url('BoDashboard'));
        }
        while (false);

        // 登录发生错误，再次显示登录界面
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/BoLoginIndex.php');
    }

    /**
     * 显示验证码
     */
    function actionImgCode() {
        $imgcode =& FLEA::getSingleton('FLEA_Helper_ImgCode');
        /* @var $imgcode FLEA_Helper_ImgCode */
        $imgcode->image();
    }
}
