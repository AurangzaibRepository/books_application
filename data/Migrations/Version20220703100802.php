<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This migration is used to define relationship between book and categories
 */
final class Version20220703100802 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $table = $schema->getTable('book_categories');
        $table->addIndex(['book_id'], 'book_id_index');
        $table->addIndex(['category_id'], 'category_id_index');
        $table->addForeignKeyConstraint('books', ['book_id'], ['id'], [], 'book_foreign_key');
        $table->addForeignKeyConstraint('categories', ['category_id'], ['id'], [], 'category_foreign_key');
    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable('book_categories');
        $table->dropIndex('book_id_index');
        $table->dropIndex('category_id_index');
        $table->removeForeignKey('book_foreign_key');
        $table->removeForeignKey('category_foreign_key');
    }
}
