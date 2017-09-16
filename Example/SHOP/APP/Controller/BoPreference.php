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
 * 定义 Controller_BoPreference 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: BoPreference.php 1014 2007-11-17 06:13:14Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('Controller_BoBase');
// }}}

/**
 * 实现个人首选项的设置
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Controller_BoPreference extends Controller_BoBase
{
    /**
     * 显示修改页面
     */
    function actionChangePassword() {
        $rbac =& FLEA::getSingleton('FLEA_Rbac');
        /* @var $rbac FLEA_Rbac */
        $user = $rbac->getUser();
        include(APP_DIR . '/BoPreferenceChangePassword.php');
    }

    /**
     * 更新密码
     */
    function actionUpdatePassword() {
        $sysusersTDG =& FLEA::getSingleton('Model_SysUsers');
        /* @var $sysusersTDG Model_SysUsers */
        $dispatcher =& $this->_getDispatcher();
        /* @var $dispatcher FLEA_Dispatcher_Auth */
        $user = $dispatcher->getUser();

        // 检查现在输入的用户名是否正确
        $username = $user['USERNAME'];
        if (!$sysusersTDG->validateUser($username, $_POST['old_password'])) {
            js_alert(_T('ui_u_enter_current_password_tip'), '',
                    $this->_url('changePassword'));
        }

        // 检查两次输入的新密码是否一致
        if ($_POST['new_password'] != $_POST['new_password2']) {
            js_alert(_T('ui_u_enter_new_password_not_match'), '',
                    $this->_url('changePassword'));
        }

        if ($_POST['new_password'] == '') {
            js_alert(_T('ui_u_enter_new_password_tip'), '',
                    $this->_url('changePassword'));
        }

        // 更新密码
        // $sysusersTDG->changePassword($username, $_POST['old_password'], $_POST['new_password']);

        js_alert(_T('ui_u_change_password_successed'), '', url('BoDashboard', 'welcome'));
    }
}
