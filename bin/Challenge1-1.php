#!/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use ElvenSpellmaker\AdventOfCode\ChallengeLoader;
use ElvenSpellmaker\AdventOfCode\HqLocator;

$session = require __DIR__ . '/../config/SessionToken.local.php';

echo (new HqLocator)->locate(
	(new ChallengeLoader($session))->load(1)
);
