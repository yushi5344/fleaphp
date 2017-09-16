<?php /* Smarty version 2.6.18, created on 2017-08-08 14:41:15
         compiled from default_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'default_index.html', 25, false),array('modifier', 'escape', 'default_index.html', 31, false),array('modifier', 'date_format', 'default_index.html', 35, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Album</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function checkSelected(form)
{
	arr = form.elements['selected[]'];
	if (arr.length == undefined) {
		arr = new Array(arr);
	}
	for (i = 0; i < arr.length; i++) {
		if (arr[i].checked) { return confirm("相册中的所有相片都会删除。\n您确定要删除选中的相册？"); }
	}
	alert('必须选中要删除的相册');
	return false;
}
</script>
</head>
<body>
<div id="content">
  <h1>相册列表</h1>
  <p>您可以点击相册查看该相册的相片，或者<a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'manage','action' => 'newalbum'), $this);?>
">创建新相册</a>。</p>
  <p>
  <form name="form_delete" action="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'manage','action' => 'deleteAlbums'), $this);?>
" method="post" onsubmit="return checkSelected(this);">
    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['albums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <?php $this->assign('a', $this->_tpl_vars['albums'][$this->_sections['i']['index']]); ?>
    <div class="album">
      <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['a']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h3>
      <a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('action' => 'album','id' => $this->_tpl_vars['a']['album_id']), $this);?>
"><img src="<?php if ($this->_tpl_vars['a']['photos'][0]['thumb_filename'] != ''): ?>upload/thumbs/<?php echo $this->_tpl_vars['a']['photos'][0]['thumb_filename']; ?>
<?php else: ?>images/nophoto.jpg<?php endif; ?>" class="thumb" width="220" height="220" /></a>
      <p>
        <input type="checkbox" name="selected[]" value="<?php echo $this->_tpl_vars['a']['album_id']; ?>
" id="selected_<?php echo $this->_tpl_vars['a']['album_id']; ?>
" />
        <label for="selected_<?php echo $this->_tpl_vars['a']['album_id']; ?>
">日期：<?php echo ((is_array($_tmp=$this->_tpl_vars['a']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d") : smarty_modifier_date_format($_tmp, "%y-%m-%d")); ?>
，相片数：<?php echo $this->_tpl_vars['a']['photos_count']; ?>
</label>
      </p>
    </div>
    <?php endfor; endif; ?>
    <div class="nofloat"></div>
    <?php if (count ( $this->_tpl_vars['albums'] ) > 0): ?>
    <p>
      <input type="submit" name="btnDelete" value="删除选中的相册" />
    </p>
    <?php endif; ?>
  </form>
  </p>
</div>
</body>
</html>