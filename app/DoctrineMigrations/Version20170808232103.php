<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170808232103 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transportation_step (id INT AUTO_INCREMENT NOT NULL, from_id INT DEFAULT NULL, to_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, dateStart DATETIME NOT NULL, dateEnd DATETIME DEFAULT NULL, summary LONGTEXT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_F3A522EB78CED90B (from_id), INDEX IDX_F3A522EB30354A65 (to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transportation_step ADD CONSTRAINT FK_F3A522EB78CED90B FOREIGN KEY (from_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE transportation_step ADD CONSTRAINT FK_F3A522EB30354A65 FOREIGN KEY (to_id) REFERENCES place (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transportation_step');
    }
}
