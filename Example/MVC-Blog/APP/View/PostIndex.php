<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MVC-Blog</title>
</head>
<body>
<h1>浏览帖子</h1>
<table>
    <tr>
        <th>Id</th>
        <th>标题</th>
        <th>发帖时间</th>
    </tr>

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['id']; ?></td>
        <td>
            <a href="<?php echo url('Post', 'View', array('id' => $post['id'])); ?>"><?php echo h($post['title']); ?></a>
        </td>
        <td><?php echo $post['created']; ?></td>
        <td>
            <a href="<?php echo url('Post', 'Delete', array('id' => $post['id'])); ?>">删除帖子</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<br />
<br />
<a href="<?php echo url('Post', 'Add'); ?>">添加帖子</a>

</body>
</html>