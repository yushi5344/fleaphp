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
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 网友“小路”
 * @package Example
 * @subpackage MVC-Blog
 * @version $Id: Default.php 986 2007-10-19 12:36:21Z qeeyuan $
 */

/**
 * 定义应用程序的默认控制器
 *
 * FleaPHP 默认的控制器名字为 Default。
 *
 * 由于 FleaPHP 应用程序设置 controllerClassPrefix 为 'Controller_'，
 * 因此默认控制器的类名称就是 'Controller_Default'。
 *
 * 这个默认控制器没有其他功能，仅仅是重定向浏览器到 Post 控制器。
 *
 * 对于这种简单的控制器，无需从 FLEA_Controller_Action 继承。
 */
class Controller_Default
{
    /**
     * 构造函数
     *
     * @return Controller_Default
     */
    function Controller_Default()
    {
        redirect(url('Post'));
    }
}
