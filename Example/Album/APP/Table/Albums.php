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
 * 定义 Table_Albums 类
 *
 * @copyright Copyright (c) 2005 - 2008 QeeYuan China Inc. (http://www.qeeyuan.com)
 * @author 起源科技
 * @package Example
 * @subpackage Album
 * @version $Id: Albums.php 972 2007-10-09 20:56:54Z qeeyuan $
 */

// {{{ includes
FLEA::loadClass('FLEA_Db_TableDataGateway');
// }}}

/**
 * Table_Albums 封装了对相册的数据库操作
 *
 * @package Example
 * @subpackage Album
 * @author 起源科技
 * @version 1.0
 */
class Table_Albums extends FLEA_Db_TableDataGateway
{
    /**
     * 指定要操作的数据表名称
     *
     * @var string
     */
    var $tableName = 'albums';

    /**
     * 指定主键字段名
     *
     * @var string
     */
    var $primaryKey = 'album_id';

    var $hasMany = array(
        // 每个相册有多张相片
        array(
            // 关联到哪一个类
            'tableClass' => 'Table_Photos',
            // 关联表中用什么字段存储对主表记录的主键值引用
            'foreignKey' => 'album_id',
            // 在返回的查询结果中，用什么名字保存关联表的信息
            'mappingName' => 'photos',
            // 查询相册的相片信息时，最新添加的相片排在最前面
            'sort' => 'created DESC',
        )
    );

    /**
     * 处理上传相片
     *
     * @param int $albumId
     * @param FLEA_Helper_UploadFile $postfile
     */
    function uploadPhoto($albumId, $postfile)
    {
        $album = $this->find($albumId, null, 'album_id', false);
        if (!$album) {
            return __THROW(new FLEA_Exception('指定的相册 ID 不存在'));
        }

        /**
         * 确定保存在服务器上的文件名
         *
         * 为了每个目录下的文件不会太对，所以按照每个月一个子目录分散保存上传的文件
         */
        $prefix = date('Y-m');
        $photoDir = FLEA::getAppInf('uploadDir') . DS . 'photos' . DS . $prefix;
        $thumbDir = FLEA::getAppInf('uploadDir') . DS . 'thumbs' . DS . $prefix;
        // 创建需要的目录
        FLEA::loadHelper('file');
        mkdirs($photoDir);
        mkdirs($thumbDir);

        // 文件名根据当前时间和上传文件的临时文件名生成，确保不会产生重复的文件名
        $basename = md5(time() . $postfile->getTmpName());
        $photoFilename =  $basename . '.' . $postfile->getExt();
        $thumbFilename = 't-' . $basename . '.jpg';

        // 生成缩略图（220 x 220 像素大小）
        FLEA::loadHelper('image');
        $image =& FLEA_Helper_Image::createFromFile($postfile->getTmpName(), $postfile->getExt());
        $image->crop(220, 200, true, true);
        $image->saveAsJpeg($thumbDir . DS . $thumbFilename);
        $image->destory();

        // 保存原始相片
        $postfile->move($photoDir . DS . $photoFilename);

        // 添加数据库记录
        $tablePhotos = FLEA::getSingleton('Table_Photos');
        /* @var $tablePhotos Table_Photos */
        $photo = array(
            'album_id' => $albumId,
            'title' => $_POST['title'],
            'filesize' => $postfile->getSize(),
            'photo_filename' => $prefix . '/' . str_replace(DS, '/', $photoFilename),
            'thumb_filename' => $prefix . '/' . str_replace(DS, '/', $thumbFilename),
        );
        $tablePhotos->create($photo);

        // 更新相册信息
        $album['photos_count'] = $tablePhotos->findCount(array('album_id' => $albumId));
        $this->update($album);
    }

    /**
     * 删除相片信息
     *
     * @param int $albumId
     * @param array $photosId
     */
    function removePhotos($albumId, $photosId)
    {
        $album = $this->find($albumId, null, 'album_id', false);
        if (!$album) {
            return __THROW(new FLEA_Exception('指定的相册 ID 不存在'));
        }

        // 对输入数据强制转换为整数，可以方便构造 SQL，并避免 SQL 注入
        $albumId = (int)$albumId;
        if (!is_array($photosId)) {
            $photosId = array($photosId);
        }
        $photosId = array_map('intval', $photosId);

        // 读取相片信息，并删除相片文件
        $tablePhotos = FLEA::getSingleton('Table_Photos');
        /* @var $tablePhotos Table_Photos */
        $conditions = "album_id = {$albumId} AND photo_id IN (" . implode(',', $photosId) . ")";

        $photos = $tablePhotos->findAll($conditions);
        $dir = FLEA::getAppInf('uploadDir');
        foreach ($photos as $photo) {
            unlink($dir . DS . 'thumbs' . DS . str_replace('/', DS, $photo['thumb_filename']));
            unlink($dir . DS . 'photos' . DS . str_replace('/', DS, $photo['photo_filename']));
        }

        // 删除相片记录
        $tablePhotos->dbo->execute("DELETE FROM {$tablePhotos->qtableName} WHERE {$conditions}");

        // 更新相册
        $album = array(
            $this->primaryKey => $albumId,
            'photos_count' => $tablePhotos->findCount("album_id = {$albumId}"),
        );
        $this->update($album);
    }

    /**
     * 删除相册
     *
     * @param array $albumsId
     */
    function removeAlbums($albumsId)
    {
        // 对输入数据强制转换为整数，可以方便构造 SQL，并避免 SQL 注入
        if (!is_array($albumsId)) {
            $albumsId = array($albumsId);
        }
        $albumsId = array_map('intval', $albumsId);

        // 读取相片信息，并删除相片文件
        $tablePhotos = FLEA::getSingleton('Table_Photos');
        /* @var $tablePhotos Table_Photos */
        $conditions = 'album_id IN (' . implode(',', $albumsId) . ')';

        $photos = $tablePhotos->findAll($conditions);
        $dir = FLEA::getAppInf('uploadDir');
        foreach ($photos as $photo) {
            unlink($dir . DS . 'thumbs' . DS . str_replace('/', DS, $photo['thumb_filename']));
            unlink($dir . DS . 'photos' . DS . str_replace('/', DS, $photo['photo_filename']));
        }

        // 删除相册和相片记录
        $this->removeByPkvs($albumsId);
    }
}
