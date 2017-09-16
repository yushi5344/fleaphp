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
 * Smarty 演示了如何在 FleaPHP 应用程序中使用 Smarty 模版引擎
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage Smarty
 * @version $Id: index.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

$dirname = dirname(__FILE__);
define('APP_DIR', $dirname . '/APP');
define('NO_LEGACY_FLEAPHP', true);
require('../../FLEA/FLEA.php');

/**
 * 要使用 Smarty，必须做两项准备工作
 *
 * 1、设置应用程序的 view 选项为 FLEA_View_Smarty；
 * 2、设置应用程序的 viewConfig 选项为数组，数组中必须包含
 *    smartyDir 选项，指示 Smarty 模版引擎源代码所在目录。
 *
 * 如果需要在构造 FLEA_View_Smarty 时就初始化 Smarty 模版引擎的设置，
 * 直接放置在 viewConfig 选项数组中即可。
 */
$appInf = array(
    'view' => 'FLEA_View_Smarty',
    'viewConfig' => array(
        'smartyDir'         => realpath($dirname . '/../../Stuff/Smarty'),
        'template_dir'      => $dirname . '/templates',
        'compile_dir'       => $dirname . '/templates_c',
        'left_delimiter'    => '{{',
        'right_delimiter'   => '}}',
    ),
);

FLEA::loadAppInf($appInf);
FLEA::import(APP_DIR);
FLEA::runMVC();
