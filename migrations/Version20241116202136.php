<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116202136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bag_reception (id INT AUTO_INCREMENT NOT NULL, distribution_center_id INT NOT NULL, bag_id INT NOT NULL, bag_code VARCHAR(50) NOT NULL, reception_date DATE NOT NULL, responsable VARCHAR(255) NOT NULL, INDEX IDX_5503C60F1EA5B36B (distribution_center_id), INDEX IDX_5503C60F6F5D8297 (bag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distribution_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, responsable VARCHAR(255) NOT NULL, bags_delivered INT NOT NULL, delivery_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bag_reception ADD CONSTRAINT FK_5503C60F1EA5B36B FOREIGN KEY (distribution_center_id) REFERENCES distribution_center (id)');
        $this->addSql('ALTER TABLE bag_reception ADD CONSTRAINT FK_5503C60F6F5D8297 FOREIGN KEY (bag_id) REFERENCES bag (id)');
        $this->addSql('ALTER TABLE bag ADD distribution_center_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bag ADD CONSTRAINT FK_1B2268411EA5B36B FOREIGN KEY (distribution_center_id) REFERENCES distribution_center (id)');
        $this->addSql('CREATE INDEX IDX_1B2268411EA5B36B ON bag (distribution_center_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bag DROP FOREIGN KEY FK_1B2268411EA5B36B');
        $this->addSql('ALTER TABLE bag_reception DROP FOREIGN KEY FK_5503C60F1EA5B36B');
        $this->addSql('ALTER TABLE bag_reception DROP FOREIGN KEY FK_5503C60F6F5D8297');
        $this->addSql('DROP TABLE bag_reception');
        $this->addSql('DROP TABLE distribution_center');
        $this->addSql('DROP INDEX IDX_1B2268411EA5B36B ON bag');
        $this->addSql('ALTER TABLE bag DROP distribution_center_id');
    }
}
