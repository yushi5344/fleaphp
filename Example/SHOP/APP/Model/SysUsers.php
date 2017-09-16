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
 * 定义 Model_SysUsers 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技 (www.qeeyuan.com)
 * @package Example
 * @subpackage SHOP
 * @version $Id: SysUsers.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('FLEA_Rbac_UsersManager');
// }}}

/**
 * Model_SysUsers 封装了对系统用户信息的操作，同时还负责取出用户的角色信息
 *
 * @package Example
 * @subpackage SHOP
 * @author 起源科技 (www.qeeyuan.com)
 * @version 1.0
 */
class Model_SysUsers extends FLEA_Rbac_UsersManager
{
    /**
     * 保存用户信息的数据表名称
     *
     * @var string
     */
    var $tableName = 'sysusers';

    /**
     * 主键字段名
     *
     * @var unknown_type
     */
    var $primaryKey = 'user_id';

    /**
     * 定义一个多对多关联，确保 Model_SysUsers 能够获取用户的角色信息
     *
     * @var array
     */
    var $manyToMany = array(
        'tableClass' => 'Model_SysRoles',
        'mappingName' => 'roles',
        'joinTable' => 'sysusers_has_sysroles',
    );

    /**
     * 指示用户记录中，用什么字段保存用户的角色信息
     *
     * 这个成员变量的值必须和先前定义的多对多关联的 mappingName 一致。
     *
     * @var string
     */
    var $rolesField = 'roles';
}
