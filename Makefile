test: phpunit.xml vendor/autoload.php
	vendor/bin/phpunit -c phpunit.xml

phpunit.xml: phpunit.xml.dist
	cp -i phpunit.xml.dist phpunit.xml

composer.phar:
	wget http://getcomposer.org/installer -O - | php

vendor/autoload.php: composer.phar composer.lock
	composer install

composer.lock: composer.phar composer.json
	composer install

.PHONY: test
