#!/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use ElvenSpellmaker\AdventOfCode\ChallengeLoader;
use ElvenSpellmaker\AdventOfCode\ToiletCode;

$session = require __DIR__ . '/../config/SessionToken.local.php';

$numberpad = [
	[
		2 => '5',
	],
	[
		1 => '2',
		'6',
		'A',
	],
	[
		'1',
		'3',
		'7',
		'B',
		'D',
	],
	[
		1 => '4',
		'8',
		'C',
	],
	[
		2 => '9'
	],
];

$startingLocation = [0, 2];

echo (new ToiletCode($numberpad, $startingLocation))->findCode(
	(new ChallengeLoader($session))->load(2)
);
