tests:
	php ./vendor/bin/phpunit tests
.PHONY: tests

init:
	php ./bin/console init
.PHONY: init

coverage:
	XDEBUG_MODE=coverage php ./vendor/bin/phpunit tests --coverage-text --coverage-filter=src
.PHONY: coverage

serve:
	php -S localhost:8000 -t public
.PHONY: serve
