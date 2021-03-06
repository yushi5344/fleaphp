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
 * Album 演示了如如何创建一个在线相册
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技
 * @package Example
 * @subpackage Album
 * @version $Id: index.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * 尝试载入数据库配置文件，如果失败则显示错误页面
 */
$configFilename = '../_Shared/DSN.php';
if (!is_readable($configFilename)) {
    header('Location: ../../Install/setup-required.php');
}

/**
 * 载入 FleaPHP，并作初始化
 */
define('NO_LEGACY_FLEAPHP', true);
require('../../FLEA/FLEA.php');

/**
 * 指定实际代码的路径，FleaPHP 之所以能自动找到 Controller 目录和 Model 目录下的类，
 * 全靠这里指定路径。
 */
FLEA::import(dirname(__FILE__) . '/APP');

/**
 * 指定数据库连接设置，TableDataGateway 会自动取出 dbDSN 设置来连接数据库。
 * FLEA::loadAppInf() 会用开发者指定的应用程序设置覆盖 FleaPHP 提供的默认设置。
 * 开发者可以使用 FLEA::getAppInf() 取出任意应用程序设置。
 */
FLEA::loadAppInf($configFilename);

/**
 * 指定更多的应用程序选项
 */
$dirname = dirname(__FILE__);
$appInf = array(
    // 指示总是使用全小写的控制器名和动作名
    'urlLowerChar' => true,
    // 指定该应用程序使用的数据表的前缀
    'dbTablePrefix' => 'album_',
    // 指定使用 Smarty 模板引擎
    'view' => 'FLEA_View_Smarty',
    'viewConfig' => array(
        'smartyDir'         => realpath($dirname . '/../../Stuff/Smarty'),
        'template_dir'      => $dirname . '/templates',
        'compile_dir'       => $dirname . '/templates_c',
        'left_delimiter'    => '{{',
        'right_delimiter'   => '}}',
    ),
    // 指示保存上传文件的路径
    'uploadDir' => realpath($dirname . '/upload'),
);
FLEA::loadAppInf($appInf);

/**
 * FLEA::runMVC() 根据 URL 地址实例化指定的 Controller 类，调用指定的 Action 方法
 */
FLEA::runMVC();
