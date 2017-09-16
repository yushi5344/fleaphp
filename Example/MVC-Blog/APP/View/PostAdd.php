<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MVC-Blog</title>
</head>
<body>
<h1>发贴</h1>

  <form action="<?php echo url('Post', 'Save'); ?>" method="POST">

  <p>标题:<br /><input type="text" name="title" size="50" /></p>

  <p>内容:<br /><textarea name="content" cols="50" rows="12"></textarea></p>

  <p><input type="submit" value="Add POST" /></p>
</body>

</html>