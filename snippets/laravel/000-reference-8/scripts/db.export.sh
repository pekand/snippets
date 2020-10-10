current_time=$(date "+%Y-%m-%d.%H-%M-%S")
mysqldump -h localhost -u"${DB_USERNAME}" -p"${DB_PASSWORD}" --databases forge > db.forge.$current_time.sql
