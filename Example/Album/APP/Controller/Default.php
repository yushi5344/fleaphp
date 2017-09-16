<?php

FLEA::loadClass('FLEA_Controller_Action');

class Controller_Default extends FLEA_Controller_Action
{
    /**
     * 默认控制器的默认动作，显示相册列表
     */
    function actionIndex()
    {
        // 构造 Table_Albums 的实例
        $tableAlbums =& FLEA::getSingleton('Table_Albums');
        /* @var $tableAlbums Table_Albums */

        /**
         * 由于在相册列表页面，只需要查询相册中最新一张相片的信息。
         * 因此可以设置关联的 limit 属性和 fields，避免查询不需要的记录和字段。
         */
        $link =& $tableAlbums->getLink('photos');
        $link->fields = 'thumb_filename';
        /**
         * 当关联的 groupBy 为 true 时，只查询每个主表记录的一条关联记录
         */
        $link->groupBy = true;
        $albums = $tableAlbums->findAll(null, 'created DESC');

        // 模板名一般为“控制器名_动作名”，这样模板和控制器动作之间的对应一目了然
        $this->_executeView('default_index.html', array('albums' => $albums));
    }

    /**
     * 显示相册内容
     */
    function actionAlbum()
    {
        /**
         * 检查是否提供了需要的 url 参数
         */
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            redirect(url());
        }

        // 查询相册及相片信息
        $tableAlbums =& FLEA::getSingleton('Table_Albums');
        /* @var $tableAlbums Table_Albums */
        $album = $tableAlbums->find($id);

        $this->_executeView('default_album.html', array('album' => $album));
    }
}
