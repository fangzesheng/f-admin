CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT '权限标识 英文',
  `display_name` varchar(255) DEFAULT NULL COMMENT '权限名称 中文',
  `description` varchar(255) DEFAULT NULL COMMENT '权限描述',
  `controllers` varchar(512) DEFAULT NULL COMMENT '对应的controllers',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;