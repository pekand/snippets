CURRENT_SCRIPT_DIR=$(dirname $0)

. clean.sh

cd $CURRENT_SCRIPT_DIR/composer/

bash composer.download.sh

cd $CURRENT_SCRIPT_DIR/vendors/

bash vendors.install.dev.sh
