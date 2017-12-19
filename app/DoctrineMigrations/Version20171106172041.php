<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171106172041 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET foreign_key_checks = 0;');
        $this->addSql('DROP TABLE IF EXISTS attachment');
        $this->addSql('DROP TABLE IF EXISTS step_attachment');
        $this->addSql('SET foreign_key_checks = 1;');

        $this->addSql('CREATE TABLE step_attachment (id INT AUTO_INCREMENT NOT NULL, step_id INT DEFAULT NULL, file_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, summary LONGTEXT DEFAULT NULL, INDEX IDX_7534FFFA73B21E9C (step_id), INDEX IDX_7534FFFA93CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE step_attachment ADD CONSTRAINT FK_7534FFFA73B21E9C FOREIGN KEY (step_id) REFERENCES step (id)');
        $this->addSql('ALTER TABLE step_attachment ADD CONSTRAINT FK_7534FFFA93CB796C FOREIGN KEY (file_id) REFERENCES upload (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE step_attachment');
    }
}
