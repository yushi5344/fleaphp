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
 * 定义 Model_Products 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: Products.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

/**
 * Model_Products 封装了对商品信息的所有操作
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Model_Products
{
    /**
     * 提供商品信息数据库访问服务的对象
     *
     * @var Table_Products
     */
    var $_tbProducts;

    /**
     * 构造函数
     *
     * @return Model_Products
     */
    function Model_Products() {
        $this->_tbProducts =& FLEA::getSingleton('Table_Products');
    }

    /**
     * 获取指定 ID 的产品信息
     *
     * @param int $productId
     * @param boolean $withAssoc 指示是否获取产品的关联信息（分类及照片）
     *
     * @return array
     */
    function getProduct($productId, $withAssoc = true) {
        $link =& $this->_tbProducts->getLink('classes');
        $link->enabled = $withAssoc;
        $link =& $this->_tbProducts->getLink('photos');
        $link->enabled = $withAssoc;

        return $this->_tbProducts->find((int)$productId);
    }

    /**
     * 保存产品信息
     *
     * @param array $product
     *
     * @return boolean
     */
    function saveProduct($product) {
        if (isset($product['product_id']) && (int)$product['product_id'] == 0) {
            unset($product['product_id']);
        }
        return $this->_tbProducts->save($product);
    }

    /**
     * 删除指定的产品信息
     *
     * @param int $productId
     *
     * @return boolean
     */
    function removeProduct($productId) {
        $productId = (int)$productId;
        $link =& $this->_tbProducts->getLink('classes');
        $link->enabled = true;
        $link =& $this->_tbProducts->getLink('photos');
        $link->enabled = true;

        $product = $this->_tbProducts->find($productId);
        if (!$product) {
            FLEA::loadClass('Exception_ProductNotFound');
            __THROW(new Exception_ProductNotFound($productId));
            return false;
        }

        $uploadDir = FLEA::getAppInf('uploadDir') . DS;
        if ($product['thumb_filename'] != '') {
            unlink($uploadDir . $product['thumb_filename']);
        }
        foreach ($product['photos'] as $photo) {
            unlink($uploadDir . $photo['photo_filename']);
        }
        return $this->_tbProducts->removeByPkv($productId);
    }

    /**
     * 设置指定产品的缩略图
     *
     * @param int $product
     * @param FLEA_Helper_UploadFile $file
     *
     * @return boolean
     */
    function uploadThumb($productId, & $file) {
        $productId = (int)$productId;
        $product = $this->getProduct($productId, false);
        if (!$product) {
            FLEA::loadClass('Exception_ProductNotFound');
            __THROW(new Exception_ProductNotFound($productId));
            return false;
        }

        // 将缩略图文件裁减为指定大小，并保存起来
        FLEA::loadClass('FLEA_Helper_Image');
        $image =& FLEA_Helper_Image::createFromFile($file->getTmpName(), $file->getExt());
        $image->crop(FLEA::getAppInf('thumbWidth'), FLEA::getAppInf('thumbHeight'));
        $filename = $productId . '-thumb-t' . time() . '.jpg';
        $image->saveAsJpeg(FLEA::getAppInf('uploadDir') . DS . $filename);
        $image->destory();

        // 更新数据库
        if ($product['thumb_filename'] != '') {
            unlink(FLEA::getAppInf('uploadDir') . DS . $product['thumb_filename']);
        }

        $product['thumb_filename'] = $filename;
        return $this->_tbProducts->update($product);
    }

    /**
     * 为指定产品添加一个大图片
     *
     * @param int $product
     * @param FLEA_Helper_UploadFile $file
     *
     * @return boolean
     */
    function uploadPhoto($productId, & $file) {
        $productId = (int)$productId;
        $product = $this->getProduct($productId, false);
        if (!$product) {
            FLEA::loadClass('Exception_ProductNotFound');
            __THROW(new Exception_ProductNotFound($productId));
            return false;
        }

        $filename = $productId . '-photo-t' . time() . '.jpg';
        $file->move(FLEA::getAppInf('uploadDir') . DS . $filename);
        $product['photos'] = array(
            array('product_id' => $productId, 'photo_filename' => $filename)
        );
        $link =& $this->_tbProducts->getLink('photos');
        $link->enabled = true;
        $link =& $this->_tbProducts->getLink('classes');
        $link->enabled = false;
        return $this->_tbProducts->update($product);
    }

    /**
     * 删除指定产品的一个大图片
     *
     * @param int $productId
     * @param int $photoId
     *
     * @return boolean
     */
    function removePhoto($productId, $photoId) {
        $productId = (int)$productId;
        $photoId = (int)$photoId;
        $tableProductPhotos =& FLEA::getSingleton('Table_ProductPhotos');
        /* @var $tableProductPhotos Table_ProductPhotos */
        $photo = $tableProductPhotos->find("product_id = {$productId} AND photo_id = {$photoId}");
        if (!$photo) { return false; }
        unlink(FLEA::getAppInf('uploadDir') . DS . $photo['photo_filename']);
        $tableProductPhotos->removeByPkv($photo[$tableProductPhotos->primaryKey]);

        return true;
    }

    /**
     * 返回 Table_Products 对象
     *
     * @return Table_Products
     */
    function & getTable() {
        return $this->_tbProducts;
    }
}
