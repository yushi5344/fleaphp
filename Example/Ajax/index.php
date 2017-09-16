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
 * Blog 演示了如何创建一个简单的 Blog 程序
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage Blog
 * @version $Id: index.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

define('APP_DIR', dirname(__FILE__) . '/APP');
define('TPL_DIR', dirname(__FILE__) . '/templates');
define('NO_LEGACY_FLEAPHP', true);
require('../../FLEA/FLEA.php');
FLEA::import(APP_DIR);
FLEA::runMVC();
