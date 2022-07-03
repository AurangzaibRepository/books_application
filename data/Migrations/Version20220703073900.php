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
        $schema->addColumn('id', 'integer', ['notnull' => true]);
        $schema->addColumn('string', 'name', ['notnull' => true]);
        $schema->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('categories');
    }
}
