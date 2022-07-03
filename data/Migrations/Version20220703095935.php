<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This migration is used to generate auxiliary table for book and category
 */
final class Version20220703095935 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('book_categories');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('book_id', 'integer', ['notnull' => true]);
        $table->addColumn('category_id', 'integer', ['notnull' => true]);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('book_categories');
    }
}
