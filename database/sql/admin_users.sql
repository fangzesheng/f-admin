CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `email` varchar(255) NOT NULL COMMENT '邮件',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `sex` smallint(3) NOT NULL DEFAULT 1 COMMENT '性别, 1为男,2为女',
  `password` varchar(60) NOT NULL COMMENT '密码',
  `remember_token` varchar(100) DEFAULT NULL COMMENT 'TOKEN',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '管理用户表';