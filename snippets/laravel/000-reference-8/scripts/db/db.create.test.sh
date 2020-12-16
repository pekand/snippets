echo $DB_USERNAME $DB_PASSWORD
mysql -u"${DB_USERNAME}" -p"${DB_PASSWORD}" < db.create.test.sql
read -p "done"
