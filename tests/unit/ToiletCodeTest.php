<?php

namespace ElevnSpellmaker\AdventOfCode;

use ElvenSpellmaker\AdventOfCode\ToiletCode;
use PHPUnit\Framework\TestCase;

class ToiletCodeTest extends TestCase
{
	/**
	 * @dataProvider getToiletCode
	 */
	public function testFindingCode($instructions, $code)
	{
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

		$this->assertEquals($code, (new ToiletCode($numberpad, $startingLocation))->findCode($instructions));
	}

	/**
	 * @dataProvider getHardToiletCode
	 */
	public function testFindingHarderCode($instructions, $code)
	{
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

		$this->assertEquals($code, (new ToiletCode($numberpad, $startingLocation))->findCode($instructions));
	}

	public function getToiletCode()
	{
		return [
			[
				"ULL\nRRDDD\nLURDL\nUUUUD",
				1985,
			],
			[
				"ULL\nRRDDD\nLURDL\nUUUUD\n",
				1985,
			],
		];
	}

	public function getHardToiletCode()
	{
		return [
			[
				"ULL\nRRDDD\nLURDL\nUUUUD",
				'5DB3',
			],
		];
	}
}
