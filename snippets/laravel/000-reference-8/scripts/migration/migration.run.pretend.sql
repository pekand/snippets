CreateUsersTable: create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `options` json null default '{}', `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateUsersTable: alter table `users` add unique `users_email_unique`(`email`)
CreatePasswordResetsTable: create table `password_resets` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreatePasswordResetsTable: alter table `password_resets` add index `password_resets_email_index`(`email`)
CreateFailedJobsTable: create table `failed_jobs` (`id` bigint unsigned not null auto_increment primary key, `connection` text not null, `queue` text not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp default CURRENT_TIMESTAMP not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateTicketsTable: create table `tickets` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `description` text not null, `status` varchar(255) not null, `assigned_id` bigint unsigned null, `views` bigint unsigned not null default '0', `deleted_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateTicketsTable: alter table `tickets` add index `tickets_name_index`(`name`)
CreateTicketsTable: alter table `tickets` add constraint `tickets_assigned_id_foreign` foreign key (`assigned_id`) references `users` (`id`)
CreateTable1Table: create table `table1` (`id` bigint unsigned not null auto_increment primary key, `uuid_column` char(36) null comment 'my comment', `boolean_column` tinyint(1) not null default '1', `tinyInteger_column` tinyint not null, `smallInteger_column` smallint not null, `integer_column` int unsigned not null, `mediumInteger_column` mediumint not null, `bigInteger_column` bigint not null, `unsignedTinyInteger_column` tinyint unsigned not null, `unsignedMediumInteger_column` mediumint unsigned not null, `unsignedInteger_column` int unsigned not null, `unsignedSmallInteger_column` smallint unsigned not null, `unsignedBigInteger_column` bigint unsigned not null, `float_column` double(8, 2) not null, `double_column` double(8, 2) not null, `decimal_column` decimal(8, 2) not null, `unsignedDecimal_column` decimal(8, 2) unsigned not null, `char_100_column` char(100) not null, `string_100_column` varchar(100) not null, `lineString_column` linestring not null, `multiLineString_column` multilinestring not null, `text_column` text character set utf8 collate 'utf8_unicode_ci' not null, `mediumText_column` mediumtext not null, `longText_column` longtext not null, `date_column` date not null, `dateTime_column` datetime not null, `dateTimeTz_column` datetime not null, `year_column` year not null, `time_column` time not null, `timeTz_column` time not null, `timestamp_column` timestamp default CURRENT_TIMESTAMP not null, `timestampTz_column` timestamp null, `enum_column` enum('option1', 'option2') not null, `set_column` set('option1', 'option2') not null, `binary_column` blob not null, `json_column` json not null, `jsonb_column` json not null, `deleted_at` timestamp null, `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateTable2Table: create table `table2` (`id` bigint unsigned not null auto_increment primary key, `table1_id` bigint unsigned not null, `user_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateTable2Table: alter table `table2` add constraint `table2_table1_id_foreign` foreign key (`table1_id`) references `table1` (`id`) on delete cascade
CreateTable2Table: alter table `table2` add constraint `table2_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade
UpdateTable2Table: select * from information_schema.tables where table_schema = ? and table_name = ? and table_type = 'BASE TABLE'
Update2Table2Table: alter table `table2` add unique `table2_name_unique`(`name`)
CreateTest3Table: create table `test3` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `status` varchar(255) not null default 'New', `deleted_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateTest4Table: create table `test4` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `status` varchar(255) not null default 'New', `owner_id` bigint unsigned null, `test3_id` bigint unsigned null, `deleted_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateTest4Table: alter table `test4` add constraint `test4_owner_id_foreign` foreign key (`owner_id`) references `users` (`id`) on delete cascade
CreateTest4Table: alter table `test4` add constraint `test4_test3_id_foreign` foreign key (`test3_id`) references `test3` (`id`) on delete cascade
CreateWatcherTable: create table `watcher` (`id` bigint unsigned not null auto_increment primary key, `ticket_id` bigint unsigned not null, `watcher_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
CreateWatcherTable: alter table `watcher` add constraint `watcher_ticket_id_foreign` foreign key (`ticket_id`) references `tickets` (`id`)
CreateWatcherTable: alter table `watcher` add constraint `watcher_watcher_id_foreign` foreign key (`watcher_id`) references `users` (`id`)
CreateTicketinfoTable: create table `ticketinfo` (`id` bigint unsigned not null auto_increment primary key, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
