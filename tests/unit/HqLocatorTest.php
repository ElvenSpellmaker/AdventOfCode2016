<?php

namespace ElevnSpellmaker\AdventOfCode;

use ElvenSpellmaker\AdventOfCode\HqLocator;
use PHPUnit\Framework\TestCase;

class HqLocatorTest extends TestCase
{
	/**
	 * @dataProvider getInstructionsShortest
	 */
	public function testHqLocation($instructions, $blocksAway)
	{
		$this->assertEquals($blocksAway, (new HqLocator)->locate($instructions));
	}

	/**
	 * @dataProvider getInstructionsFirstTwiceVisited
	 */
	public function testFirstTwiceVisisted($instructions, $blocksAway)
	{
		$this->assertEquals($blocksAway, (new HqLocator)->locateFirstPlaceVisitedTwice($instructions));
	}

	public function getInstructionsShortest()
	{
		return [
			[
				'R2, L3',
				5,
			],
			[
				'R2, R2, R2',
				2,
			],
			[
				'R5, L5, R5, R3',
				12,
			],
		];
	}

	public function getInstructionsFirstTwiceVisited()
	{
		return [
			[
				'R8, R4, R4, R8',
				4,
			],
		];
	}
}
