<?php if (!defined('APP_DIR')) { exit('EXIT'); } ?>
      <div id="tags_cloud">
	  <h3>文章分类：</h3>
	  <?php foreach ($tags as $tag): ?>
	  <a href="<?php echo $this->_url(null, array('tag_id' => $tag['tag_id'])); ?>"><?php echo h($tag['label']); ?></a>&nbsp;
	  <?php endforeach; ?>
	  </div>
      <div id="recent_comments">
	  <h3>最近评论：</h3>
	  <?php foreach ($comments as $comment): ?>
	  <a href="<?php echo $this->_url('view', array('post_id' => $comment['post_id'])); ?>"><?php echo date('Y年m月d日 H:i', $comment['created']); ?></a>
	  <div class="comment_body"><?php echo h(mb_strimwidth(strip_tags($comment['body']), 0, 100, '...', 'utf8')); ?></div>
	  <?php endforeach; ?>
	  </div>
