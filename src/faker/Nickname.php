<?php


namespace fssy\migration\faker;

use Faker\Generator;

/**
 * Class Nickname
 * @package fssy\migration\faker
 */
class Nickname
{
    /**
     * Generates a random nickname
     * @param Generator $generator faker generator
     * @return string
     */
    public static function generate(Generator $generator): string
    {
        $firsts = include __DIR__ . '/config/nickname_first.php';
        $seconds = include __DIR__ . '/config/nickname_second.php';
        return $firsts[$generator->numberBetween(0, count($firsts) - 1)]
            . $seconds[$generator->numberBetween(0, count($seconds) - 1)];
    }
}
