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
 * MVC-Blog 演示了一个使用 FleaPHP 提供的 MVC 模式实现的简单 Blog
 *
 * 该示例程序由网友“小路”贡献，参照 CakePHP 同等示例程序实现。
 * 小路同时在 PHPChina（http://www.phpchina.com/）上发布了该示例程序的 Zend Framework 版本。
 *
 * ZF 版本地址：http://www.phpchina.com/bbs/thread-5820-1-1.html
 *
 * 不过为了充分体现 FleaPHP 的简洁，这个示例程序和 ZF 版的同等程序有一个主要的不同之处：
 *
 * - FleaPHP 版的示例程序只有两个控制器，其中默认的控制器不做实际工作，
 *   仅仅是重定向浏览器到 Post 控制器；
 * - Blog 的列表、查看、删除和添加等操作，都由 Post 控制器完成。
 *   而在 ZF 版的示例程序中，这些操作由多个控制器完成。
 *
 * 通过这个示例程序，开发者可以了解如何使用 FleaPHP 的 MVC 模式。
 * 同时，通过和同等功能的 ZF 版示例程序比较，就能发现 FleaPHP 版的示例程序不但代码更少，
 * 而且结构更清晰易懂。特别是涉及到 Blog 的常见数据库操作只需要一两行代码即可完成。
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 网友“小路”
 * @package Example
 * @subpackage MVC-Blog
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
 * 首先引入 FleaPHP 的库文件，并会做一些基本的处理
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
$appInf = array(
    // 指定该应用程序使用的数据表的前缀
    'dbTablePrefix' => 'mvcblog_',
);
FLEA::loadAppInf($appInf);

/**
 * FLEA::runMVC() 根据 URL 地址实例化指定的 Controller 类，调用指定的 Action 方法
 */
FLEA::runMVC();
