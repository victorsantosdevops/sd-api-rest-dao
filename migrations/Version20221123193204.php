<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123193204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, tipo_id INT NOT NULL, INDEX IDX_F41C9B25A9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE especie (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, no_id INT NOT NULL, funcao VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7510A3CF1A65C546 (no_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pag_cartao (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, parcelas INT NOT NULL, UNIQUE INDEX UNIQ_487FE5483256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pag_dinheiro (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, data_vencimento DATE NOT NULL, data_pagamento DATE NOT NULL, UNIQUE INDEX UNIQ_ADCFA3F3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pagamento (id INT AUTO_INCREMENT NOT NULL, situacao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pagamento_servico (pagamento_id INT NOT NULL, servico_id INT NOT NULL, INDEX IDX_65493D37E06F81F7 (pagamento_id), INDEX IDX_65493D3782E14982 (servico_id), PRIMARY KEY(pagamento_id, servico_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet (id INT AUTO_INCREMENT NOT NULL, raca_id INT NOT NULL, nome VARCHAR(255) NOT NULL, idade INT NOT NULL, INDEX IDX_E4529B85E13B435A (raca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, preco DOUBLE PRECISION NOT NULL, INDEX IDX_5CAC49D73397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raca (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servico (id INT AUTO_INCREMENT NOT NULL, produto_id INT DEFAULT NULL, data_entrada DATE NOT NULL, data_saida DATE DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, INDEX IDX_14873CC105CFD56 (produto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servico_cliente (servico_id INT NOT NULL, cliente_id INT NOT NULL, INDEX IDX_AEB6432782E14982 (servico_id), INDEX IDX_AEB64327DE734E51 (cliente_id), PRIMARY KEY(servico_id, cliente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telefone (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25A9276E6C FOREIGN KEY (tipo_id) REFERENCES pessoa (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF1A65C546 FOREIGN KEY (no_id) REFERENCES pessoa (id)');
        $this->addSql('ALTER TABLE pag_cartao ADD CONSTRAINT FK_487FE5483256915B FOREIGN KEY (relation_id) REFERENCES pagamento (id)');
        $this->addSql('ALTER TABLE pag_dinheiro ADD CONSTRAINT FK_ADCFA3F3256915B FOREIGN KEY (relation_id) REFERENCES pagamento (id)');
        $this->addSql('ALTER TABLE pagamento_servico ADD CONSTRAINT FK_65493D37E06F81F7 FOREIGN KEY (pagamento_id) REFERENCES pagamento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pagamento_servico ADD CONSTRAINT FK_65493D3782E14982 FOREIGN KEY (servico_id) REFERENCES servico (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B85E13B435A FOREIGN KEY (raca_id) REFERENCES raca (id)');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE servico ADD CONSTRAINT FK_14873CC105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE servico_cliente ADD CONSTRAINT FK_AEB6432782E14982 FOREIGN KEY (servico_id) REFERENCES servico (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE servico_cliente ADD CONSTRAINT FK_AEB64327DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pessoa ADD telefone_id INT NOT NULL');
        $this->addSql('ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB8292D095A9 FOREIGN KEY (telefone_id) REFERENCES telefone (id)');
        $this->addSql('CREATE INDEX IDX_1CDFAB8292D095A9 ON pessoa (telefone_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB8292D095A9');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25A9276E6C');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF1A65C546');
        $this->addSql('ALTER TABLE pag_cartao DROP FOREIGN KEY FK_487FE5483256915B');
        $this->addSql('ALTER TABLE pag_dinheiro DROP FOREIGN KEY FK_ADCFA3F3256915B');
        $this->addSql('ALTER TABLE pagamento_servico DROP FOREIGN KEY FK_65493D37E06F81F7');
        $this->addSql('ALTER TABLE pagamento_servico DROP FOREIGN KEY FK_65493D3782E14982');
        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY FK_E4529B85E13B435A');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73397707A');
        $this->addSql('ALTER TABLE servico DROP FOREIGN KEY FK_14873CC105CFD56');
        $this->addSql('ALTER TABLE servico_cliente DROP FOREIGN KEY FK_AEB6432782E14982');
        $this->addSql('ALTER TABLE servico_cliente DROP FOREIGN KEY FK_AEB64327DE734E51');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE especie');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE pag_cartao');
        $this->addSql('DROP TABLE pag_dinheiro');
        $this->addSql('DROP TABLE pagamento');
        $this->addSql('DROP TABLE pagamento_servico');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE produto');
        $this->addSql('DROP TABLE raca');
        $this->addSql('DROP TABLE servico');
        $this->addSql('DROP TABLE servico_cliente');
        $this->addSql('DROP TABLE telefone');
        $this->addSql('DROP INDEX IDX_1CDFAB8292D095A9 ON pessoa');
        $this->addSql('ALTER TABLE pessoa DROP telefone_id');
    }
}
