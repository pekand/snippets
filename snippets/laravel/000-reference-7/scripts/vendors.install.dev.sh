cd $(dirname $0)/../app
php composer.phar install --dev
npm install
npm run dev
