create database IF NOT EXISTS forge character set utf8 collate utf8_general_ci;
create user 'forge'@'%' identified by 'forge';
grant all privileges on forge.* to 'forge'@'%' identified by 'forge' require none with grant option max_queries_per_hour 0 max_connections_per_hour 0 max_updates_per_hour 0 max_user_connections 0;
grant all privileges on `forge`.* to 'forge'@'%';