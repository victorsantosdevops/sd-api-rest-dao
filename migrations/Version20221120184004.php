<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221120184004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cidade (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_265DE1E33256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estado ADD CONSTRAINT FK_265DE1E33256915B FOREIGN KEY (relation_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE endereco ADD cidade_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE endereco ADD CONSTRAINT FK_F8E0D60E9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('CREATE INDEX IDX_F8E0D60E9586CC8 ON endereco (cidade_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE endereco DROP FOREIGN KEY FK_F8E0D60E9586CC8');
        $this->addSql('ALTER TABLE estado DROP FOREIGN KEY FK_265DE1E33256915B');
        $this->addSql('DROP TABLE cidade');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP INDEX IDX_F8E0D60E9586CC8 ON endereco');
        $this->addSql('ALTER TABLE endereco DROP cidade_id');
    }
}
