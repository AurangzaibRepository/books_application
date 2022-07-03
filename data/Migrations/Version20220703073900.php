<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This is migration for categories table
 */
final class Version20220703073900 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('categories');
        $table->addColumn('id', 'integer', ['notnull' => true, 'autoincrement' => true]);
        $table->addColumn('name', 'string', ['notnull' => true]);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('categories');
    }
}
