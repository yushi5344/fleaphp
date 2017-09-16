<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MVC-Blog</title>
</head>
<body>

<h1><?php echo h($post['title']);?></h1>

<p><small>Created: <?php echo $post['created'];?></small></p>

<p><?php echo t($post['body']); ?></p>
<a href="<?php echo url('Post', 'Index'); ?>">跳回首页</a>
</body>
</html>