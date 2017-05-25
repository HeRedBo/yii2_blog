create database `yii2_blog` default charset=utf8;

-- table yii2_blog
CREATE TABLE `yii_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(255) NOT NULl DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL DEFAULT '' COMMENT '文章内容',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='博客文章表';


-- 用户信息表
CREATE TABLE `yii_user_backend` (
	`id` INT (11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
	`username` VARCHAR (255) NOT NULL DEFAULT '' COMMENT '用户名',
	`auth_key` VARCHAR (32) NOT NULL DEFAULT '' COMMENT '签名key',
	`password_hash` VARCHAR (255) NOT NULL DEFAULT '' COMMENT '登录密码',
	`email` VARCHAR (255) NOT NULL DEFAULT '' COMMENT '用户邮箱',
	`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
	`updated_at` datetime NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
	PRIMARY KEY (`id`),
	UNIQUE KEY `idx_username` (`username`),
	UNIQUE KEY `idx_email` (`email`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT '后台信息表';
