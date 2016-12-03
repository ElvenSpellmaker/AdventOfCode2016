<?php

namespace ElvenSpellmaker\AdventOfCode;

/**
 * Performs tests on measurements to see if they're triangles
 */
class TriangleTester
{
	/**
	 * Counts the number of feasible for the given input in rows.
	 *
	 * @param string $instructions
	 *
	 * @return integer
	 */
	public function countFeasibleRows($instructions)
	{
		$count = 0;

		for ($i = 0; $i < strlen($instructions); $i += 16)
		{
			$side1 = substr($instructions, $i, 5);
			$side2 = substr($instructions, $i + 5, 5);
			$side3 = substr($instructions, $i + 10, 5);

			// Useful Debug Line!
			// echo "($side1, $side2, $side3) --> ", $this->isFeasible($side1, $side2, $side3), "\n";

			$count += $this->isFeasible($side1, $side2, $side3);
		}

		return $count;
	}

	/**
	 * Counts the number of feasible for the given input in columns.
	 * Note: Assumes input is grouped into groups of 3 lines.
	 *
	 * @param string $instructions
	 *
	 * @return integer
	 */
	public function countFeasibleColumns($instructions)
	{
		$count = 0;

		for ($i = 0; $i < strlen($instructions); $i += 16)
		{
			$side11 = substr($instructions, $i, 5);
			$side21 = substr($instructions, $i + 5, 5);
			$side31 = substr($instructions, $i + 10, 5);

			$i += 16;

			$side12 = substr($instructions, $i, 5);
			$side22 = substr($instructions, $i + 5, 5);
			$side32 = substr($instructions, $i + 10, 5);

			$i += 16;

			$side13 = substr($instructions, $i, 5);
			$side23 = substr($instructions, $i + 5, 5);
			$side33 = substr($instructions, $i + 10, 5);

			// Useful Debug Lines!
			// echo "($side11, $side12, $side13) --> ", $this->isFeasible($side11, $side12, $side13), "\n";
			// echo "($side21, $side22, $side23) --> ", $this->isFeasible($side21, $side22, $side23), "\n";
			// echo "($side31, $side32, $side33) --> ", $this->isFeasible($side31, $side32, $side33), "\n";

			$count += $this->isFeasible($side11, $side12, $side13);
			$count += $this->isFeasible($side21, $side22, $side23);
			$count += $this->isFeasible($side31, $side32, $side33);
		}

		return $count;
	}

	/**
	 * Works out if three given sides could form a triangle.
	 *
	 * @param integer|float $side1
	 * @param integer|float $side2
	 * @param integer|float $side3
	 *
	 * @return integer|float
	 */
	public function isFeasible($side1, $side2, $side3)
	{
		return $side1 + $side2 > $side3
			&& $side1 + $side3 > $side2
			&& $side2 + $side3 > $side1;
	}
}
