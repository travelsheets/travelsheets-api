<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170809100919 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accomodation_step (id INT AUTO_INCREMENT NOT NULL, travel_id INT DEFAULT NULL, place_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, dateStart DATETIME NOT NULL, dateEnd DATETIME DEFAULT NULL, summary LONGTEXT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_9C4B8138ECAB15B3 (travel_id), INDEX IDX_9C4B8138DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accomodation_step ADD CONSTRAINT FK_9C4B8138ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('ALTER TABLE accomodation_step ADD CONSTRAINT FK_9C4B8138DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE accomodation_step');
    }
}
