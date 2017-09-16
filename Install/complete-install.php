<?php require dirname(__FILE__) . '/../FLEA/FLEA.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FleaPHP - 为日趋复杂的 Web 应用提供基础架构平台</title>
<link href="../Stuff/css/css.css" rel="stylesheet" type="text/css" />
<link href="../Stuff/css/install-style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../FLEA/FLEA/Ajax/jquery.js"></script>
<script language="javascript" type="text/javascript">
function run_setup()
{
	// 发起 ajax 请求运行安装程序
	$.post("setup-database.php", {
		host: "<?php echo h($_GET['host']); ?>",
		login: "<?php echo h($_GET['login']); ?>",
		password: "<?php echo h($_GET['password']); ?>",
		database: "<?php echo h($_GET['database']); ?>"
	}, 
	function(response) {
		$("#log").html(response);
		if (response.indexOf("SUCCESSED.") != -1) {
			$("#btnNext").attr('disabled', false);
		}
	});
}

</script>
</head>
<body onload="run_setup();">
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
      <td width="230" align="right" valign="top"><br />
        <br />
        <br />
        <br />
        <br />
        <ul class="step">
          <li>运行环境检查</li>
          <li>设置安装选项</li>
          <li class="step-current">完成安装</li>
        </ul></td>
      <td width="50" valign="top">&nbsp;</td>
      <td width="520" valign="top"><br />
        <br />
        <br />
        <h3 class="none">安装结果</h3>
        请检查下面显示的安装结果。如果结果不正确，请返回上一步重新设置安装选项并尝试再次安装。<br />
        <br />
        <textarea name="log" id="log" style="width: 100%; font-size: 12px;" rows="20" readonly="readonly">请稍等，正在执行安装.....</textarea>
        <br />
        <br />
        <input name="Back" type="button" class="button" id="btnBack" value="&lt;&lt; 修改安装选项" onclick="document.location.href='set-options.php';" />
        &nbsp;&nbsp;
        <input name="Next" type="button" class="button" id="btnNext" value="完成安装 &gt;&gt;" disabled="disabled" onclick="document.location.href='../index.php';" />
        <br />
        <br />
        <br />
        <br />
        <br />
      </td>
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
