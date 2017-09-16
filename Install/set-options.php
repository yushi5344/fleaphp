<?php require dirname(__FILE__) . '/../FLEA/FLEA.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FleaPHP - 为日趋复杂的 Web 应用提供基础架构平台</title>
<link href="../Stuff/css/css.css" rel="stylesheet" type="text/css" />
<link href="../Stuff/css/install-style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function fnOnSubmit(form) {
    if (form.database.value == '') {
        alert('必须输入数据库名称');
        form.database.focus();
        return false;
    }

    return true;
}
</script>
</head>
<body>
<div id="header">
  <div id="banner">
    <div class="b1"><a href="http://www.fleaphp.org/bbs/" target="_blank"><span class="no-display">FleaPHP 论坛</span></a></div>
    <div class="b2"><a href="http://www.fleaphp.org/" target="_blank"><span class="no-display">FleaPHP 社区</span></a></div>
    <div class="b3"><a href="http://www.qeeyuan.com/contact.html" target="_blank"><span class="no-display">联系我们</span></a></div>
    <div class="b4"><a href="http://www.qeeyuan.com/" target="_blank"><span class="no-display">关于我们</span></a></div>
    <div class="b5"><a href="../index.php"><span class="no-display">欢迎页面</span></a></div>
  </div>
  <div id="red">
    <div class="gets"><a href="http://www.qeeyuan.com" target="_blank"></a></div>
    <p><strong>您当前使用的 FleaPHP 版本为 <?php echo FLEA_VERSION; ?>。</strong></p>
    <p>FleaPHP 为开发者轻松、快捷的创建应用程序提供帮助。FleaPHP 框架简单、清晰，容易理解和学习，并且有完全中文化的文档和丰富的示例程序降低学习成本。使用 FleaPHP 框架开发的应用程序能够自动适应各种运行环境，并兼容 PHP4 和 PHP5。</p>
    <p>有关 FleaPHP 的详细信息请访问 <a href="http://www.fleaphp.org" target="_blank">FleaPHP 官方网站</a>。</p>
  </div>
</div>
<div id="main">
  <table width="900" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="230" align="right" valign="top">
	    <br />
        <br />
        <br />
        <br />
        <br />
        <ul class="step">
          <li>运行环境检查</li>
          <li class="step-current">设置安装选项</li>
          <li>完成安装</li>
        </ul></td>
      <td width="50" valign="top">&nbsp;</td>
      <td width="520" valign="top"><br />
        <br />
        <br />
        <h3 class="none">设置安装选项</h3>
        安装 FleaPHP 附带示例运行所需的数据。如果不使用数据库，则部分示例无法运行。<br />
        <br />
        <span class="error">注意：如果已经安装过示例，则再次安装会覆盖掉现有的数据。</span><br />
        <br />
        <form action="complete-install.php" method="get" name="form1" id="form1" onsubmit="return fnOnSubmit(this);">
          数据库类型：
          <select name="driver">
            <option value="mysql" selected="selected">MySQL</option>
            <!-- <option value="postgres">PostgreSQL</option>
          <option value="oracle">Oracle</option> -->
          </select>
          <br />
          数据库主机：
          <input name="host" type="text" class="inputbox" id="host" value="localhost" />
          <br />
          数据库用户：
          <input name="login" type="text" class="inputbox" id="login" value="root" />
          <br />
          数据库密码：
          <input name="password" type="text" class="inputbox" id="password" />
          <br />
          数据库名称：
          <input name="database" type="text" class="inputbox" id="database" value="test" />
          <br />
          <br />
          <input name="Next" type="submit" id="Next" value="开始安装 &gt;&gt;" class="button" />
          <br />
          <br />
          <br />
          <br />
          <br />
        </form></td>
      <td width="100" valign="top">&nbsp;</td>
    </tr>
  </table>
</div>
<div id="footer">
  <div id="footer-show"><a href="http://www.fleaphp.org/" target="_blank">FleaPHP 开放源代码项目</a>为您创建高品质 Web 应用提供帮助。
    &nbsp;&nbsp;&nbsp;&nbsp;
    &copy; 2005-2008 <a href="http://www.qeeyuan.com/" target="_blank">自贡市起源科技有限公司</a> </div>
</div>
</body>
</html>
