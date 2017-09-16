<?php if (!defined('APP_DIR')) { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax</title>
<script language="JavaScript" type="text/javascript" src="../../FLEA/FLEA/Ajax/jquery.js"></script>
<script language="JavaScript" type="text/javascript">
/**
 * 解析服务器返回的 JSON 字符串，然后创建表格的行
 */
function onTest3Complete(response)
{
    list = eval('(' + response + ')');
    table = $("#tableTest3Result").get(0);
    for (i = 0, max = table.rows.length - 1; i < max; i++) {
        table.deleteRow(1);
    }
    for (i = 0, max = list.length; i < max; i++) {
        row = table.insertRow(i + 1);
        row.insertCell(0).innerHTML = list[i].title;
        row.insertCell(1).innerHTML = list[i].created;
    }
}

</script>
<?php $ajax->dumpJs(); ?>
</head>
<body>
<div id="content">
  <p>测试1：用 Ajax 提交一个值，然后从服务器获得结果<br />
    <br />
    <strong>textboxTest1:</strong><br />
    <?php $ui->control('Textbox', 'textboxTest1', array('size' => 22)); ?>
    <br />
    <?php $ui->control('Button', 'buttonTest1', array('value' => ' 测试1 ')); ?>
    <br />
    <br />
    输出结果：<br />
    <?php $ui->control('Memo', 'memoTest1Result', array('cols' => 40, 'rows' => 3)); ?>
  </p>
  <hr />
  <p> 测试2：用 Ajax 提交一个表单，然后从服务器获得结果<br />
  <form id="formTest2" name="formTest2" method="post">
    <strong>textboxTest2:</strong><br />
    <?php $ui->control('Textbox', 'textboxTest2', array('size' => 22)); ?>
    <br />
    <br />
    <strong>radioGroupTest2:</strong><br />
    <?php $ui->control('RadioGroup', 'radioGroupTest2', array(
        'selected' => 'radio2 value',
        'items' => array(
            'raido1' => 'radio1 value',
            'raido2' => 'radio2 value',
            'raido3' => 'radio3 value',
        )
    )); ?>
    <br />
    <br />
    <strong>dropdownListTest2:</strong><br />
    <?php $ui->control('DropdownList', 'dropdownListTest2',
        array('items' => array(
            'item1' => 'item1 value',
            'item2' => 'item2 value',
            'item3' => 'item3 value',
            'item4' => 'item4 value',
        ))
    ); ?>
    <br />
    <br />
    <?php $ui->control('Submit', 'submitTest2', array('value' => ' 提交表单 ')); ?>
  </form>
  输出结果：<br />
  <?php $ui->control('Memo', 'memoTest2Result', array('cols' => 40, 'rows' => 8)); ?>
  </p>
  <hr />
  <p>测试3：用 Ajax 获取一个列表<br />
    <br />
    <?php $ui->control('Button', 'buttonTest3', array('value' => ' 获取列表 ')); ?>
    <br />
    <br />
    输出结果：<br />
  <table border="1" id="tableTest3Result">
    <tr>
      <td><strong>标题</strong></td>
      <td><strong>创建日期</strong></td>
    </tr>
  </table>
  </p>
</div>
</body>
</html>
