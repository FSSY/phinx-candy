<?php

namespace fssy\migration;

use Phinx\Db\Adapter\MysqlAdapter;

class Column extends \Phinx\Db\Table\Column
{
    /**
     * @var array
     */
    protected $defaults = [
        self::BIGINTEGER => 0,
        self::SMALLINTEGER => 0,
        self::INTEGER => 0,
        self::BOOLEAN => 0,
        self::DECIMAL => 0.00,
        self::FLOAT => 0.00,
        self::STRING => "",
        self::TEXT => "",
        self::TIMESTAMP => 0,

    ];

    /**
     * @var array
     */
    protected $nulls = [
        self::DATE,
        self::DATETIME,
        self::TIME,
        self::TIMESTAMP,
    ];

    /**
     * Sets the column type to binary
     * @param string $name name
     * @return Column
     */
    public static function binary(string $name): Column
    {
        return self::make($name, self::BINARY);
    }

    /**
     * Creates a new column
     * @param string $name name
     * @param string $type type
     * @param array $options options
     * @return Column
     */
    public static function make(string $name, string $type, array $options = [])
    {
        $column = new self();
        $column->setName($name);
        $column->setType($type);
        $column->setOptions($options);

        if (!isset($options['default'])
            && in_array($type, array_keys($column->defaults))
        ) {
            $column->setDefault($column->defaults[$type]);
        }

        if (in_array($type, $column->nulls)) {
            $column->setNullable();
        }

        return $column;
    }

    /**
     * Sets the column type to boolean(tinyint for real)
     * @param string $name name
     * @return Column
     */
    public static function boolean(string $name)
    {
        return self::make($name, self::BOOLEAN);
    }

    /**
     * Sets the column type to char
     * @param string $name name
     * @param int $length length
     * @return Column
     */
    public static function char(string $name, int $length = 255): Column
    {
        return self::make($name, self::CHAR, compact('length'));
    }

    /**
     * Sets the column type to date
     * @param string $name name
     * @return Column
     */
    public static function date(string $name): Column
    {
        return self::make($name, self::DATE);
    }

    /**
     * Sets the column type to date time
     * @param string $name
     * @return Column
     */
    public static function dateTime($name): Column
    {
        return self::make($name, self::DATETIME);
    }

    /**
     * Sets the column type to decimal
     * @param string $name name
     * @param int $precision precision
     * @param int $scale scale
     * @return Column
     */
    public static function decimal(string $name, int $precision = 8, int $scale = 2): Column
    {
        return self::make($name, self::DECIMAL, compact('precision', 'scale'));
    }

    /**
     * Sets the column type to float
     * @param string $name name
     * @return Column
     */
    public static function float(string $name): Column
    {
        return self::make($name, self::FLOAT);
    }

    /**
     * Sets the column type to json
     * @param string $name
     * @return Column
     */
    public static function json(string $name): Column
    {
        return self::make($name, self::JSON);
    }

    /**
     * Sets the column type to json binary
     * @param string $name
     * @return Column
     */
    public static function jsonb(string $name): Column
    {
        return self::make($name, self::JSONB);
    }

    /**
     * Sets the column type to long text
     * @param string $name name
     * @return Column
     */
    public static function longText(string $name): Column
    {
        return self::make($name, self::TEXT, ['length' => MysqlAdapter::TEXT_LONG]);
    }

    /**
     * Sets the column type to medium integer
     * @param string $name name
     * @return Column
     */
    public static function mediumInteger(string $name): Column
    {
        return self::make($name, self::INTEGER, ['length' => MysqlAdapter::INT_MEDIUM]);
    }

    /**
     * Set the column type to medium text
     * @param string $name
     * @return Column
     */
    public static function mediumText(string $name): Column
    {
        return self::make($name, self::TEXT, ['length' => MysqlAdapter::TEXT_MEDIUM]);
    }

    /**
     * Sets the column type to small integer
     * @param string $name name
     * @return Column
     */
    public static function smallInteger(string $name): Column
    {
        return self::make($name, self::INTEGER, ['length' => MysqlAdapter::INT_SMALL]);
    }

    /**
     * Sets the column type to big integer
     * @param string $name name
     * @return Column
     */
    public static function bigInteger(string $name): Column
    {
        return self::make($name, self::BIGINTEGER);
    }

    /**
     * Sets the column type to string
     * @param string $name name
     * @param int $length length
     * @return Column
     */
    public static function string(string $name, int $length = 255): Column
    {
        return self::make($name, self::STRING, compact('length'));
    }

    /**
     * Sets the column type to text
     * @param string $name name
     * @return Column
     */
    public static function text(string $name): Column
    {
        return self::make($name, self::TEXT);
    }

    /**
     * Sets the column type to time
     * @param string $name name
     * @return Column
     */
    public static function time(string $name): Column
    {
        return self::make($name, self::TIME);
    }

    /**
     * Sets the column type to tiny integer
     * @param string $name name
     * @return Column
     */
    public static function tinyInteger(string $name): Column
    {
        return self::make($name, self::INTEGER, ['length' => MysqlAdapter::INT_TINY]);
    }


    /**
     * Sets the column type to integer
     * @param string $name name
     * @return Column
     */
    public static function integer(string $name): Column
    {
        return self::make($name, self::INTEGER);
    }

    /**
     * Sets the Column type to integer
     * @param string $name
     * @return Column
     */
    public static function timestamp(string $name): Column
    {
        return self::make($name, self::TIMESTAMP);
    }

    /**
     * Sets column is allowed to be set to nulls
     * @return Column
     */
    public function setNullable()
    {
        return $this->setNull(true);
    }

    /**
     * Removes the default value of column
     * @return Column
     */
    public function removeDefault(): Column
    {
        unset($this->default);
        return $this;
    }
}
