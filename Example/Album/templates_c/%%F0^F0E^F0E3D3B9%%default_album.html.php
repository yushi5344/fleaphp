<?php /* Smarty version 2.6.18, created on 2017-08-08 14:41:22
         compiled from default_album.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'default_album.html', 36, false),array('modifier', 'date_format', 'default_album.html', 46, false),array('function', 'url', 'default_album.html', 37, false),array('function', 'math', 'default_album.html', 46, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Album</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function basename(filename)
{
	p = filename.lastIndexOf("\\");
	if (p == -1) {
		p = filename.lastIndexOf("/");
		if (p == -1) { p = 0; }
	}
	return filename.substring(p + 1);
}

function checkSelected(form)
{
	arr = form.elements['selected[]'];
	if (arr.length == undefined) {
		arr = new Array(arr);
	}
	for (i = 0; i < arr.length; i++) {
		if (arr[i].checked) { return confirm('您确定要删除选中的相片'); }
	}

	alert('必须选中要删除的相片');
	return false;
}

</script>
</head>
<body>
<div id="content">
  <h1>相册 - <?php echo ((is_array($_tmp=$this->_tpl_vars['album']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1>
  <p>您可以点击缩略图查看完整大小的相片。要删除相片，请选中相片下的复选框，然后点击“删除”按钮。点击<a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array(), $this);?>
">返回首页</a>。</p>
  <form name="form_delete" action="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'manage','action' => 'deletePhotos','id' => $this->_tpl_vars['album']['album_id']), $this);?>
" method="post" onsubmit="return checkSelected(this);">
    <p> <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['album']['photos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
      <?php $this->assign('p', $this->_tpl_vars['album']['photos'][$this->_sections['i']['index']]); ?>
    <div class="album">
      <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['p']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h3>
      <a href="upload/photos/<?php echo $this->_tpl_vars['p']['photo_filename']; ?>
" target="_blank"><img src="upload/thumbs/<?php echo $this->_tpl_vars['p']['thumb_filename']; ?>
" border="0" class="thumb" width="220" height="220" /></a>
      <p>
        <input type="checkbox" name="selected[]" value="<?php echo $this->_tpl_vars['p']['photo_id']; ?>
" id="selected_<?php echo $this->_tpl_vars['p']['photo_id']; ?>
" />
        <label for="selected_<?php echo $this->_tpl_vars['p']['photo_id']; ?>
">日期: <?php echo ((is_array($_tmp=$this->_tpl_vars['p']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d") : smarty_modifier_date_format($_tmp, "%y-%m-%d")); ?>
, 大小: <?php echo smarty_function_math(array('equation' => "s / 1024",'s' => $this->_tpl_vars['p']['filesize'],'format' => "%0.2f"), $this);?>
KB</label>
      </p>
    </div>
    <?php endfor; endif; ?>
    </p>
    <div class="nofloat"></div>
	<?php if ($this->_tpl_vars['album']['photos_count'] > 0): ?>
    <p>
      <input type="submit" name="btnDelete" value="删除选中的相片" />
    </p>
	<?php endif; ?>
  </form>
  <hr />
  </p>
  <p>点击“浏览”按钮选择要上传的相片，然后点击“提交”按钮即可。</p>
  <form name="form_upload" action="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'manage','action' => 'upload','id' => $this->_tpl_vars['album']['album_id']), $this);?>
" method="post" enctype="multipart/form-data" onsubmit="if (this.postfile.value == '' || this.title.value == '') { alert('必须选择要上传的文件'); this.postfile.focus(); return false; } else { this.btnSubmit.disabled = true; return true; }">
    <p>选择要上传的相片：<br />
      <input type="file" name="postfile" size="60" onchange="this.form['title'].value = basename(this.value);" />
    </p>
    <p>相片名称：<br />
      <input type="text" name="title" size="40" />
    </p>
    <p>
      <input type="submit" name="btnSubmit" value=" 添加相片 " />
    </p>
  </form>
</div>
</body>
</html>