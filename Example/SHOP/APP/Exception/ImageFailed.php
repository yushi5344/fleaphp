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
 * 定义 Exception_ImageFailed 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: ImageFailed.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * Exception_ImageFailed 指示图像操作失败
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Exception_ImageFailed extends FLEA_Exception
{
    var $operation;

    function Exception_ImageFailed($operation) {
        $this->operation = $operation;
        parent::FLEA_Exception(sprintf(_T('ex_image_failed'), $operation));
    }
}
