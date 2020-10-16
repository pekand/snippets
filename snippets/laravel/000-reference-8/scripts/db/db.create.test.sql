create database IF NOT EXISTS forge_test character set utf8 collate utf8_general_ci;
create user 'forge_test'@'%' identified by 'forge_test';
grant all privileges on forge_test.* to 'forge_test'@'%' identified by 'forge_test' require none with grant option max_queries_per_hour 0 max_connections_per_hour 0 max_updates_per_hour 0 max_user_connections 0;
grant all privileges on `forge_test`.* to 'forge_test'@'%';