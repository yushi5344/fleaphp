<?php if (!defined('APP_DIR')) { exit('EXIT'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Import & Export</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Import &amp; Export 示例</h1>
<form name="import" action="<?php echo $this->_url('import'); ?>" method="post" enctype="multipart/form-data">
  <p>
    <label>选择要导入的 .CSV 文件：</label>
    <br />
    <input type="file" name="postfile" size="60" />
	<br />
	* <?php echo h(realpath(dirname(__FILE__) . '/../members.csv')); ?> 文件可以作为测试数据导入。
  </p>
  <p>
  	<input type="checkbox" name="csv_header" id="csv_header" value="1" checked="checked" /> <label for="csv_header">文件第一行是字段名</label>
  </p>
  <p>
    <input type="submit" name="Submit" value=" 开始导入 " onclick="this.disabled = true; this.form.submit(); return true;" />
  </p>
</form>
<p>&nbsp;</p>
<h3>现有的数据</h3>
<p> 数据条目总数：<?php echo $count; ?> </p>
<?php if (!empty($rowset)): ?>
<table border="0" cellpadding="0" cellspacing="0" class="table-data">
  <tr>
    <th colspan="4" class="header">最近添加的 10 条</th>
  </tr>
  <tr>
    <th class="first">会员名</th>
    <th>会员级别</th>
    <th>会员积分</th>
    <th>添加日期</th>
  </tr>
  <?php foreach ($rowset as $offset => $row): ?>
  <tr class="<?php echo $row % 2 ? 'odd' : 'even'; ?>">
    <th class="row_first"><?php echo h($row['username']); ?>&nbsp;</th>
    <td align="center"><?php echo $row['level_ix']; ?>&nbsp;</td>
    <td align="right"><?php echo number_format($row['credits'], 0, '', ','); ?>&nbsp;</td>
    <td><?php echo date('Y/m/d H:i:s', $row['created']); ?>&nbsp;</td>
  </tr>
  <?php endforeach; ?>
</table>
<?php endif; ?>
<p>
  <a href="<?php echo $this->_url('export', array('format' => 'txt')); ?>">导出为文本文件</a>
</p>
</body>
</html>
