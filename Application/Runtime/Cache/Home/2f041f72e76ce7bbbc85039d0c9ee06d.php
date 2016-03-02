<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>分页展示</title>
 <link rel="stylesheet" type="text/css" href="<?php echo C('Home_CSS');?>/page.css">
</head>
<body>
	<ul>
		<?php foreach($list as $k=>$v){?>
			<li><?php echo $v['name'];?></li>
		<?php }?>
	</ul>
		
	<?php echo ($page); ?>
</body>
</html>