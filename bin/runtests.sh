#!/usr/bin/env bash

pushd tests

OS=$(php -r "echo strtoupper(substr(PHP_OS, 0, 3));")

if [[ $OS == "WIN" ]]
then
	export ConEmuANSI=ON
	../vendor/bin/phpunit.bat $@
else
	../vendor/bin/phpunit $@
fi

popd
