.PHONY: vendor

clear:
	docker-compose down --remove-orphans
install:
	docker-compose run composer
list:
	docker-compose run php bin/console list
unit-test:
	docker-compose run php bin/phpunit tests

