tests:
	php ./vendor/bin/phpunit tests
.PHONY: tests

init:
	php ./bin/console init
.PHONY: init
