<?php
/////////////////////////////////////////////////////////////////////////////
// 这个文件是 FleaPHP 项目的一部分
//
// Copyright (c) 2005 - 2006 FleaPHP.org (www.fleaphp.org)
//
// 要查看完整的版权信息和许可信息，请查看源代码中附带的 COPYRIGHT 文件，
// 或者访问 http://www.fleaphp.org/ 获得详细信息。
/////////////////////////////////////////////////////////////////////////////

/**
 * 定义 Controller_Default 类
 *
 * @copyright Copyright (c) 2005 - 2006 FleaPHP.org (www.fleaphp.org)
 * @author 廖宇雷 dualface@gmail.com
 * @package Example
 * @subpackage ImportExport
 * @version $Id: Default.php 976 2007-10-10 06:09:05Z qeeyuan $
 */

/**
 * Controller_Default 类是 Import & Export 示例的默认控制器
 *
 * @package Example
 * @subpackage ImportExport
 * @author 廖宇雷 dualface@gmail.com
 * @version 1.0
 */
class Controller_Default extends FLEA_Controller_Action
{
    /**
     * 显示欢迎页面
     */
    function actionIndex()
    {
        $tableData =& FLEA::getSingleton('Table_Data');
        /* @var $tableData Table_Data */
        $rowset = $tableData->findAll(null, 'created DESC', 10);
        $count = $tableData->findCount();
        $viewdata = array(
            'count' => $count,
            'rowset' => & $rowset,
        );

        $this->_executeView(TPL_DIR . '/default_index.php', $viewdata);
    }

    /**
     * 导入数据
     */
    function actionImport()
    {
        $uploader =& FLEA::getSingleton('FLEA_Helper_FileUploader');
        /* @var $uploader FLEA_Helper_FileUploader */
        if (!$uploader->existsFile('postfile')) {
            js_alert('必须选择要上传的文件', '', $this->_url());
        }

        $postfile =& $uploader->getFile('postfile');
        if (!$postfile->isSuccessed()) {
            js_alert('上传失败', '', $this->_url());
        }

        if (!$postfile->check('.csv/.txt')) {
            js_alert('只接受 .csv 和 .txt 文件', '', $this->_url());
        }

        $tableData =& FLEA::getSingleton('Table_Data');
        /* @var $tableData Table_Data */

        $header = isset($_POST['csv_header']);
        $fp = fopen($postfile->getTmpName(), 'r');
        $lineno = 0;
        while ($line = fgetcsv($fp)) {
            $lineno++;
            if (count($line) != 3) {
                // 过滤有问题的行
                continue;
            }
            if ($lineno == 1 && $header) {
                // 跳过第一行
                continue;
            }

            $row = array(
                'username' => $line[0],
                'level_ix' => (int)$line[1],
                'credits' => (int)$line[2],
            );
            $tableData->create($row);
        }
        fclose($fp);
        $postfile->remove();

        redirect($this->_url());
    }

    /**
     * 导出数据
     */
    function actionExport()
    {
        $tableData =& FLEA::getSingleton('Table_Data');
        /* @var $tableData Table_Data */

        /**
         * 输出头信息
         */
        header("Content-Type: text/plain");
        header("Content-Disposition: attachment; filename=export.csv;");
        header('Pragma: cache');
        header('Cache-Control: public, must-revalidate, max-age=0');

        /**
         * 由于 Excel 无法直接识别 utf-8 的数据，所以需要转换一下
         */
        echo $this->_convertEncode('utf-8', 'gbk', "会员名称,会员级别,积分\r\n");

        /**
         * 每次读取 200 条，避免占用过多内存
         */
        $offset = 0;
        $length = 200;
        while ($rowset = $tableData->findAll(null, 'created ASC', array($length, $offset))) {
            foreach ($rowset as $row) {
                echo $row['username'];
                echo ',';
                echo $row['level_ix'];
                echo ',';
                echo $row['credits'];
                echo "\r\n";
            }
            $offset += $length;
        }
    }

    /**
     * 转换编码
     *
     * @param string $in
     * @param string $out
     * @param string $string
     */
    function _convertEncode($in, $out, $string)
    {
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($string, $out, $in);
        } elseif (function_exists('iconv')) {
            return iconv($in, $out, $string);
        } else {
            return $string;
        }
    }
}
