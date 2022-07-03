<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This migration is used to define relation between book and author
 */
final class Version20220702100950 extends AbstractMigration
{
    public function getDescription()
    {
        return 'This migration is used to define foreign key constraints';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable('books');
        $table->addForeignKeyConstraint('authors', ['author_id'], ['id'], [], 'author_foreign_key');
    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable('books');
        $table->removeForeignKey('author_foreign_key');
    }
}
