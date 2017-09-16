<?php /* Smarty version 2.6.18, created on 2017-08-08 14:41:17
         compiled from manage_newalbum.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manage_newalbum.html', 11, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Album</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="content">
  <h1>创建新相册</h1>
  <p>相册创建成功后，即可添加相片。点击<a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array(), $this);?>
">返回首页</a>。</p>
  <p>
  <form name="form_newalbum" action="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'manage','action' => 'newalbum'), $this);?>
" method="post">
    <p>
      <label for="title">相册名称：</label>
      <br />
      <input type="text" name="title" id="title" size="70" />
    </p>
    <p>
      <input type="submit" name="btnSubmit" value=" 提  交 " />
    </p>
  </form>
  </p>
</div>
</body>
</html>