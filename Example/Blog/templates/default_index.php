<?php if (!defined('APP_DIR')) { exit('EXIT'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的博客</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="all">

  <div id="header">
    <h1>我的博客</h1>
  </div>

  <div id="nav">
	<?php if (!empty($current_tag)): ?>
    <a href="<?php echo $this->_url(); ?>">全部文章</a>
    <a href="<?php echo $this->_url(null, array('tag_id' => $current_tag['tag_id'])); ?>" class="current">分类[<?php echo h($current_tag['label']); ?>]的文章列表</a>
	<?php else: ?>
    <a href="<?php echo $this->_url(); ?>" class="current">文章列表</a>
	<?php endif; ?>
	<a href="<?php echo $this->_url('edit'); ?>">写新文章</a>
  </div>
  
  <div id="content">
  
    <div id="main">
      <?php foreach ($posts as $post_offset => $post): ?>
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
	  
	  <?php if (isset($posts[$post_offset + 1])): ?>
      <hr />
	  <?php endif; ?>
	  
      <?php endforeach; ?>
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
