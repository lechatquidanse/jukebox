.PHONY: vendor
TRACK_NUMBERS := 101 102 103


######################################################
###  Init ::
######################################################
clear:
	docker-compose down --remove-orphans
install:
	docker-compose build && docker-compose run --rm composer && docker-compose up -d
migrate-database:
	docker-compose run --rm php bin/doctrine orm:schema-tool:update --force --dump-sql

######################################################
###  Feature ::
######################################################
populate-jukebox:
	docker-compose run --rm php bin/console populate-jukebox
list:
	docker-compose run --rm php bin/console list
play:
	docker-compose run --rm php bin/console play $(TRACK_NUMBERS)
queue:
	docker-compose run --rm php bin/console queue

######################################################
###  Dev ::
######################################################
unit-test:
	docker-compose run --rm php bin/phpunit tests
cs-fixer:
	docker-compose run --rm cs-fixer
