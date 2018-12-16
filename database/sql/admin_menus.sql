CREATE TABLE `admin_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '菜单排序,从1开始,数字越小排在超前,0为排在最后',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `icon` varchar(50) NOT NULL COMMENT '图标',
  `uri` varchar(50) NOT NULL COMMENT 'URI',
  `routes` varchar(256) DEFAULT NULL COMMENT '路由,如url:/menu,controller:MenuController',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '菜单表';