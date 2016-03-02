<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>QQ JS省市区三级联动</title>
<!-- 直接使用QQ的省市区数据 -->
<!--
<script type="text/javascript" src="http://ip.qq.com/js/geo.js"></script>
-->
<script type="text/javascript" src="/thinkPHP/Public/Admin/js/go.js"></script>
</head>
<body onload="setup();preselect('陕西省');promptinfo();">
        <form>
            <select class="select" name="province" id="s1">
              <option></option>
            </select>
            <select class="select" name="city" id="s2">
              <option></option>
            </select>
            <select class="select" name="town" id="s3">
              <option></option>
            </select>
            <input id="address" name="address" type="hidden" value="" />
          <input onclick="alert(document.getElementById('address').value); return false;" type="submit" value="提交" />
        </form>
<script>

//这个函数是必须的，因为在geo.js里每次更改地址时会调用此函数
function promptinfo()
{
    var address = document.getElementById('address');
    var s1 = document.getElementById('s1');
    var s2 = document.getElementById('s2');
    var s3 = document.getElementById('s3');
    address.value = s1.value + s2.value + s3.value;
}

</script>
</body>
</html>