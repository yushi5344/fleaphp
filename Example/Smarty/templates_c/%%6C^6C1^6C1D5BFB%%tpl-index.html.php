<?php /* Smarty version 2.6.18, created on 2017-08-08 09:54:09
         compiled from tpl-index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'tpl-index.html', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smarty</title>
</head>
<body>
<div id="content"> <strong>在 index.php 中需要正确设置 Smarty 模版引擎选项：</strong> <br />
  <pre>
<code>
$appInf = array(
    'view' =&gt; 'FLEA_View_Smarty',
    'viewConfig' =&gt; array(
        'smartyDir'         =&gt; APP_DIR . '/Smarty',
        'template_dir'      =&gt; APP_DIR,
        'compile_dir'       =&gt; APP_DIR . '/templates_c',
        'left_delimiter'    =&gt; '{{',
        'right_delimiter'   =&gt; '}}',
    ),
);
FLEA::loadAppInf($appInf);
</code>
</pre>
  请仔细阅读 Example/Smarty/index.php 中的源代码。<br />
  <br />
  <br />
  <strong>首选的 Smarty 使用方式：</strong> <br />
  优点：使用灵活，和以前使用 Smarty 完全一致，能够最大限度的利用 Smarty 的增强功能。<br />
  缺点：如果更换其它模版引擎，代码修改量较大。<br />
  <pre>
<code>
function actionIndex() {
    $smarty =&amp; $this-&gt;_getView();
    /* @var $smarty Smarty */
    $smarty-&gt;assign('my_var', 'The smarty template engine.');
    $smarty-&gt;display('tpl-index.html');
}
</code>
</pre>
  <strong>Smarty 变量 $my_var 的值：</strong> <?php echo $this->_tpl_vars['my_var']; ?>
 <br />
  <br />
  [<a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('action' => 'alternative'), $this);?>
">点击查看另一种使用 Smarty 的方式</a>] </div>
</body>
</html>