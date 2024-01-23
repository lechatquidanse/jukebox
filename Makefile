.PHONY: vendor
TRACK_NUMBERS := 1 2 3


clear:
	docker-compose down --remove-orphans
install:
	docker-compose build && docker-compose run composer
list:
	docker-compose run php bin/console list
play:
	docker-compose run php bin/console play $(TRACK_NUMBERS)
queue:
	docker-compose run php bin/console queue
unit-test:
	docker-compose run php bin/phpunit tests

