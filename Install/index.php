<?php
define('SHARED_CONFIG_DIR', realpath(dirname(__FILE__) . '/../Example/_Shared/'));

// 检查服务器环境
$continue = true;
$serverEnv = array();

// 检查基本要求
$serverEnv['phpversion'] = phpversion() >= '4.3';
$continue = $continue && $serverEnv['phpversion'];

$serverEnv['mysql'] = function_exists('mysql_connect');
$continue = $continue && $serverEnv['mysql'];

$sharedConfigFilename =  SHARED_CONFIG_DIR . DIRECTORY_SEPARATOR . 'DSN.php';
$serverEnv['configPath'] = $sharedConfigFilename;
if (is_writable(SHARED_CONFIG_DIR)) {
    if (file_exists($sharedConfigFilename)) {
        if (is_writable($sharedConfigFilename)) {
            $serverEnv['writeConfig'] = '覆盖现有';
        } else {
            $serverEnv['writeConfig'] = '只读';
            $continue = false;
        }
    } else {
        $serverEnv['writeConfig'] = '新创建';
    }
} else {
    $serverEnv['writeConfig'] = '目录不可写';
    $continue = false;
}

// 检查推荐设置
$recommendSettings = array(
    array('Safe Mode',            'safe_mode',            false),
    array('Display Errors',       'display_errors',       true),
    array('File Uploads',         'file_uploads',         true),
    array('Magic Quotes GPC',     'magic_quotes_gpc',     false),
    array('Magic Quotes Runtime', 'magic_quotes_runtime', false),
    array('Register Globals',     'register_globals',     false),
    array('Output Buffering',     'output_buffering',     true),
    array('Session auto start',   'session.auto_start',   false)
);

$currentSettings = array();
foreach ($recommendSettings as $setting) {
    $currentSettings[] = array(
        $setting[0],
        $setting[2] ? 'ON' : 'OFF',
        ini_get($setting[1]) ? 'ON' : 'OFF',
        ini_get($setting[1]) == $setting[2]
    );
}

?>
<?php require dirname(__FILE__) . '/../FLEA/FLEA.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FleaPHP - 为日趋复杂的 Web 应用提供基础架构平台</title>
<link href="../Stuff/css/css.css" rel="stylesheet" type="text/css" />
<link href="../Stuff/css/install-style.css" rel="stylesheet" type="text/css" />
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
      <td width="230" align="right" valign="top"><br />
        <br />
        <br />
        <br />
        <br />
        <ul class="step">
          <li class="step-current">运行环境检查</li>
          <li>设置安装选项</li>
          <li>完成安装</li>
        </ul></td>
      <td width="50" valign="top">&nbsp;</td>
      <td width="520" valign="top"><br />
        <br />
        <br />
        <h3 class="none">基本运行环境检查</h3>
        如果下方列表有任何一项未能满足要求，将无法运行 FleaPHP。请在继续安装之前解决所有问题。<br />
        <br />
        PHP 版本 &gt;= 4.3.0：
        <?php if ($serverEnv['phpversion']): ?>
        <span class="ok"><?php echo phpversion() ?></span>
        <?php else: ?>
        <span class="error"><?php echo phpversion() ?></span>
        <?php endif; ?>
        <br />
        MySQL 支持：
        <?php if ($serverEnv['mysql']): ?>
        <span class="ok">可用</span>
        <?php else: ?>
        <span class="error">不支持</span>
        <?php endif; ?>
        <br />
        写入配置文件：
        <?php if ($serverEnv['writeConfig'] == '目录不可写' || $serverEnv['writeConfig'] == '只读'): ?>
        <span class="error"><?php echo htmlspecialchars($serverEnv['writeConfig']); ?></span>
        <?php else: ?>
        <span class="ok"><?php echo htmlspecialchars($serverEnv['writeConfig']); ?></span>
        <?php endif; ?>
        <br />
        配置文件路径：<?php echo htmlspecialchars($serverEnv['configPath']); ?><br />
        <br />
        <br />
        <h3 class="none">推荐的设置</h3>
        如果您的运行环境设置与推荐设置完全符合，那么可以获得最佳的运行效果和性能表现。<br />
        <br />
        <table border="0" cellpadding="4" cellspacing="1" bgcolor="#666666">
          <tr>
            <td bgcolor="#597380"><span class="white">选项</span></td>
            <td align="center" bgcolor="#597380"><span class="white">推荐设置</span></td>
            <td align="center" bgcolor="#597380"><span class="white">当前设置</span></td>
          </tr>
          <?php foreach ($currentSettings as $setting): ?>
          <tr>
            <td bgcolor="#AFC4CF"><?php echo $setting[0] ?></td>
            <td align="center" bgcolor="#AFC4CF" class="ok"><?php echo $setting[1] ?></td>
            <td align="center" bgcolor="#AFC4CF"><?php if ($setting[3]): ?>
              <span class="ok"><?php echo $setting[2] ?></span>
              <?php else: ?>
              <span class="not-recommend"><?php echo $setting[2] ?></span>
              <?php endif; ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <br />
        <input name="Next" type="button" id="Next" value="设置安装选项 &gt;&gt;" class="button" <?php if (!$continue): ?>disabled="disabled"<?php endif; ?> onclick="document.location.href='set-options.php';" />
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
