<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170810140134 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE step_attachment DROP FOREIGN KEY FK_7534FFFA464E68B');
        $this->addSql('ALTER TABLE step_attachment ADD CONSTRAINT FK_7534FFFA464E68B FOREIGN KEY (attachment_id) REFERENCES attachment (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE step_attachment DROP FOREIGN KEY FK_7534FFFA464E68B');
        $this->addSql('ALTER TABLE step_attachment ADD CONSTRAINT FK_7534FFFA464E68B FOREIGN KEY (attachment_id) REFERENCES attachment (id)');
    }
}
