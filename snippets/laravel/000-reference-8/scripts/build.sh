SCRIPT_PATH=$(dirname $0)
. clean.sh
cd $SCRIPT_PATH
. composer.download.sh
cd $SCRIPT_PATH
. vendors.install.dev.sh
