<?php
error_reporting(E_ALL & ~ E_DEPRECATED);
define('DEPLOY_MODE', true);
require dirname(__FILE__) . '/FLEA/FLEA.php';
FLEA::import(dirname(__FILE__).'/APP');
FLEA::setAppInf('defaultController','Book');
FLEA::setAppInf('defaultAction','SayTitle');
FLEA::runMVC();
?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<!--<head>-->
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<!--<title>FleaPHP - 为日趋复杂的 Web 应用提供基础架构平台</title>-->
<!--<link href="Stuff/css/css.css" rel="stylesheet" type="text/css" />-->
<!--</head>-->
<!--<body>-->
<!--<div id="header">-->
<!--  <div id="banner">-->
<!--    <div class="b1"><a href="http://www.fleaphp.org/bbs/" target="_blank"><span class="no-display">FleaPHP 论坛</span></a></div>-->
<!--    <div class="b2"><a href="http://www.fleaphp.org/" target="_blank"><span class="no-display">FleaPHP 社区</span></a></div>-->
<!--    <div class="b3"><a href="http://www.qeeyuan.com/contact.html" target="_blank"><span class="no-display">联系我们</span></a></div>-->
<!--    <div class="b4"><a href="http://www.qeeyuan.com/" target="_blank"><span class="no-display">关于我们</span></a></div>-->
<!--    <div class="b5"><a href="index.php"><span class="no-display">欢迎页面</span></a></div>-->
<!--  </div>-->
<!--  <div id="red">-->
<!--    <div class="gets"><a href="http://www.qeeyuan.com" target="_blank"></a></div>-->
<!--    <p><strong>您当前使用的 FleaPHP 版本为 --><?php //echo FLEA_VERSION; ?><!--。</strong></p>-->
<!--    <p>FleaPHP 为开发者轻松、快捷的创建应用程序提供帮助。FleaPHP 框架简单、清晰，容易理解和学习，并且有完全中文化的文档和丰富的示例程序降低学习成本。使用 FleaPHP 框架开发的应用程序能够自动适应各种运行环境，并兼容 PHP4 和 PHP5。</p>-->
<!--    <p>有关 FleaPHP 的详细信息请访问 <a href="http://www.fleaphp.org" target="_blank">FleaPHP 官方网站</a>。</p>-->
<!--  </div>-->
<!--</div>-->
<!--<div id="main">-->
<!--  <div id="sidebar">-->
<!--    <ul>-->
<!--      <li><img src="Stuff/images/page_bookmark.gif" border="0" align="absmiddle" />&nbsp;<a href="http://www.fleaphp.org/index.php?q=guide" target="_blank">在线阅读 FleaPHP 开发指南</a></li>-->
<!--      <li><img src="Stuff/images/page_bookmark.gif" border="0" align="absmiddle" />&nbsp;<a href="http://www.fleaphp.org.cn/downloads/apidoc/index.html" target="_blank">在线阅读 API 文档</a></li>-->
<!--      <li><img src="Stuff/images/icon_download.gif" border="0" align="absmiddle" />&nbsp;<a href="http://www.fleaphp.org/index.php?q=download" target="_blank">下载最新版 FleaPHP</a></li>-->
<!--      <li><img src="Stuff/images/icon_user.gif" border="0" align="absmiddle" />&nbsp;<a href="http://www.fleaphp.org/bbs/" target="_blank">访问 FleaPHP 论坛</a></li>-->
<!--      <li><img src="Stuff/images/icon_favourites.gif" border="0" align="absmiddle" />&nbsp;<a href="http://www.fleaphp.org/index.php?q=livesites" target="_blank">查看 FleaPHP 实际应用列表</a></li>-->
<!--      <li><img src="Stuff/images/icon_security.gif" border="0" align="absmiddle" />&nbsp;<a href="http://www.qeeyuan.com/" target="_blank">获取技术支持</a></li>-->
<!--    </ul>-->
<!--  </div>-->
<!--  <h4>体验 FleaPHP</h4>-->
<!--  <p>要体验 FleaPHP 的非凡魅力，可以首先从 FleaPHP 带有的示例程序开始。<br />-->
<!--    FleaPHP 提供了多个示例程序。这些示例程序充分展示了 FleaPHP 如何应付各种不同的需求。</p>-->
<!--  <p>&nbsp;</p>-->
<!--  <h4><a href="Install/index.php">运行示例程序安装向导</a></h4>-->
<!--  <p>您必须在成功 <a href="Install/index.php"><strong>运行示例程序安装向导</strong></a> 后才能运行下面的示例程序。<a href="../phpinfo.php" target="_blank">检查服务器环境</a>。<br />-->
<!--  这个安装向导会为示例程序的运行做一些准备工作，其中主要是创建示例程序需要的数据表。</p>-->
<!---->
<!--  --><?php //if (!is_readable(dirname(__FILE__) . '/Example/_Shared/DSN.php')): ?>
<!--  <p class="warning">您还没有运行过示例程序安装向导，部分需要数据库操作的示例将无法运行。</p>-->
<!--  --><?php //endif; ?>
<!---->
<!--  <p>&nbsp;</p>-->
<!--  <h4>示例分类</h4>-->
<!--  <div id="category">-->
<!--    <ul>-->
<!--      <li><a href="#demo-basic">基础概念认识</a></li>-->
<!--      <li><a href="#demo-database">数据处理</a></li>-->
<!--      <li><a href="#demo-ui">创建用户界面</a></li>-->
<!--      <li><a href="#demo-cases">综合示例</a></li>-->
<!--    </ul>-->
<!--    <div class="clear-float"></div>-->
<!--  </div>-->
<!--  <a name="demo-basic" id="demo-basic"></a>-->
<!--  <div class="list">-->
<!--    <h2>基础概念认识</h2>-->
<!--    <ul>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/MVC-Blog/index.php" target="_blank">MVC-Blog</a></h3>-->
<!--        <p>用一个简化的 Blog 程序演示 FleaPHP 的 MVC 模式和自动化的数据库 CRUD（创建、读取、更新、删除）操作。该示例程序还有同等功能的 Zend Framework 版本，点击查看。</p>-->
<!--        <div class="difficulty">复杂度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /><span class="fuza">&nbsp;&nbsp;学习难度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /></span></div>-->
<!--		<p class="memo">-->
<!--		知识点：FleaPHP 中的 MVC 模式和基本的数据库 CRUD 操作<br />-->
<!--		使用的数据表：mvc_blog_posts(Blog 文章)<br />-->
<!--		使用的模板引擎： 无-->
<!--		</p>-->
<!--      </li>-->
<!---->
<!--    </ul>-->
<!--  </div>-->
<!--  <a name="demo-database" id="demo-database"></a>-->
<!--  <div class="list">-->
<!--    <h2>数据处理</h2>-->
<!--    <ul>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/ImportExport/index.php" target="_blank">Import & Export</a></h3>-->
<!--        <p>演示如何将 CSV 文件导入数据库，以及将数据库内容导出为 CSV 文件。</p>-->
<!--        <p>复杂度: <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /> &nbsp;-->
<!--          学习难度: <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /> </p>-->
<!--		<p class="memo">-->
<!--		知识点：CSV 的读取、分析、错误处理以及导出<br />-->
<!--		使用的数据表：import_data(要导入导出的数据)<br />-->
<!--		使用的模板引擎： 无-->
<!--		</p>-->
<!--      </li>-->
<!---->
<!--    </ul>-->
<!--  </div>-->
<!--  <a name="demo-ui" id="demo-ui"></a>-->
<!--  <div class="list">-->
<!--    <h2>创建用户界面</h2>-->
<!--    <ul>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/Smarty/index.php" target="_blank">Smarty</a></h3>-->
<!--        <p>演示如何将 FleaPHP 和流行的 Smarty 模版引擎集成起来。</p>-->
<!--		<p class="memo">-->
<!--		知识点：在 FleaPHP 应用程序中使用 Smarty 模板引擎<br />-->
<!--		使用的数据表：无<br />-->
<!--		使用的模板引擎： Smarty-->
<!--		</p>-->
<!--        <div class="difficulty">复杂度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /><span class="fuza">&nbsp;&nbsp;学习难度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /></span></div>-->
<!--      </li>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/Ajax/index.php" target="_blank">Ajax-Basic</a></h3>-->
<!--        <p>这个示例演示了 FleaPHP 的 Ajax 基本使用。</p>-->
<!--		<p class="memo">-->
<!--		知识点：使用 FleaPHP 的 Ajax 组件实现 Ajax 功能<br />-->
<!--		使用的数据表：无<br />-->
<!--		使用的模板引擎： 无-->
<!--		</p>-->
<!--        <div class="difficulty">复杂度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /><span class="fuza">&nbsp;&nbsp;学习难度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /></span></div>-->
<!--      </li>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/Album/index.php" target="_blank">Album</a></h3>-->
<!--        <p>这个示例是一个简单的相册程序。演示了如何处理上传及生成缩略图。</p>-->
<!--		<p class="memo">-->
<!--		知识点：文件上传、图像处理<br />-->
<!--		使用的数据表：album_albums(相册)、album_photos(相片记录)<br />-->
<!--		使用的模板引擎： Smarty-->
<!--		</p>-->
<!--        <div class="difficulty">复杂度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /><span class="fuza">&nbsp;&nbsp;学习难度： <img src="Stuff/images/s1.png" width="60" height="18" align="absmiddle" /></span></div>-->
<!--      </li>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/DynamicMenu/index.php" target="_blank">DynamicMenu</a></h3>-->
<!--        <p>这个示例演示了用 WebControls 机制封装现有的 JavaScript 组件，以及根据用户角色决定要显示的菜单项目等功能。</p>-->
<!--		<p class="memo">-->
<!--		知识点：WebControls 机制、基于角色的访问控制、关联用户角色和界面<br />-->
<!--		使用的数据表：dm_sysmenu(保存菜单数据)、dm_sysroles(用户角色)、dm_sysroles_group(角色组)<br />-->
<!--		封装的 JavaScript 组件：JSCookMenu<br />-->
<!--		使用的模板引擎： Smarty-->
<!--		</p>-->
<!--        <div class="difficulty">复杂度： <img src="Stuff/images/s2.png" width="60" height="18" align="absmiddle" /><span class="fuza">&nbsp;&nbsp;学习难度： <img src="Stuff/images/s2.png" width="60" height="18" align="absmiddle" /></span></div>-->
<!--      </li>-->
<!---->
<!--    </ul>-->
<!--  </div>-->
<!--  <a name="demo-cases" id="demo-cases"></a>-->
<!--  <div class="list">-->
<!--    <h2>综合示例</h2>-->
<!--    <ul>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/Blog/index.php" target="_blank">Blog</a></h3>-->
<!--        <p>略微复杂一些的 Blog 程序，比起 MVC-Blog 增加了评论、标签等功能。</p>-->
<!--        <p>复杂度: <img src="Stuff/images/s2.png" width="60" height="18" align="absmiddle" /> &nbsp;-->
<!--          学习难度: <img src="Stuff/images/s3.png" width="60" height="18" align="absmiddle" /> </p>-->
<!--		<p class="memo">-->
<!--		知识点：基本的数据库关联操作<br />-->
<!--		使用的数据表：blog_posts(博客文章)、blog_comments(博客评论)、blog_tags(标签)、blog_posts_has_tags(文章和标签之间的关联)<br />-->
<!--		使用的模板引擎： 无-->
<!--		</p>-->
<!--      </li>-->
<!---->
<!--      <li>-->
<!--        <h3><a href="Example/SHOP/index.php" target="_blank">SHOP</a></h3>-->
<!--        <p>这个示例是从一个实际应用程序的后台管理部分简化而来。演示了 FleaPHP 提供的多语言支持、与编码无关的程序代码和数据库操作、文件上传、图像处理、数据表关联等特征。</p>-->
<!--		<p class="memo">-->
<!--		知识点：多语言界面、复杂的数据库操作、改进型现根遍历算法实现的无限分类、图片上传<br />-->
<!--		使用的数据表：shop_products(产品信息)、shop_products_to_classes(产品具有的分类)、shop_product_classes(分类)、<br />-->
<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		shop_product_photos(产品图片)、shop_sysroles(系统角色)、shop_sysusers(系统用户)、shop_sysusers_has_sysroles(用户具有的角色)<br />-->
<!--		使用的模板引擎： 无-->
<!--		</p>-->
<!--        <div class="difficulty">复杂度： <img src="Stuff/images/s3.png" width="60" height="18" align="absmiddle" /><span class="fuza">&nbsp;&nbsp;学习难度： <img src="Stuff/images/s3.png" width="60" height="18" align="absmiddle" /></span></div>-->
<!--      </li>-->
<!---->
<!--    </ul>-->
<!--  </div>-->
<!--</div>-->
<!--<div id="footer">-->
<!--  <div id="footer-show"><a href="http://www.fleaphp.org/" target="_blank">FleaPHP 开放源代码项目</a>为您创建高品质 Web 应用提供帮助。-->
<!--    &nbsp;&nbsp;&nbsp;&nbsp;-->
<!--    &copy; 2005-2008 <a href="http://www.qeeyuan.com/" target="_blank">自贡市起源科技有限公司</a> </div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->
