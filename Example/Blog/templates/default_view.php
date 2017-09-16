<?php if (!defined('APP_DIR')) { exit('EXIT'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo h ($post['title']); ?> - 我的博客</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="all">

  <div id="header">
    <h1>我的博客</h1>
  </div>

  <div id="nav">
    <a href="<?php echo $this->_url(); ?>">文章列表</a>
	<a href="<?php echo $this->_url('edit'); ?>">写新文章</a>
    <a href="<?php echo $this->_url('view', array('post_id' => $post['post_id'])); ?>" class="current"><?php echo h($post['title']); ?></a>
  </div>
  
  <div id="content">
  
    <div id="main">
      <h3><a href="<?php echo $this->_url('view', array('post_id' => $post['post_id'])); ?>"><?php echo h($post['title']); ?></a></h3>
      <p class="created">
	    <?php echo date('Y年m月d日 H:i', $post['created']); ?>
		<a href="<?php echo $this->_url('edit', array('post_id' => $post['post_id'])); ?>">编辑</a>
		<a href="<?php echo $this->_url('delete', array('post_id' => $post['post_id'])); ?>" onclick="return confirm('您确定要删除该篇文章？');">删除</a>
	  </p>
      <div class="body"><?php echo $this->_formatPost($post['body']); ?></div>
      <p class="meta"> 类别:
        <?php foreach ($post['tags'] as $offset => $tag): ?>
        <a href="<?php echo $this->_url(null, array('tag_id' => $tag['tag_id'])); ?>" title="查看该类别的所有文章"><?php echo h($tag['label']); ?></a>
        <?php if (isset($post['tags'][$offset + 1])): ?>,<?php endif; ?>
        <?php endforeach; ?>
        <span>|</span>
		<a href="<?php echo $this->_url('view', array('post_id' => $post['post_id'])); ?>">评论(<?php echo $post['comments_count']; ?>)</a>
		<span>|</span>
		<a href="">浏览</a>
	  </p>
	  
      <hr />
          
      <h3>相关文章：</h3>
          
      <?php
      $passed = array($post['post_id'] => true);
      foreach ($post['tags'] as $tag):
        foreach ($tag['posts'] as $related):
          if (isset($passed[$related['post_id']])) { continue; }
          $passed[$related['post_id']] = true;
      ?>
      <?php echo date('Y/m/d', $related['created']); ?> <a href="<?php echo $this->_url('view', array('post_id' => $related['post_id'])); ?>"><?php echo h($related['title']); ?></a><br />
      <?php endforeach; endforeach; ?>
	  
	  <hr />

	  <div id="comments">
	  	<h3>网友评论：</h3>
		
		<?php foreach ((array)$post['comments'] as $offset => $comment): ?>
		  <p class="created">
		    #<?php echo $offset + 1; ?>
		    <?php echo date('Y年m月d日 H:i', $comment['created']); ?>
			<a href="<?php echo $this->_url('deleteComment', array('comment_id' => $comment['comment_id'])); ?>" onclick="return confirm('您确定要删除该评论？');">删除</a>
		  </p>
		  <div class="comment_body">
		    <?php echo $comment['body']; ?>
		  </div>
		  
		<?php endforeach; ?>
		
	  </div>

      <p>&nbsp;</p>
	  
      <form id="form1" method="post" action="<?php echo $this->_url('submitComment'); ?>" onsubmit="if (this.body.value == '') { alert('请输入评论内容'); return false; } else { return true; }">
        <label>添加评论内容：</label>
		<span class="created">可以使用 BBCode 格式化内容</span>
		<br />
        <textarea name="body" rows="12" class="textbox"></textarea>
		<br />
		<br />
		<input type="submit" name="Submit" value="添加评论" />
		<input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>" />
	  </form>

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
