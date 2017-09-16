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
 * 定义 Model_SysRoles 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: SysRoles.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('FLEA_Rbac_RolesManager');
// }}}

/**
 * Model_SysRoles 封装了对系统角色信息的操作，同时还辅助 Model_SysUsers 取出用户的角色信息
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Model_SysRoles extends FLEA_Rbac_RolesManager
{
    /**
     * 数据表名称
     *
     * @var string
     */
    var $tableName = 'sysroles';

    /**
     * 主键字段名
     *
     * @var unknown_type
     */
    var $primaryKey = 'role_id';
}
