#!/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use ElvenSpellmaker\AdventOfCode\ChallengeLoader;
use ElvenSpellmaker\AdventOfCode\RoomDecryptor;

$session = require __DIR__ . '/../config/SessionToken.local.php';

echo (new RoomDecryptor)->getSumOfRealRooms(
	(new ChallengeLoader($session))->load(4)
);
