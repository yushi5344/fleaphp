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
 * 定义 Exception_ProductNotFound 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: ProductNotFound.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * Exception_ProductNotFound 指示产品不存在
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Exception_ProductNotFound extends FLEA_Exception
{
    var $productId;

    function Exception_ProductNotFound($productId) {
        $this->nodeId = $productId;
        parent::FLEA_Exception(sprintf(_T('ex_product_not_found'), $productId));
    }
}
