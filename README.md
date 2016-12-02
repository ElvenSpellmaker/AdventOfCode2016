Advent Of Code 2016 [![Build Status](https://travis-ci.org/ElvenSpellmaker/AdventOfCode2016.svg?branch=master)](https://travis-ci.org/ElvenSpellmaker/AdventOfCode2016)
===================

My solutions to the Advent of Code 2016!

## Requirements
 * PHP >= 5.6

## Usage

To set up the project, please copy `./config/SessionToken.php` to `./config/SessionToken.local.php` and populate the `REDACTED` string with your cookie token.

To find your cookie token, look at the cookie sent when you try to load your input from the website (such as `http://adventofcode.com/2016/day/2/input`).

Challenge files are found under `./bin`, e.g.: to run challenge 1 from day 1, run `./bin/Challenge1-1.php`

Running the SCA: `./bin/sca.sh`

Running the tests: `./bin/runtests.sh`
