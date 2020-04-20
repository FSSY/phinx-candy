<?php

namespace fssy\migration;

use Phinx\Migration\AbstractMigration;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * Trait MigrationsHelper
 * @package fssy\migration
 */
trait MigrationsHelper
{
    /**
     * Creates a new table quickly
     * @param array $tableColumns table columns
     * @param string $tableName table name
     * @param string $tableComment table comment
     * @param array $tableIndexes table indexes
     * @param bool $createTimestamps whether to create timestamps
     * @param bool $createSoftDelete whether to create soft delete timestamp
     */
    public function quickCreate(
        array $tableColumns,
        string $tableName,
        string $tableComment,
        array $tableIndexes = [],
        $createTimestamps = true,
        $createSoftDelete = true
    )
    {
        if ($this instanceof AbstractMigration) {
            $table = $this->table($tableName, ['comment' => $tableComment]);

            if (!empty($tableIndexes)) {
                foreach ($tableIndexes as $index) {
                    $table->addIndex($index);
                }
            }

            if ($createTimestamps) {
                $tableColumns[] = Column::dateTime('create_time')
                    ->setDefault('CURRENT_TIMESTAMP')
                    ->setComment('creat time');
                $tableColumns[] = Column::dateTime('update_time')
                    ->setNullable()
                    ->setComment('update time');
            }

            if ($createSoftDelete) {
                $tableColumns[] = Column::dateTime('delete_time')
                    ->setNullable()
                    ->setComment('delete time');
            }

            if (!empty($tableColumns)) {
                foreach ($tableColumns as $column) {
                    $table->addColumn($column);
                }
            }

            $table->create();
        }
    }

    /**
     * Run all private methods
     * @throws ReflectionException
     */
    public function runAllPrivateMethods()
    {
        if ($this instanceof AbstractMigration) {
            $class = new ReflectionClass(self::class);
            foreach ($class->getMethods(ReflectionMethod::IS_PRIVATE) as $method) {
                $method->setAccessible(true);
                $method->invoke($this);
            }
        }
    }
}
