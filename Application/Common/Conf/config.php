<?php
return array(
    
    'SITE_URL'  => '',
    
    'DB_TYPE'   =>  'mysql',     // 数据库类型
    'DB_HOST'   =>  'localhost', // 服务器地址
    'DB_NAME'   =>  'baidu',     // 数据库名
    'DB_USER'   =>  'root',      // 用户名
    'DB_PWD'    =>  'hadoop123',          // 密码
    'DB_PORT'   =>  '3306',        // 端口
    'DB_PREFIX' =>  'tp_', // 数据库表前缀
    'DB_CHARSET'=>  'utf8', // 字符集
	
    'SHOW_PAGE_TRACE' =>false, 
    'TMPL_TEMPLATE_SUFFIX'  =>  '.php',
    
    'TMPL_L_DELIM'	=>	'<{', //修改左定界符
    'TMPL_R_DELIM'	=>	'}>', //修改右定界符
    	
	'Home_CSS'=>__ROOT__.'/Public/Home/css',
	'Home_JS'=>__ROOT__.'/Public/Home/js',
	'Home_IMG'=>__ROOT__.'/Public/Home/images',

	'Admin_CSS'=>__ROOT__.'/Public/Admin/css',
	'Admin_JS'=>__ROOT__.'/Public/Admin/js',
	'Admin_IMG'=>__ROOT__.'/Public/Admin/images'

);