<?php

namespace ElevnSpellmaker\AdventOfCode;

use ElvenSpellmaker\AdventOfCode\RoomDecryptor;
use PHPUnit\Framework\TestCase;

class RoomDecryptorTest extends TestCase
{
	/**
	 * @dataProvider getRoomData
	 */
	public function testRealRooms($roomCode, $isRealRoom)
	{
		$this->assertEquals($isRealRoom, (new RoomDecryptor)->isRealRoom($roomCode));
	}

	/**
	 * @dataProvider getRoomStrings
	 */
	public function testDecryptRooms($roomCodes, array $decryptedRoomNames)
	{
		$this->assertEquals($decryptedRoomNames, (new RoomDecryptor)->decryptRooms($roomCodes));
	}

	public function getRoomData()
	{
		return [
			[
				'aaaaa-bbb-z-y-x-123[abxyz]',
				123,
			],
			[
				'a-b-c-d-e-f-g-h-987[abcde]',
				987,
			],
			[
				'not-a-real-room-404[oarel]',
				404,
			],
			[
				'totally-real-room-200[decoy]',
				false,
			],
		];
	}

	public function getRoomStrings()
	{
		return [
			[
				"aaaaa-bbb-z-y-x-123[abxyz]\ntotally-real-room-200[decoy]\nnot-a-real-room-404[oarel]\na-b-c-d-e-f-g-h-987[abcde]\n",
				[
					'ttttt-uuu-s-r-q-123[tuqrs]',
					'bch-o-fsoz-fcca-404[cofsz]',
					'z-a-b-c-d-e-f-g-987[zabcd]',
				],
			],
		];
	}
}
