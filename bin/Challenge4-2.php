#!/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use ElvenSpellmaker\AdventOfCode\ChallengeLoader;
use ElvenSpellmaker\AdventOfCode\RoomDecryptor;

$session = require __DIR__ . '/../config/SessionToken.local.php';

$decryptedRooms = (new RoomDecryptor)->decryptRooms(
	(new ChallengeLoader($session))->load(4)
);

$matches = [];

foreach ($decryptedRooms as $room)
{
	if (strpos($room, 'northpole-object-storage') === 0)
	{
		if (preg_match('%.*?(\d+).*%', $room, $matches))
		{
			echo $matches[1];
		}
	}
}
