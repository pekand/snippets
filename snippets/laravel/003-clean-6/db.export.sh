current_time=$(date "+%Y-%m-%d.%H-%M-%S")
mysqldump -h localhost -u forge -pforge --databases forge > db.forge.$current_time.sql
