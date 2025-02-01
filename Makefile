
up:
	sail up -d
build:
	sail build --no-cache
stop:
	sail down
down:
	sail down
restart:
	sail restart
ps:
	docker ps
ssh:
	sail exec app bash
db:
	sail exec mysql bash
sql:
	sail exec mysql bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'

route:
	sail route:list

logs-watch:
	sail logs --follow

cache:
#	sailr dump-autoload -o
	@make optimize
	sail exec app php ./source/artisan route:clear
	sail exec app php ./source/artisan config:clear
	sail exec app php ./source/artisan view:clear

optimize:
	sail exec app php ./source/artisan optimize

# ここより下は動作未確認
#tinker:
#	./vendor/bin/sail artisan tinker
#migrate:
#	./vendor/bin/sail artisan migrate
#migrate-rollback:
#	./vendor/bin/sail artisan migrate:rollback
fresh:
#	./vendor/bin/sail artisan migrate:fresh --seed
	sail artisan migrate:fresh
seeds_dev:
# 開発用データ
	sail exec app php ./source/artisan db:seed --class=DevDatabaseSeeder

#route:
#	sail exec app php ./source/artisan route:list

#shell:
#	./vendor/bin/sail shell
#root-shell:
#	./vendor/bin/sail root-shell
#destroy:
#	sail down --rmi all --volumes --remove-orphans
#destroy-volumes:
#	sail down --volumes --remove-orphans
#route:
#	./vendor/bin/sail artisan route:list
#route-cache:
#	./vendor/bin/sail artisan route:cache
#npm-install:
#	./vendor/bin/sail npm install
#ump-autoload:
#	./vendor/bin/sail composer dump-autoload
#omposer-install:
#	./vendor/bin/sail composer install
#optimize:
#	sail exec app php artisan optimize
#optimize-clear:
#	./vendor/bin/sail artisan optimize:clear
#cache:
#	./vendor/bin/sail composer dump-autoload -o
#	@make optimize
#	sail exec app php artisan route:cache
#	sail exec app php artisan view:cache
#cache-clear:
#	sail exec laravel.test composer clear-cache
#	@make optimize-clear
#	sail exec laravel.test php artisan event:clear
#config-cache:
#	./vendor/bin/sail artisan config:cache
#shell:
#	./vendor/bin/sail root-shell
#tbls:
#	tbls out -t xlsx -o dbdoc/schema.xlsx && tbls out -t svg -o dbdoc/er.svg
#test:
#	./vendor/bin/sail test