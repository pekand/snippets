cd $(dirname $0)/..
git clone https://github.com/laravel/homestead.git
cd $(dirname $0)/../homestead
git checkout release
./init.sh
