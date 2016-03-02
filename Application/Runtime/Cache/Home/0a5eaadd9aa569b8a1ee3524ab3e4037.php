<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>PHP利用smtp类发送邮件范例</title>
<script src="/Public/Home/formvalidator/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="/Public/Home/formvalidator/formValidator-4.1.3.js" type="text/javascript" charset="UTF-8"></script>
<script src="/Public/Home/formvalidator/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script>

<script type="text/javascript">
 $(document).ready(function(){
  $.formValidator.initConfig({formID:"form1",onError:function(){alert("校验没有通过，具体错误请看错误提示")}});
  $("#smtpusermail").formValidator({onShow:"请输入发件人",onFocus:"请输入发件人",onCorrect:"正确"})
	  .regexValidator({
		  regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",
		  onError:"你输入的邮箱格式不正确"}
	  );
  $("#smtppass").formValidator({onShow:"",onFocus:"发件人密码",onCorrect:"密码正确"})
  .inputValidator({
      min: 1,
      max: 50,
      onerrormin: "不能为空",
      onerrormax: "不超过50个字符，汉字算两个字符"
  });
  $("#toemail").formValidator({onShow:"",onFocus:"请输入收件人",onCorrect:"正确"})
	  .regexValidator({
		  regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",
		  onError:"你输入的邮箱格式不正确"}
	  );
 });
</script>

</head>
<body>
<form action="http://sendmail.dsczs.cn/sendmail.php" method="post" name="form1" id="form1">

	<table border="0px" style="font-size:12px" >
		<tr> 
			<td align="center">发件人:</td>
			<td><input type="text" id="smtpusermail" name="smtpusermail" style="width:200px" value="" /></td>
			<td><div id="smtpusermailTip" style="width:280px" ></div></td>
		</tr>
		<tr> 
			<td align="center">密码:</td>
			<td><input type="password" id="smtppass" name="smtppass" style="width:200px" value="" /></td>
			<td><div id="smtppassTip" style="width:280px"></div></td>
		</tr>
		<tr> 
			<td align="center">收件人:</td>
			<td><input type="text" id="toemail" name="toemail" style="width:200px" value="" /></td>
			<td><div id="toemailTip" style="width:280px"></div></td>
		</tr>
		<tr> 
			<td align="center">标题:</td>
			<td><input type="text" id="title" name="title" style="width:200px" value="" /></td>
			<td><div id="titleTip" style="width:280px"></div></td>
		</tr>
		<tr> 
			<td align="center">内容:</td>
			<td><textarea name="content" cols="50" rows="5"></textarea></td>
		</tr>
	</table>
	
	<input type="submit" name="button" id="button" value="提交" />
</form>
    
</body>
</html>