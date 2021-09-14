<?php

namespace ElvenSpellmaker\AdventOfCode;

/**
 * Tries to work out the shortest distance from the current location to the HQ.
 */
class HqLocator
{
	const STARTING_POINT = [0, 0];
	const POSITIVE = 1;
	const NEGATIVE = -1;

	const HORIZONTAL = 0;
	const VERTICAL = 1;

	const DIR_LEFT = 'L';
	const DIR_RIGHT = 'R';

	const DIRECTIONS = [
		[
			self::NEGATIVE,
			self::VERTICAL,
		],
		[
			self::POSITIVE,
			self::HORIZONTAL,
		],
		[
			self::POSITIVE,
			self::VERTICAL,
		],
		[
			self::NEGATIVE,
			self::HORIZONTAL,
		],
	];

	/**
	 * @var array
	 */
	private $currentLocation = self::STARTING_POINT;

	/**
	 * @var integer
	 */
	private $directionIndex = 0;

	/**
	 * Attempts to find the shortest path to the HQ.
	 *
	 * @param string $instructions
	 *
	 * @return integer
	 */
	public function locate(string $instructions): int
	{
		$instructions = explode(', ', $instructions);

		foreach ($instructions as $instruction)
		{
			$directionToGo = substr($instruction, 0, 1);
			$distanceToGo = substr($instruction, 1);

			switch ($directionToGo)
			{
				case self::DIR_LEFT:
					$this->directionIndex -= 1;
					$this->directionIndex < 0 and $this->directionIndex = 3;
				break;
				case self::DIR_RIGHT:
					$this->directionIndex = ($this->directionIndex + 1) % 4;
				break;
			}

			$this->currentLocation[self::DIRECTIONS[$this->directionIndex][1]]
				+= $distanceToGo * self::DIRECTIONS[$this->directionIndex][0];
		}

		return abs($this->currentLocation[0]) + abs($this->currentLocation[1]);
	}

	/**
	 * Finds the first place visited twice.
	 *
	 * @param string $instructions
	 *
	 * @return integer|null
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	public function locateFirstPlaceVisitedTwice(string $instructions)
	{
		$instructions = explode(', ', $instructions);
		$visitedLocations = [];

		foreach ($instructions as $instruction)
		{
			$directionToGo = substr($instruction, 0, 1);
			$distanceToGo = substr($instruction, 1);

			switch ($directionToGo)
			{
				case self::DIR_LEFT:
					$this->directionIndex -= 1;
					$this->directionIndex < 0 and $this->directionIndex = 3;
				break;
				case self::DIR_RIGHT:
					$this->directionIndex = ($this->directionIndex + 1) % 4;
				break;
			}

			$currentLocation = $this->currentLocation;
			$directionConstants = self::DIRECTIONS[$this->directionIndex];

			$newLocationPart = $currentLocation[$directionConstants[1]];
			$visitedLocationPart = range($newLocationPart, $newLocationPart + $distanceToGo * self::DIRECTIONS[$this->directionIndex][0]);

			foreach ($visitedLocationPart as $newLocationPart)
			{
				$newLocation = $directionConstants[1] === self::HORIZONTAL
					?  [$newLocationPart, $this->currentLocation[1]]
					: [$this->currentLocation[0], $newLocationPart];

				if ($newLocation !== $this->currentLocation && in_array($newLocation, $visitedLocations))
				{
					return abs($newLocation[0]) + abs($newLocation[1]);
				}

				$visitedLocations[] = $newLocation;
			}

			$this->currentLocation[self::DIRECTIONS[$this->directionIndex][1]]
				+= $distanceToGo * self::DIRECTIONS[$this->directionIndex][0];
		}

		return null;
	}
}
