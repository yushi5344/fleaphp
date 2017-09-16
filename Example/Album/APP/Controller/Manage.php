<?php

FLEA::loadClass('FLEA_Controller_Action');

class Controller_Manage extends FLEA_Controller_Action
{
    function actionNewAlbum()
    {
        if (!$this->_isPOST()) {
            $this->_executeView('manage_newalbum.html');
        } else {
            $row = array('title' => trim($_POST['title']), 'photos_count' => 0);
            if ($row['title'] == '') {
                js_alert('必须输入相册名字', '', $this->_url('newalbum'));
            }

            $tableAlbums = FLEA::getSingleton('Table_Albums');
            /* @var $tableAlbums Table_Albums */
            $tableAlbums->create($row);
            redirect(url());
        }
    }

    function actionUpload()
    {
        /**
         * 检查是否提供了需要的 url 参数
         */
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            redirect(url());
        }

        // 处理上传文件
        FLEA::loadHelper('uploader');
        $uploader =& new FLEA_Helper_FileUploader();
        if (!$uploader->isFileExist('postfile')) {
            js_alert('请选择要上传的文件', '', url(null, 'album', array('id' => $id)));
        }
        // 检查上传文件的扩展名是否正确
        $postfile = $uploader->getFile('postfile');
        if (!$postfile->check('.jpg/.png/.gif')) {
            js_alert('只允许上传 jpeg/gif/png 格式的文件', '', url(null, 'album', array('id' => $id)));
        }

        /**
         * Table_Albums::uploadPhoto() 封装了相片上传的实际操作和相片记录添加
         */
        $tableAlbums = FLEA::getSingleton('Table_Albums');
        /* @var $tableAlbums Table_Albums */
        $tableAlbums->uploadPhoto($id, $postfile);
        redirect(url(null, 'album', array('id' => $id)));
    }

    function actionDeletePhotos()
    {
        /**
         * 检查是否提供了需要的 url 参数
         */
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            redirect(url());
        }

        /**
         * Table_Albums 类的 removePhotos() 方法完成了对相片记录和文件的删除操作
         */
        $tableAlbums = FLEA::getSingleton('Table_Albums');
        /* @var $tableAlbums Table_Albums */
        $tableAlbums->removePhotos($id, $_POST['selected']);
        redirect(url(null, 'album', array('id' => $id)));
    }

    function actionDeleteAlbums()
    {
        /**
         * Table_Albums 类的 removeAlbums() 方法完成了对相册的删除操作
         */
        $tableAlbums = FLEA::getSingleton('Table_Albums');
        /* @var $tableAlbums Table_Albums */
        $tableAlbums->removeAlbums($_POST['selected']);
        redirect(url());
    }
}
