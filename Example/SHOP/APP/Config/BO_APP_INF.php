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
 * 定义应用程序设置
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: BO_APP_INF.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

return array(
    /**
     * 应用程序标题
     */
    'appTitle' => 'FleaPHP Example SHOP',

    /**
     * 指定默认控制器
     */
    'defaultController' => 'BoLogin',

    /**
     * 指定要使用的调度器
     */
    'dispatcher' => 'FLEA_Dispatcher_Auth',

    /**
     * 指示 RBAC 组件用什么键名在 session 中保存用户数据
     */
    'RBACSessionKey' => 'Example.SHOP',

    /**
     * 指定该应用程序使用的数据表的前缀
     */
    'dbTablePrefix' => 'shop_',

    /**
     * 启用多语言支持
     */
    'multiLanguageSupport' => true,

    /**
     * 指定语言文件所在目录
     */
    'languageFilesDir' => realpath(dirname(__FILE__) . '/../Languages'),

    /**
     * 指示可用的语言
     */
    'languages' => array(
        '简体中文' => 'chinese-utf8',
        '繁体中文' => 'chinese-utf8-tw',
    ),

    /**
     * 指示默认语言
     */
    'defaultLanguage' => 'chinese-utf8',

    /**
     * 上传目录和 URL 访问路径
     */
    'uploadDir' => UPLOAD_DIR,
    'uploadRoot' => UPLOAD_ROOT,

    /**
     * 缩略图的大小、可用扩展名
     */
    'thumbWidth' => 166,
    'thumbHeight' => 166,
    'thumbFileExts' => 'gif,png,jpg,jpeg',

    /**
     * 商品大图片的最大文件尺寸和可用扩展名
     */
    'photoMaxFilesize' => 1000 * 1024,
    'photoFileExts' => 'gif,png,jpg,jpeg',

    /**
     * 使用默认的控制器 ACT 文件
     *
     * 这样可以避免为每一个控制器都编写 ACT 文件
     */
    'defaultControllerACTFile' => dirname(__FILE__) . DS . 'DefaultACT.php',

    /**
     * 必须设置该选项为 true，才能启用默认的控制器 ACT 文件
     */
    'autoQueryDefaultACTFile' => true,
	'internalCacheDir' => SHARED_DIR . DS . '_Cache',
);
