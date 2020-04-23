<?php


namespace fssy\migration;

class Index extends \Phinx\Db\Table\Index
{
    /**
     * Sets the column index type to index
     * @param string|array $columns columns
     * @return Index
     */
    public static function index($columns): Index
    {
        return self::make($columns, self::INDEX);
    }

    /**
     * Creates a new column index
     * @param string|array $columns columns
     * @param string $type type
     * @param array $options options
     * @return Index
     */
    public static function make($columns, string $type, array $options = []): Index
    {
        $index = new self();
        $index->setColumns(is_array($columns) ? $columns : [$columns]);
        $index->setType($type);
        $index->setOptions($options);
        return $index;
    }

    /**
     * Sets the column index type to unique
     * @param string|array $columns columns
     * @return Index
     */
    public static function unique($columns): Index
    {
        return self::make($columns, self::UNIQUE);
    }


    /**
     * Sets the column type to fulltext
     * @param string|array $columns columns
     * @return Index
     */
    public static function fulltext($columns): Index
    {
        return self::make($columns, self::FULLTEXT);
    }
}
