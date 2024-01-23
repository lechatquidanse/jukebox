.PHONY: vendor

clear:
	docker-compose down --remove-orphans
install:
	docker-compose run composer
list:
	docker-compose run php bin/console list