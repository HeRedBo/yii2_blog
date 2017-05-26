create database `yii2_blog` default charset=utf8;

-- table yii2_blog
CREATE TABLE `yii_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(255) NOT NULl DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
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
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT '后台用户表';

-- yii2 rabc 
drop table if exists `yii_auth_assignment`;
drop table if exists `yii_auth_item_child`;
drop table if exists `yii_auth_item`;
drop table if exists `yii_auth_rule`;


create table `yii_auth_rule`
(
   `name`                 varchar(64) not null,
   `data`                 blob,
   `created_at`           integer,
   `updated_at`           integer,
    primary key (`name`)
) engine InnoDB;


-- 用于存储角色、权限和路由
create table `yii_auth_item`
(
   `name` varchar(64) not null,
   `type` smallint not null,
   `description` text,
   `rule_name`  varchar(64),
   `data` blob,
   `created_at`  integer,
   `updated_at`  integer,
   primary key (`name`),
   foreign key (`rule_name`) references `yii_auth_rule` (`name`) on delete set null on update cascade,
   key `type` (`type`)
) engine InnoDB;

-- 角色-权限的关联表
create table `yii_auth_item_child`
(
   `parent` varchar(64) not null,
   `child`  varchar(64) not null,
   primary key (`parent`, `child`),
   foreign key (`parent`) references `yii_auth_item` (`name`) on delete cascade on update cascade,
   foreign key (`child`) references `yii_auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

-- 用户-角色的关联表
create table `yii_auth_assignment`
(
   `item_name` varchar(64) not null,
   `user_id`   varchar(64) not null,
   `created_at` integer,
   primary key (`item_name`, `user_id`),
   foreign key (`item_name`) references `yii_auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;


>>>>>>> f473a62b8557979e20ce2a795b6393289b621ee9
