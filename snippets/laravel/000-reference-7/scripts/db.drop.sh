
if [ "$#" -eq  "0" ]
then
DBNAME=forge
else
DBNAME=$1
fi
mysql -u"${DB_USERNAME}" -p"${DB_PASSWORD}" -e  "DROP USER '${DBNAME}'@'%';DROP DATABASE IF EXISTS ${DBNAME};"
