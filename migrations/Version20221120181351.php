<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221120181351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE endereco (id INT AUTO_INCREMENT NOT NULL, logradouro VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, complemento VARCHAR(255) DEFAULT NULL, bairro VARCHAR(255) NOT NULL, cep VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pessoa ADD endereco_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB821BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('CREATE INDEX IDX_1CDFAB821BB76823 ON pessoa (endereco_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB821BB76823');
        $this->addSql('DROP TABLE endereco');
        $this->addSql('DROP INDEX IDX_1CDFAB821BB76823 ON pessoa');
        $this->addSql('ALTER TABLE pessoa DROP endereco_id');
    }
}
