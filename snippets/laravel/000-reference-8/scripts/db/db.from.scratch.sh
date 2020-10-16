cd $(dirname "$0")
. db.drop.sh
. db.create.sh
. ../migration/migration.run.and.seed.sh
read -p "Press enter to continue"
