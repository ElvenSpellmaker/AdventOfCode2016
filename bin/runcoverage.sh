#!/usr/bin/env bash

pushd tests

OS=$(php -r "echo strtoupper(substr(PHP_OS, 0, 3));")

if [[ $OS == "WIN" ]]; then
	export ConEmuANSI=ON
	../vendor/bin/phpunit.bat --coverage-html coverage $@
else
	../vendor/bin/phpunit --coverage-html coverage $@
fi

if [ $? -eq 0 ]; then
	dir=`realpath coverage/index.html`
	echo -e "\n\e[0;32mCoverage Generated at: $dir \e[0m\n"
fi

popd
