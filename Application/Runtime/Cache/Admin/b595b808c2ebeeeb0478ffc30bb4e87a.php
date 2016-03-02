<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<frameset rows="10%,90%">
<frame src="<?php echo U('Index/header');?>">
	<frameset cols="20%,80%">

  <frame src="<?php echo U('Index/left');?>" name="left" scrolling="no" noresize />
  <frame src="<?php echo U('Index/main');?>" name="main" noresize/>

</frameset>
</frameset>
</html>