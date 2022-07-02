<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702075740 extends AbstractMigration
{
    public function getDescription()
    {
        return 'This migration is used to generate books table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('books');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('title', 'string', ['notnull' => true, 'length' => 80]);
        $table->addColumn('description', 'text', ['notnull' => true]);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('books');
    }
}
