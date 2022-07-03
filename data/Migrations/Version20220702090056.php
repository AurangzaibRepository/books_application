<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This is migration for authors table
 */
final class Version20220702090056 extends AbstractMigration
{
    public function getDescription()
    {
        return 'This migration is used to generate authors table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('authors');
        $table->addColumn('id', 'integer', ['notnull' => true, 'autoincrement' => true]);
        $table->addColumn('name', 'string', ['notnull' => true, 'length' => 80]);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('authors');
    }
}
