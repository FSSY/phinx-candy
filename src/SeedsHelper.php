<?php

namespace fssy\migration;

use Faker\Factory;
use Faker\Generator;

/**
 * Trait SeedsHelper
 * Supports using $this to directly call methods and properties in faker, for example:
 * 1. $this->email
 * 2. $this->numberBetween(1,10)
 * @property Generator $faker
 * @see Generator
 * @package fssy\migration
 * @mixin Generator
 */
trait SeedsHelper
{
    private static $generator;

    /**
     * Gets property
     * @param string $name name
     * @return Generator|mixed
     */
    public function __get(string $name)
    {
        self::init();
        if ($name == 'faker') {
            return self::$generator;
        }

        return self::$generator->$name;
    }

    /**
     * init $generator
     */
    public function init()
    {
        if (!self::$generator) {
            self::$generator = Factory::create('zh_CN');
        }
    }

    /**
     * Invokes Method
     * @param string $method method
     * @param array $attributes
     * @return mixed
     */
    public function __call(string $method, array $attributes)
    {
        self::init();
        return call_user_func_array([self::$generator, $method], $attributes);
    }
}
