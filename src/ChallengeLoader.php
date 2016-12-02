<?php

namespace ElvenSpellmaker\AdventOfCode;

/**
 * Retrieves a challenges input.
 */
class ChallengeLoader
{
	/**
	 * @var string
	 */
	private $cookie;

	/**
	 * @param string $cookie
	 */
	public function __construct($cookie)
	{
		$this->cookie = $cookie;
	}

	/**
	 * Loads a file for a particular challenge.
	 *
	 * @param string $challenge
	 *
	 * @return string
	 */
	public function load($challenge)
	{
		$opts = [
			'http' => [
				'header' => 'Cookie: session=' . $this->cookie . ';',
			],
		];

		$input = file_get_contents(
			"http://adventofcode.com/2016/day/$challenge/input",
			false,
			stream_context_create($opts)
		);

		return $input;
	}
}
