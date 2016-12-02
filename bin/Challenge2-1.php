#!/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use ElvenSpellmaker\AdventOfCode\ChallengeLoader;
use ElvenSpellmaker\AdventOfCode\ToiletCode;

$session = require __DIR__ . '/../config/SessionToken.local.php';

$numberpad = [
	[
		'1',
		'4',
		'7',
	],
	[
		'2',
		'5',
		'8',
	],
	[
		'3',
		'6',
		'9',
	],
];

$startingLocation = [1, 1];

echo (new ToiletCode($numberpad, $startingLocation))->findCode(
	(new ChallengeLoader($session))->load(2)
);
