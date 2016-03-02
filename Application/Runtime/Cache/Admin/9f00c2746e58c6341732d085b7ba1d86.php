<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> 二级联动 </title>
<script language="JavaScript" type="text/javascript">
   //定义了城市的二维数组，里面的顺序跟省份的顺序是相同的。通过selectedIndex获得省份的下标值来得到相应的城市数组
    var city=[
    ["北京","天津","上海","重庆"],
    ["南京","苏州","南通","常州"],
    ["福州","福安","龙岩","南平"],
    ["广州","潮阳","潮州","澄海"],
    ["兰州","白银","定西","敦煌"]
    ];

  function getCity(){
       //获得省份下拉框的对象
        var sltProvince=document.form1.province;
        //获得城市下拉框的对象
        var sltCity=document.form1.city;
         
        //得到对应省份的城市数组
        var provinceCity=city[sltProvince.selectedIndex - 1];

         //清空城市下拉框，仅留提示选项
       sltCity.length=1;

        //将城市数组中的值填充到城市下拉框中
        for(var i=0;i<provinceCity.length;i++){
            sltCity[i+1]=new Option(provinceCity[i],provinceCity[i]);
        }
     }
 </script>
</head>
 
<body>
 <form action="" name="form1" method="post">
         <select name="province" onChange="getCity()">
            <option value="0">请选择所在省份 </option>
           <option VALUE="直辖市">直辖市 </option>
           <option VALUE="江苏省">江苏省 </option>
            <option VALUE="福建省">福建省 </option>
           <option VALUE="广东省">广东省 </option>
           <option VALUE="甘肃省">甘肃省 </option>
       </select>
       <select name="city">
             <option value="0">请选择所在城市 </option>
        </select>
   </form>
</body>
 </html>