serve:
	composer update
	php -S localhost:8000 -t public

.PHONY: serve