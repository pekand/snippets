create database IF NOT EXISTS laravel character set utf8 collate utf8_general_ci;
create user 'laravel'@'%' identified by 'laravel';
grant all privileges on laravel.* to 'laravel'@'%' identified by 'laravel' require none with grant option max_queries_per_hour 0 max_connections_per_hour 0 max_updates_per_hour 0 max_user_connections 0;
grant all privileges on `laravel`.* to 'laravel'@'%';