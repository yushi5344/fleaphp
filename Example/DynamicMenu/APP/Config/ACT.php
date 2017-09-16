<?php

return array(
    'Default' => array(
        'allow' => RBAC_EVERYONE,
    ),
    'BoDashboard' => array(
        'allow' => RBAC_HAS_ROLE,
    ),
    'BoSettings' => array(
        'allow' => 'ROOT, 前台功能设置, 商品相关设置, VIP升级设置, 会员级别变更通知设置, 用户注册默认设置, 违约用户检查, 送货方式设置, 付款方式设置, 退款方式设置',
    ),
    'BoSysUsers' => array(
        'allow' => 'ROOT, 后台用户管理',
    ),
    'BoDeliverMethods' => array(
        'allow' => 'ROOT, 送货方式设置',
    ),
    'BoPaymentMethods' => array(
        'allow' => 'ROOT, 付款方式设置',
    ),
    'BoRefundmentMethods' => array(
        'allow' => 'ROOT, 退款方式设置',
    ),
    'BoProducts' => array(
        'allow' => 'ROOT, 添加商品, 列出商品, 商品审核, 商品图片管理, 修改商品, 删除商品',

        'actions' => array(
            'index'     => array('allow' => 'ROOT, 列出商品'),
            'add'       => array('allow' => 'ROOT, 添加商品'),
            'edit'      => array('allow' => 'ROOT, 列出商品, 修改商品'),
            'publish'   => array('allow' => 'ROOT, 商品审核'),
            'delete'    => array('allow' => 'ROOT, 删除商品'),
            'save'      => array('allow' => 'ROOT, 添加商品, 修改商品'),
            'displayPhotoManager' => array('allow' => 'ROOT, 商品图片管理'),
            'displayThumbManager' => array('allow' => 'ROOT, 商品图片管理'),
            'upload'        => array('allow' => 'ROOT, 商品图片管理'),
            'removePhotos'  => array('allow' => 'ROOT, 商品图片管理'),
            'setPhotosVipOnly' => array('allow' => 'ROOT, 商品图片管理'),
            'uploadSmallPhoto' => array('allow' => 'ROOT, 商品图片管理'),
            'removeSmallPhoto' => array('allow' => 'ROOT, 商品图片管理'),
        ),
    ),
    'BoOrders' => array(
        'allow' => 'ROOT, 修改订单, 列出并查看所有订单, 删除订单, 确认发货, 确认订单',
        'actions' => array(
            'index'         => array('allow' => 'ROOT, 列出并查看所有订单'),
            'save'          => array('allow' => 'ROOT, 修改订单'),
            'delete'        => array('allow' => 'ROOT, 删除订单'),
            'confirm'       => array('allow' => 'ROOT, 确认订单'),
            'cancelConfirm' => array('allow' => 'ROOT, 确认订单'),
            'process'       => array('allow' => 'ROOT, 确认发货'),
        ),
    ),
    'BoMembers' => array(
        'allow' => 'ROOT, 导出会员资料, 列出会员, 修改会员, 审核会员, 删除会员',
        'actions' => array(
            'index'         => array('allow' => 'ROOT, 列出会员'),
            'export'        => array('allow' => 'ROOT, 导出会员资料'),
            'edit'          => array('allow' => 'ROOT, 列出会员, 修改会员'),
            'save'          => array('allow' => 'ROOT, 修改会员'),
            'delete'        => array('allow' => 'ROOT, 删除会员'),
        ),
    ),
    'BoUpgrade' => array(
        'allow' => 'ROOT, 审核VIP升级',
    ),
    'BoNews' => array(
        'allow' => 'ROOT, 发布新闻, 列出及修改新闻',
        'actions' => array(
            'index' => array('allow' => 'ROOT, 列出及修改新闻'),
            'edit'  => array('allow' => 'ROOT, 列出及修改新闻'),
            'save'  => array('allow' => 'ROOT, 列出及修改新闻'),
            'add'   => array('allow' => 'ROOT, 发布新闻'),
        ),
    ),
    'BoTags' => array(
        'allow' => 'ROOT, 标签管理',
    ),
    'BoTagTypes' => array(
        'allow' => 'ROOT, 标签类别管理',
    ),
    'BoMessages' => array(
        'allow' => 'ROOT, 查看会员消息, 查看管理员发送的消息, 向会员发送消息, 群发消息, 删除消息',
        'actions' => array(
            'index' => array('allow' => 'ROOT, 查看会员消息'),
            'view' => array('allow' => 'ROOT, 查看会员消息'),
            'send' => array('allow' => 'ROOT, 向会员发送消息'),
            'save' => array('allow' => 'ROOT, 向会员发送消息'),
            'reply' => array('allow' => 'ROOT, 向会员发送消息'),
            'delete' => array('allow' => 'ROOT, 删除消息'),
            'sendMessagesToGroup' => array('allow' => 'ROOT, 群发消息'),
            'outbox' => array('allow' => 'ROOT, 查看管理员发送的消息'),
            'emptyOutbox' => array('allow' => 'ROOT, 查看管理员发送的消息'),
            'viewOutbox' => array('allow' => 'ROOT, 查看管理员发送的消息'),
        ),
    ),
    'BoLocations' => array(
        'allow' => 'ROOT, 商品地区管理',
    ),
    'BoOnlineUsers' => array(
        'allow' => RBAC_HAS_ROLE,
    ),
);
