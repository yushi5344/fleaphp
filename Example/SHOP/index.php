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
 * Shop 演示了一个简单的商品分类管理和商品管理程序
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: index.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * 尝试载入数据库配置文件，如果失败则显示错误页面
 */
$configFilename = '../_Shared/DSN.php';
if (!is_readable($configFilename)) {
    header('Location: ../../Install/setup-required.php');
}
define('SHARED_DIR', dirname(realpath($configFilename)));

// APP_DIR 常量指示模版的保存目录
define('APP_DIR', dirname(__FILE__));
// UPLOAD_DIR 常量用于指示保存上传文件的根目录
define('UPLOAD_DIR', realpath(APP_DIR . '/upload'));
// UPLOAD_ROOT 常量用于指示用什么 URL 路径访问上传目录
define('UPLOAD_ROOT', 'upload');

define('NO_LEGACY_FLEAPHP', true);
require('../../FLEA/FLEA.php');
FLEA::loadAppInf($configFilename);
FLEA::loadAppInf(APP_DIR . '/APP/Config/BO_APP_INF.php');
FLEA::import(APP_DIR . '/APP');
FLEA::runMVC();
