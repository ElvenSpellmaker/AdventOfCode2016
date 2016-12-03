#!/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use ElvenSpellmaker\AdventOfCode\ChallengeLoader;
use ElvenSpellmaker\AdventOfCode\TriangleTester;

$session = require __DIR__ . '/../config/SessionToken.local.php';

echo (new TriangleTester)->countFeasibleRows(
	(new ChallengeLoader($session))->load(3)
);
