CREATE TABLE `admin_permission_menu` (
  `permission_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  KEY `permission_menu_permission_id_menu_id_index` (`permission_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;