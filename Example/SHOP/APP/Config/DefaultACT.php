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
 * 定义所有控制器的访问控制表
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: DefaultACT.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

return array(
    /**
     * BoLogin 控制器
     */
    'BoLogin' => array(
        'allow' => RBAC_EVERYONE,
    ),

    /**
     * BoBase 控制器
     */
    'BoBase' => array(
       'deny' => RBAC_EVERYONE,
    ),

    /**
     * BoDashboard 控制器
     */
    'BoDashboard' => array(
        'allow' => RBAC_HAS_ROLE,

        'actions' => array(
            'phpinfo' => array(
                'allow' => 'SYSTEM_ADMIN',
            ),
        ),
    ),

    /**
     * BoProductClasses 控制器
     */
    'BoProductClasses' => array(
        'allow' => 'SYSTEM_ADMIN',
    ),

    /**
     * BoProducts 控制器
     */
    'BoProducts' => array(
        'allow' => 'SYSTEM_ADMIN',
    ),

    /**
     * BoPreference 控制器
     */
    'BoPreference' => array(
        'allow' => 'SYSTEM_ADMIN',
    ),
);
