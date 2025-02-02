up:
	./vendor/bin/sail up -d
build:
	./vendor/bin/sail build --no-cache
stop:
	./vendor/bin/sail down
down:
	./vendor/bin/sail down
restart:
	./vendor/bin/sail restart
ps:
	./vendor/bin/sail ps
migrate:
	./vendor/bin/sail artisan migrate
fresh:
	./vendor/bin/sail artisan migrate:fresh --seed
seed:
	./vendor/bin/sail artisan db:seed
test:
	./vendor/bin/sail test
tinker:
	./vendor/bin/sail artisan tinker
cache:
	./vendor/bin/sail artisan route:clear
	./vendor/bin/sail artisan cache:clear
	./vendor/bin/sail artisan config:clear
	./vendor/bin/sail artisan view:cache
