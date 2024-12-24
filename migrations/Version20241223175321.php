<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241223175321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camping (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, INDEX IDX_81A904E4642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camping_section_restaurant (camping_id INT NOT NULL, section_restaurant_id INT NOT NULL, INDEX IDX_C2B2F60C3CC6385 (camping_id), INDEX IDX_C2B2F60CD9FA6F0B (section_restaurant_id), PRIMARY KEY(camping_id, section_restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, datasheets_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1A55874F8 (datasheets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_section_restaurant (category_id INT NOT NULL, section_restaurant_id INT NOT NULL, INDEX IDX_9B77FBBA12469DE2 (category_id), INDEX IDX_9B77FBBAD9FA6F0B (section_restaurant_id), PRIMARY KEY(category_id, section_restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data_sheet (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, units_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, unit VARCHAR(75) NOT NULL, weight INT NOT NULL, INDEX IDX_6BAF787099387CE8 (units_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE datasheet_ingredient (ingredient_id INT NOT NULL, data_sheet_id INT NOT NULL, INDEX IDX_C045C047933FE08C (ingredient_id), INDEX IDX_C045C04741CCCF79 (data_sheet_id), PRIMARY KEY(ingredient_id, data_sheet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_form (id INT AUTO_INCREMENT NOT NULL, user_account_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_1F79C7583C0C9956 (user_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE units (id INT AUTO_INCREMENT NOT NULL, unit VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_account (id INT AUTO_INCREMENT NOT NULL, camping_id INT DEFAULT NULL, sectionrestaurant_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, INDEX IDX_253B48AE3CC6385 (camping_id), INDEX IDX_253B48AE2B108F15 (sectionrestaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE camping_section_restaurant ADD CONSTRAINT FK_C2B2F60C3CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE camping_section_restaurant ADD CONSTRAINT FK_C2B2F60CD9FA6F0B FOREIGN KEY (section_restaurant_id) REFERENCES section_restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A55874F8 FOREIGN KEY (datasheets_id) REFERENCES data_sheet (id)');
        $this->addSql('ALTER TABLE category_section_restaurant ADD CONSTRAINT FK_9B77FBBA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_section_restaurant ADD CONSTRAINT FK_9B77FBBAD9FA6F0B FOREIGN KEY (section_restaurant_id) REFERENCES section_restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787099387CE8 FOREIGN KEY (units_id) REFERENCES units (id)');
        $this->addSql('ALTER TABLE datasheet_ingredient ADD CONSTRAINT FK_C045C047933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE datasheet_ingredient ADD CONSTRAINT FK_C045C04741CCCF79 FOREIGN KEY (data_sheet_id) REFERENCES data_sheet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_form ADD CONSTRAINT FK_1F79C7583C0C9956 FOREIGN KEY (user_account_id) REFERENCES user_account (id)');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE3CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id)');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE2B108F15 FOREIGN KEY (sectionrestaurant_id) REFERENCES section_restaurant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4642B8210');
        $this->addSql('ALTER TABLE camping_section_restaurant DROP FOREIGN KEY FK_C2B2F60C3CC6385');
        $this->addSql('ALTER TABLE camping_section_restaurant DROP FOREIGN KEY FK_C2B2F60CD9FA6F0B');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A55874F8');
        $this->addSql('ALTER TABLE category_section_restaurant DROP FOREIGN KEY FK_9B77FBBA12469DE2');
        $this->addSql('ALTER TABLE category_section_restaurant DROP FOREIGN KEY FK_9B77FBBAD9FA6F0B');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787099387CE8');
        $this->addSql('ALTER TABLE datasheet_ingredient DROP FOREIGN KEY FK_C045C047933FE08C');
        $this->addSql('ALTER TABLE datasheet_ingredient DROP FOREIGN KEY FK_C045C04741CCCF79');
        $this->addSql('ALTER TABLE order_form DROP FOREIGN KEY FK_1F79C7583C0C9956');
        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AE3CC6385');
        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AE2B108F15');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE camping');
        $this->addSql('DROP TABLE camping_section_restaurant');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_section_restaurant');
        $this->addSql('DROP TABLE data_sheet');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE datasheet_ingredient');
        $this->addSql('DROP TABLE order_form');
        $this->addSql('DROP TABLE section_restaurant');
        $this->addSql('DROP TABLE units');
        $this->addSql('DROP TABLE user_account');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
