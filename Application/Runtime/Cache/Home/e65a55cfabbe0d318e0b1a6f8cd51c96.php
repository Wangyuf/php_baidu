<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>使用PHP导入和导出数据为Excel文件</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<style type="text/css">
.demo{width:400px; height:100px; margin:100px auto}
.demo p{line-height:32px}
.btn{width:80px; height:26px; line-height:26px; background:url(btn_bg.gif) repeat-x; border:1px solid #ddd; cursor:pointer}
</style>
</head>

<body>

<div id="main">
  <h2 class="top_title">使用PHP导入和导出数据为Excel文件</h2>
  <div class="demo">
      <form id="addform" action="http://phpexcelreader.dsczs.cn/do.php?action=import" method="post" enctype="multipart/form-data">
         <p>请选择要导入的XLS文件：<br/><input type="file" name="file"> <input type="submit" class="btn" value="导入XLS">
         <input type="button" class="btn" id="exportCSV" value="导出XLS" onClick="window.location.href='http://phpexcelreader.dsczs.cn/do.php?action=export'"></p>
      </form>
  </div>
</div>

</body>
</html>