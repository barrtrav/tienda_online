<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117212351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bag (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, distribution_center_id INT DEFAULT NULL, code VARCHAR(50) NOT NULL, creation_date DATE NOT NULL, INDEX IDX_1B2268418D9F6D38 (order_id), INDEX IDX_1B2268411EA5B36B (distribution_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bag_product (bag_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_A738278F6F5D8297 (bag_id), INDEX IDX_A738278F4584665A (product_id), PRIMARY KEY(bag_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bag_reception (id INT AUTO_INCREMENT NOT NULL, bag_id INT NOT NULL, distribution_center_id INT NOT NULL, bag_code VARCHAR(50) NOT NULL, reception_date DATE NOT NULL, responsable VARCHAR(255) NOT NULL, qr_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5503C60F6F5D8297 (bag_id), INDEX IDX_5503C60F1EA5B36B (distribution_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distribution_center (id INT AUTO_INCREMENT NOT NULL, warehouse_id INT NOT NULL, name VARCHAR(255) NOT NULL, responsable VARCHAR(255) NOT NULL, bags_delivered INT NOT NULL, delivery_date DATE NOT NULL, UNIQUE INDEX UNIQ_2457472E5080ECDE (warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, purchase_date DATE NOT NULL, approval_date DATE DEFAULT NULL, province VARCHAR(255) NOT NULL, municipality VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, total_items INT NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, warehouse_id INT NOT NULL, code VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, name VARCHAR(255) NOT NULL, name_translate VARCHAR(255) NOT NULL, wight NUMERIC(10, 2) NOT NULL, volume NUMERIC(10, 2) NOT NULL, brand VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, temperature VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, UNIQUE INDEX UNIQ_D34A04AD77153098 (code), INDEX IDX_D34A04AD5080ECDE (warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warehouse (id INT AUTO_INCREMENT NOT NULL, creation_date DATE NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, latitude NUMERIC(10, 8) NOT NULL, longitude NUMERIC(10, 8) NOT NULL, UNIQUE INDEX UNIQ_ECB38BFC77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bag ADD CONSTRAINT FK_1B2268418D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE bag ADD CONSTRAINT FK_1B2268411EA5B36B FOREIGN KEY (distribution_center_id) REFERENCES distribution_center (id)');
        $this->addSql('ALTER TABLE bag_product ADD CONSTRAINT FK_A738278F6F5D8297 FOREIGN KEY (bag_id) REFERENCES bag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bag_product ADD CONSTRAINT FK_A738278F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bag_reception ADD CONSTRAINT FK_5503C60F6F5D8297 FOREIGN KEY (bag_id) REFERENCES bag (id)');
        $this->addSql('ALTER TABLE bag_reception ADD CONSTRAINT FK_5503C60F1EA5B36B FOREIGN KEY (distribution_center_id) REFERENCES distribution_center (id)');
        $this->addSql('ALTER TABLE distribution_center ADD CONSTRAINT FK_2457472E5080ECDE FOREIGN KEY (warehouse_id) REFERENCES warehouse (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5080ECDE FOREIGN KEY (warehouse_id) REFERENCES warehouse (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bag DROP FOREIGN KEY FK_1B2268418D9F6D38');
        $this->addSql('ALTER TABLE bag DROP FOREIGN KEY FK_1B2268411EA5B36B');
        $this->addSql('ALTER TABLE bag_product DROP FOREIGN KEY FK_A738278F6F5D8297');
        $this->addSql('ALTER TABLE bag_product DROP FOREIGN KEY FK_A738278F4584665A');
        $this->addSql('ALTER TABLE bag_reception DROP FOREIGN KEY FK_5503C60F6F5D8297');
        $this->addSql('ALTER TABLE bag_reception DROP FOREIGN KEY FK_5503C60F1EA5B36B');
        $this->addSql('ALTER TABLE distribution_center DROP FOREIGN KEY FK_2457472E5080ECDE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5080ECDE');
        $this->addSql('DROP TABLE bag');
        $this->addSql('DROP TABLE bag_product');
        $this->addSql('DROP TABLE bag_reception');
        $this->addSql('DROP TABLE distribution_center');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE warehouse');
    }
}
