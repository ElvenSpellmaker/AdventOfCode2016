<?php

namespace ElvenSpellmaker\AdventOfCode;

/**
 * Works out toilet codes.
 */
class ToiletCode
{
	const DIRECTION_UP = 'U';
	const DIRECTION_RIGHT = 'R';
	const DIRECTION_DOWN = 'D';
	const DIRECTION_LEFT = 'L';

	const ADDITIONS = [
		self::DIRECTION_UP => [0, -1],
		self::DIRECTION_RIGHT => [1, 0],
		self::DIRECTION_DOWN => [0, 1],
		self::DIRECTION_LEFT => [-1, 0],
	];

	/**
	 * @var array
	 */
	private $numberpad;

	/**
	 * @var array
	 */
	private $startingLocation;

	/**
	 * @param array $numberpad
	 * @param array $startingLocation
	 */
	public function __construct(array $numberpad, array $startingLocation)
	{
		$this->numberpad = $numberpad;
		$this->startingLocation = $startingLocation;
	}

	/**
	 * Works out the toilet code!
	 *
	 * @param string $instructions
	 *
	 * @return string
	 */
	public function findCode($instructions)
	{
		$instructions = explode("\n", $instructions);
		$code = '';
		$location = $this->startingLocation;

		if ($instructions[count($instructions) - 1] === '')
		{
			array_pop($instructions);
		}

		foreach ($instructions as $instruction)
		{
			for ($i = 0; $i < strlen($instruction); $i++)
			{
				$additions = self::ADDITIONS[$instruction[$i]];

				$this->workOutCode($location, 0, $additions[0]);
				$this->workOutCode($location, 1, $additions[1]);
			}

			$code .= $this->numberpad[$location[0]][$location[1]];
		}

		return $code;
	}

	/**
	 * Works out where the new coördinate in a direction
	 *
	 * @param array   &$coordinates
	 * @param integer $alterCoordinate
	 * @param integer $amountToAdd
	 */
	private function workOutCode(array &$coordinates, $alterCoordinate, $amountToAdd)
	{
		$coordinates[$alterCoordinate] += $amountToAdd;

		if (! isset($this->numberpad[$coordinates[0]][$coordinates[1]]))
		{
			$coordinates[$alterCoordinate] -= $amountToAdd;
		}
	}
}
