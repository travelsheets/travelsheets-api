<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170808232337 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transportation_step ADD travel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transportation_step ADD CONSTRAINT FK_F3A522EBECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('CREATE INDEX IDX_F3A522EBECAB15B3 ON transportation_step (travel_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transportation_step DROP FOREIGN KEY FK_F3A522EBECAB15B3');
        $this->addSql('DROP INDEX IDX_F3A522EBECAB15B3 ON transportation_step');
        $this->addSql('ALTER TABLE transportation_step DROP travel_id');
    }
}
