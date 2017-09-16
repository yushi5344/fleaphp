<?php if (!defined('APP_DIR')) { exit('EXIT'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (!empty($post['post_id'])): ?><?php echo h ($post['title']); ?><?php else: ?>新文章<?php endif; ?> - 我的博客</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">

function checkForm(form)
{
	if (form["title"].value == '') {
		alert('必须输入文章标题');
		form["title"].focus();
		return false;
	}
	
	if (form["body"].value == '') {
		alert('必须输入文章内容');
		form["body"].focus();
		return false;
	}
	
	if (form["tags"].value == '') {
		alert('必须输入文章分类');
		form["tags"].focus();
		return false;
	}
	
	return true;
}

</script>
</head>
<body>
<div id="all">

  <div id="header">
    <h1>我的博客</h1>
  </div>

  <div id="nav">
    <a href="<?php echo $this->_url(); ?>">文章列表</a>
	<?php if (!empty($post['post_id'])): ?>
    <a href="<?php echo $this->_url('edit'); ?>">写新文章</a>
    <a href="<?php echo $this->_url('view', array('post_id' => $post['post_id'])); ?>"><?php echo h($post['title']); ?></a>
    <a href="<?php echo $this->_url('edit', array('post_id' => $post['post_id'])); ?>" class="current">编辑</a>
	<?php else: ?>
    <a href="<?php echo $this->_url('edit'); ?>" class="current">写新文章</a>
	<?php endif; ?>
  </div>
  
  <div id="content">
  
    <div id="main">
	  <form name="form1" method="post" action="<?php echo $this->_url('submitPost'); ?>" onsubmit="return checkForm(this);">
	    <p>
		  <label>文章标题：</label>
		  <?php if (!empty($post['created'])): ?>
		    <span class="created">创建日期：<?php echo date('Y年m月d日 H:i', $post['created']); ?></span>
		  <?php endif; ?>
		  <br />
		  <?php $ui->control('textbox', 'title', array('maxlength' => 128, 'class' => 'textbox', 'value' => $post['title'])); ?>
		</p>
		
		<p>
		  <label>文章内容：</label>
		  <span class="created">可以使用 BBCode 格式化内容</span>
		  <br />
		  <?php $ui->control('memo', 'body', array('rows' => 20, 'class' => 'textbox', 'value' => $post['body'])); ?>
		</p>
		
		<p>
		  <label>所属分类：</label>
		  <span class="created">
		    多个类别间请用空格分隔
		  </span>
		  <br />
          <?php $labels = array(); foreach ($post['tags'] as $tag) { $labels[] = $tag['label']; } ?>
		  <?php $ui->control('textbox', 'tags', array('class' => 'textbox', 'value' => implode(' ', $labels))); ?>
		</p>
		
		<?php $ui->control('hidden', 'post_id', array('value' => $post['post_id'])); ?>
		
		<input type="submit" name="Submit" value="  提 交  " />
		
		<?php if (!empty($post['comments_count'])): ?>
        <p class="meta">
		  评论(<?php echo $post['comments_count']; ?>)
	    </p>
		<?php endif; ?>

	  </form>
	  
	  <?php if (!empty($post['comments'])): ?>
	  
      <hr />
	  
	  <div id="comments">
	  	<h3>网友评论：</h3>
		
		<?php foreach ((array)$post['comments'] as $offset => $comment): ?>
		  <p class="created">#<?php echo $offset + 1; ?> <?php echo date('Y年m月d日 H:i', $comment['created']); ?></p>
		  <div class="comment_body">
		    <?php echo $comment['body']; ?>
		  </div>
		  
		<?php endforeach; ?>
		
	  </div>
	  
	  <?php endif; ?>

      <p>&nbsp;</p>
	  
    </div>
	
    <div id="sidebar">
	  <?php include dirname(__FILE__) . '/_block_sidebar.php'; ?>
    </div>
	
    <div class="nofloat"></div>
	
  </div>
  
  <div id="footer">
    Powered by FleaPHP <?php echo FLEA_VERSION; ?>
  </div>
  
</div>
</body>
</html>
