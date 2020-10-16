<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200928035721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fotos ADD path VARCHAR(255) NOT NULL, CHANGE product_id p_id INT NOT NULL, CHANGE name filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task CHANGE state state ENUM(\'WAIT\', \'ACCEPTED\', \'DONE\', \'REJECTED\', \'BROKEN\'), CHANGE date_done date_done DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fotos ADD name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP filename, DROP path, CHANGE p_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE task CHANGE state state VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_done date_done DATETIME DEFAULT NULL');
    }
}
