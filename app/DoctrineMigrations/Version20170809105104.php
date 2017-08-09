<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170809105104 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, travel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, dateStart DATETIME NOT NULL, dateEnd DATETIME DEFAULT NULL, summary LONGTEXT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_43B9FE3CECAB15B3 (travel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('ALTER TABLE accomodation_step DROP FOREIGN KEY FK_9C4B8138ECAB15B3');
        $this->addSql('DROP INDEX IDX_9C4B8138ECAB15B3 ON accomodation_step');
        $this->addSql('ALTER TABLE accomodation_step DROP travel_id, DROP name, DROP dateStart, DROP dateEnd, DROP summary, DROP price, DROP currency, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE accomodation_step ADD CONSTRAINT FK_9C4B8138BF396750 FOREIGN KEY (id) REFERENCES step (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tour_step DROP FOREIGN KEY FK_62891E1CECAB15B3');
        $this->addSql('DROP INDEX IDX_62891E1CECAB15B3 ON tour_step');
        $this->addSql('ALTER TABLE tour_step DROP travel_id, DROP name, DROP dateStart, DROP dateEnd, DROP summary, DROP price, DROP currency, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE tour_step ADD CONSTRAINT FK_62891E1CBF396750 FOREIGN KEY (id) REFERENCES step (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transportation_step DROP FOREIGN KEY FK_F3A522EBECAB15B3');
        $this->addSql('DROP INDEX IDX_F3A522EBECAB15B3 ON transportation_step');
        $this->addSql('ALTER TABLE transportation_step DROP travel_id, DROP name, DROP dateStart, DROP dateEnd, DROP summary, DROP price, DROP currency, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE transportation_step ADD CONSTRAINT FK_F3A522EBBF396750 FOREIGN KEY (id) REFERENCES step (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accomodation_step DROP FOREIGN KEY FK_9C4B8138BF396750');
        $this->addSql('ALTER TABLE tour_step DROP FOREIGN KEY FK_62891E1CBF396750');
        $this->addSql('ALTER TABLE transportation_step DROP FOREIGN KEY FK_F3A522EBBF396750');
        $this->addSql('DROP TABLE step');
        $this->addSql('ALTER TABLE accomodation_step ADD travel_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD dateStart DATETIME NOT NULL, ADD dateEnd DATETIME DEFAULT NULL, ADD summary LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, ADD price DOUBLE PRECISION DEFAULT NULL, ADD currency VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE accomodation_step ADD CONSTRAINT FK_9C4B8138ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('CREATE INDEX IDX_9C4B8138ECAB15B3 ON accomodation_step (travel_id)');
        $this->addSql('ALTER TABLE tour_step ADD travel_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD dateStart DATETIME NOT NULL, ADD dateEnd DATETIME DEFAULT NULL, ADD summary LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, ADD price DOUBLE PRECISION DEFAULT NULL, ADD currency VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tour_step ADD CONSTRAINT FK_62891E1CECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('CREATE INDEX IDX_62891E1CECAB15B3 ON tour_step (travel_id)');
        $this->addSql('ALTER TABLE transportation_step ADD travel_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD dateStart DATETIME NOT NULL, ADD dateEnd DATETIME DEFAULT NULL, ADD summary LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, ADD price DOUBLE PRECISION DEFAULT NULL, ADD currency VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE transportation_step ADD CONSTRAINT FK_F3A522EBECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('CREATE INDEX IDX_F3A522EBECAB15B3 ON transportation_step (travel_id)');
    }
}
