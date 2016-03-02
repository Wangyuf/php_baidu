/*
MySQL Backup
Source Server Version: 5.6.19
Source Database: baidu
Date: 2015/8/6 10:30:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `tp_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `listorder` int(10) DEFAULT '0',
  `ip` varchar(255) DEFAULT NULL,
  `loginnum` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tp_tbqd`
-- ----------------------------
DROP TABLE IF EXISTS `tp_tbqd`;
CREATE TABLE `tp_tbqd` (
  `userid` int(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0表示未签到，1表示签到了',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tp_tieba`
-- ----------------------------
DROP TABLE IF EXISTS `tp_tieba`;
CREATE TABLE `tp_tieba` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `md5name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `jingyan` int(10) DEFAULT '0',
  `level` int(10) DEFAULT '0' COMMENT '贴吧等级',
  `listorder` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=618 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1','xiaogangshagua','hadoop123','1438827124','0','0','127.0.0.1','10');
INSERT INTO `tp_tbqd` VALUES ('1','2015-08-06','1');
INSERT INTO `tp_tieba` VALUES ('597','1','地下城与勇士','1f16f6fe98db1d5d3573cba1d1276a33','http://tieba.baidu.com/f?kw=%B5%D8%CF%C2%B3%C7%D3%EB%D3%C2%CA%BF','1438827319','0','72','5','0'), ('598','1','java','93f725a07423fe1c889f448b33d21f46','http://tieba.baidu.com/f?kw=java','1438827319','0','59','5','0'), ('599','1','php','e1bfd762321e409cee4ac0b6e841963c','http://tieba.baidu.com/f?kw=php','1438827319','0','55','5','0'), ('600','1','linux','e206a54e97690cce50cc872dd70ee896','http://tieba.baidu.com/f?kw=linux','1438827319','0','53','5','0'), ('601','1','oracle','a189c633d9995e11bf8607170ec9a4b8','http://tieba.baidu.com/f?kw=oracle','1438827319','0','53','5','0'), ('602','1','mysql','81c3b080dad537de7e10e0987a4bf52e','http://tieba.baidu.com/f?kw=mysql','1438827319','0','53','5','0'), ('603','1','李毅','b4e9c7d9986d00ec26e0562ea336ac05','http://tieba.baidu.com/f?kw=%C0%EE%D2%E3','1438827319','0','47','4','0'), ('604','1','qq','099b3b060154898840f0ebdfb46ec78f','http://tieba.baidu.com/f?kw=qq','1438827319','0','11','2','0'), ('605','1','穷游','d831b964ca158511ecce9cad17bda887','http://tieba.baidu.com/f?kw=%C7%EE%D3%CE','1438827319','0','5','2','0'), ('606','1','爱','8f743c2c688f153105c795acba557f80','http://tieba.baidu.com/f?kw=%B0%AE','1438827319','0','3','1','0'), ('607','1','动漫','174f9fd3c0b57206c60e357d4c677315','http://tieba.baidu.com/f?kw=%B6%AF%C2%FE','1438827319','0','3','1','0'), ('608','1','木吉铁平','3578b8b7b31af853fc79342c1d93f80a','http://tieba.baidu.com/f?kw=%C4%BE%BC%AA%CC%FA%C6%BD','1438827319','0','3','1','0'), ('609','1','死神','39eb45c85f1362d24efcc5ef027706b1','http://tieba.baidu.com/f?kw=%CB%C0%C9%F1','1438827319','0','3','1','0'), ('610','1','燃战','37dc3cca5a4e1de08baed0d53c6a2437','http://tieba.baidu.com/f?kw=%C8%BC%D5%BD','1438827319','0','3','1','0'), ('611','1','灰原哀','de6494e85d79e33291c6f942ee854670','http://tieba.baidu.com/f?kw=%BB%D2%D4%AD%B0%A7','1438827319','0','3','1','0'), ('612','1','动感新时代','e0c98bedd90bd7e2b96b79146dc028bb','http://tieba.baidu.com/f?kw=%B6%AF%B8%D0%D0%C2%CA%B1%B4%FA','1438827319','0','3','1','0'), ('613','1','夹在我女友和青梅竹马间的各种修罗场','16809750b30bc377c5042395a6db8bdf','http://tieba.baidu.com/f?kw=%BC%D0%D4%DA%CE%D2%C5%AE%D3%D1%BA%CD%C7%E0%C3%B7%D6%F1%C2%ED%BC%E4%B5%C4%B8%F7%D6%D6%D0%DE%C2%DE%B3%A1','1438827319','0','3','1','0'), ('614','1','黑子的篮球','916d306370f457c863c7a5e1cd46364c','http://tieba.baidu.com/f?kw=%BA%DA%D7%D3%B5%C4%C0%BA%C7%F2','1438827319','0','3','1','0'), ('615','1','火影忍者','7b79a77be32ee0e5d4a0b7a07370e13e','http://tieba.baidu.com/f?kw=%BB%F0%D3%B0%C8%CC%D5%DF','1438827319','0','3','1','0'), ('616','1','拍立得','a29f8b971a4142ef58255e3f8541bd13','http://tieba.baidu.com/f?kw=%C5%C4%C1%A2%B5%C3','1438827319','0','3','1','0'), ('617','1','美图','ff97113f75b206883c1687d46385f9a1','http://tieba.baidu.com/f?kw=%C3%C0%CD%BC','1438827320','0','1','1','0');
