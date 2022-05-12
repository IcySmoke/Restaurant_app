<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511205501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, short INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, options LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_food_category (menu_id INT NOT NULL, food_category_id INT NOT NULL, INDEX IDX_88C26B15CCD7E912 (menu_id), INDEX IDX_88C26B15B3F04B2C (food_category_id), PRIMARY KEY(menu_id, food_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_allergens (menu_id INT NOT NULL, allergens_id INT NOT NULL, INDEX IDX_7EB7F880CCD7E912 (menu_id), INDEX IDX_7EB7F880711662F1 (allergens_id), PRIMARY KEY(menu_id, allergens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_food_category ADD CONSTRAINT FK_88C26B15CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_food_category ADD CONSTRAINT FK_88C26B15B3F04B2C FOREIGN KEY (food_category_id) REFERENCES food_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_allergens ADD CONSTRAINT FK_7EB7F880CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_allergens ADD CONSTRAINT FK_7EB7F880711662F1 FOREIGN KEY (allergens_id) REFERENCES allergen (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_allergens DROP FOREIGN KEY FK_7EB7F880711662F1');
        $this->addSql('ALTER TABLE menu_food_category DROP FOREIGN KEY FK_88C26B15B3F04B2C');
        $this->addSql('ALTER TABLE menu_food_category DROP FOREIGN KEY FK_88C26B15CCD7E912');
        $this->addSql('ALTER TABLE menu_allergens DROP FOREIGN KEY FK_7EB7F880CCD7E912');
        $this->addSql('DROP TABLE allergen');
        $this->addSql('DROP TABLE food_category');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_food_category');
        $this->addSql('DROP TABLE menu_allergens');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
