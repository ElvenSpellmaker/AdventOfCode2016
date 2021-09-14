<?php

namespace ElvenSpellmaker\AdventOfCode;

/**
 * Attempts to work out if rooms are real or not and will decrypt real rooms.
 */
class RoomDecryptor
{
	/**
	 * Takes a list of rooms separated by newlines and returns real rooms
	 * decrypted.
	 *
	 * @param string $roomsList
	 *
	 * @return array
	 */
	public function decryptRooms(string $roomsList) : array
	{
		$roomsList = explode("\n", $roomsList);
		$decryptedRoomNames = [];

		if (end($roomsList) === '')
		{
			array_pop($roomsList);
		}

		foreach ($roomsList as $roomCode)
		{
			if (($sectorID = $this->isRealRoom($roomCode)) !== false)
			{
				$decryptedRoomNames[] = $this->strRot($roomCode, $sectorID);
			}
		}

		return $decryptedRoomNames;
	}

	/**
	 * Gets the sum of the real room's Sector IDs from a newline separated
	 * string.
	 *
	 * @param string $roomsList
	 *
	 * @return integer
	 */
	public function getSumOfRealRooms(string $roomsList) : int
	{
		$roomsList = explode("\n", $roomsList);
		$sum = [];

		foreach ($roomsList as $roomCode)
		{
			$sum[] = $this->isRealRoom($roomCode);
		}

		return array_sum($sum);
	}

	/**
	 * Works out if a room is a decoy or not.
	 *
	 * Note: This function returns the room number if it's real or false if the
	 * function fails.
	 *
	 * @param string $roomCode
	 *
	 * @return integer|boolean
	 */
	public function isRealRoom(string $roomCode)
	{
		$roomCodeLength = strlen($roomCode);

		list($counts, $roomNumber, $pos) = $this->extractCountsAndSectorId($roomCode, $roomCodeLength);

		arsort($counts);
		$counts = $this->reorderCounts($counts);
		$counts = array_splice($counts, 0, 5);

		$checksum = $this->getChecksum($roomCode, $pos, $roomCodeLength);

		return array_keys($counts) === $checksum
			? (int)$roomNumber
			: false;
	}

	/**
	 * Extracts the letter count and the Sector ID out of the given room code.
	 * Also returned is the current position in the string.
	 *
	 * @param string $roomCode
	 * @param int    $roomCodeLength
	 *
	 * @return array
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * PHP MD seems a bit wonky in that calculation ^
	 */
	private function extractCountsAndSectorId(string $roomCode, int $roomCodeLength) : array
	{
		$counts = [];
		$roomNumber = '';

		for ($i = 0; $i < $roomCodeLength; $i++)
		{
			switch ($roomCode[$i])
			{
				case '[':
					$i++;
				break 2;

				case '-':
				break;

				case '0':
				case '1':
				case '2':
				case '3':
				case '4':
				case '5':
				case '6':
				case '7':
				case '8':
				case '9':
					$roomNumber .= $roomCode[$i];
				break;

				default:
					@$counts[$roomCode[$i]]++;
				break;
			}
		}

		return [$counts, $roomNumber, $i];
	}

	/**
	 * Gets the checksum for a room code.
	 *
	 * @param string $roomCode
	 * @param int    $currentPos
	 * @param int    $roomCodeLength
	 *
	 * @return array
	 */
	private function getChecksum(string $roomCode, int $currentPos, int $roomCodeLength) : array
	{
		$checksum = [];

		for ($i = $currentPos; $i < $roomCodeLength; $i++)
		{
			if ($roomCode[$i] === ']')
			{
				break;
			}

			$checksum[] = $roomCode[$i];
		}

		return $checksum;
	}

	/**
	 * Reorders count arrays so that equal counts are arranged alphabetically.
	 *
	 * @param array $counts
	 *
	 * @return array
	 */
	private function reorderCounts(array $counts) : array
	{
		$newCounts = [];

		while (($currentCount = current($counts)) !== false)
		{
			$equalCounts = [key($counts) => $currentCount];

			while (($nextCount = next($counts)) === $currentCount)
			{
				$equalCounts[key($counts)] = $nextCount;
			}

			if (count($equalCounts) > 1)
			{
				ksort($equalCounts);
			}

			$newCounts = array_merge($newCounts, $equalCounts);
		}

		return $newCounts;
	}

	/**
	 * Rotates a lowercase ASCII string by a given number of places
	 *
	 * @param string $roomString
	 * @param int    $rotate
	 *
	 * @return string
	 */
	private function strRot(string $roomString, int $rotate) : string
	{
		$letters = 'abcdefghijklmnopqrstuvwxyz';
		$rotate = $rotate % 26;
		if ($rotate === 0)
		{
			return $roomString;
		}

		if ($rotate === 13)
		{
			return str_rot13($roomString);
		}

		$rep = substr($letters, $rotate) . substr($letters, 0, $rotate);
		return strtr($roomString, $letters, $rep);
	}
}
