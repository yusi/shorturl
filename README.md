# shorturl

### how to setup
1. git  clone git@github:yusi/shorturl.git
2. cd shorturl
3. ln -s .env_local .env
4. composer install
5. ./vendor/bin/sail up
6. ./vendor/bin/sail artisan migrate
7. ./vendor/bin/sail npm install
8. ./vendor/bin/sail npm run build
