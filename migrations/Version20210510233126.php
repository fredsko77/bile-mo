<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510233126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(128) NOT NULL, company VARCHAR(64) NOT NULL, ref VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5C0F152BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, brand VARCHAR(32) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, weight INT NOT NULL, os VARCHAR(32) NOT NULL, network LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', color LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', connectivity LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', memory LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', screen DOUBLE PRECISION NOT NULL, photo INT NOT NULL, stock INT NOT NULL, ref VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specification (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, specs LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(128) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, company VARCHAR(64) NOT NULL, ref VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_user ADD CONSTRAINT FK_5C0F152BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_user DROP FOREIGN KEY FK_5C0F152BA76ED395');
        $this->addSql('DROP TABLE client_user');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE specification');
        $this->addSql('DROP TABLE user');
    }
}
