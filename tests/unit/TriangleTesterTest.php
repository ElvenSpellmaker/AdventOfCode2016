<?php

namespace ElevnSpellmaker\AdventOfCode;

use ElvenSpellmaker\AdventOfCode\TriangleTester;
use PHPUnit\Framework\TestCase;

class TriangleTesterTest extends TestCase
{
	/**
	 * @dataProvider getTriangleInstructions
	 */
	public function testIsFeasible(array $sides, $isFeasible)
	{
		$this->assertEquals($isFeasible, (new TriangleTester)->isFeasible($sides[0], $sides[1], $sides[2]));
	}

	/**
	 * @dataProvider getTriangleRowCountInstructions
	 */
	public function testCountFeasibleRows($feasibleCountString, $feasibleCount)
	{
		$this->assertEquals($feasibleCount, (new TriangleTester)->countFeasibleRows($feasibleCountString));
	}

	/**
	 * @dataProvider getTriangleColumnCountInstructions
	 */
	public function testCountFeasibleColumns($feasibleCountString, $feasibleCount)
	{
		$this->assertEquals($feasibleCount, (new TriangleTester)->countFeasibleColumns($feasibleCountString));
	}

	public function getTriangleInstructions()
	{
		return [
			[
				[5, 10, 25],
				false,
			],
			[
				[424, 797, 125],
				false,
			],
			[
				[3, 4, 5],
				true,
			]
		];
	}

	public function getTriangleRowCountInstructions()
	{
		return [
			[
				"    5   10   25",
				0,
			],
			[
				"    5   10   25\n",
				0,
			],
			[
				"    5   10   25\n    3    4    5\n",
				1,
			],
			[
				"    3    4    5\n    3    4    5\n",
				2,
			],
			[
				"    3    4    5\n    3    4    5",
				2,
			],
			[
				"    3    4    5\n    5   10   25\n    3    4    5",
				2,
			],
			[
				"  424  797  125",
				0,
			]
		];
	}

	public function getTriangleColumnCountInstructions()
	{
		return [
			[
				"    3    5  424\n    4   10  797\n    5   25  125",
				1,
			],
			[
				"    3    5  424\n    4   10  797\n    5   25  125\n    4   10  797\n    5   25  125\n    3    5  424",
				2,
			],
		];
	}
}
