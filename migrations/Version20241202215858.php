<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202215858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, datasheets_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1A55874F8 (datasheets_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_service (category_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_2645DAAC12469DE2 (category_id), INDEX IDX_2645DAACED5CA9E6 (service_id), PRIMARY KEY(category_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data_sheet (id INT AUTO_INCREMENT NOT NULL, ingredient LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_form (id INT AUTO_INCREMENT NOT NULL, user_account_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_1F79C7583C0C9956 (user_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, INDEX IDX_EB95123F642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_service (restaurant_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_2BD6C6A7B1E7706E (restaurant_id), INDEX IDX_2BD6C6A7ED5CA9E6 (service_id), PRIMARY KEY(restaurant_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_account (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_253B48AEB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A55874F8 FOREIGN KEY (datasheets_id) REFERENCES data_sheet (id)');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAACED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_form ADD CONSTRAINT FK_1F79C7583C0C9956 FOREIGN KEY (user_account_id) REFERENCES user_account (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE restaurant_service ADD CONSTRAINT FK_2BD6C6A7B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_service ADD CONSTRAINT FK_2BD6C6A7ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AEB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A55874F8');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC12469DE2');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAACED5CA9E6');
        $this->addSql('ALTER TABLE order_form DROP FOREIGN KEY FK_1F79C7583C0C9956');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F642B8210');
        $this->addSql('ALTER TABLE restaurant_service DROP FOREIGN KEY FK_2BD6C6A7B1E7706E');
        $this->addSql('ALTER TABLE restaurant_service DROP FOREIGN KEY FK_2BD6C6A7ED5CA9E6');
        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AEB1E7706E');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE data_sheet');
        $this->addSql('DROP TABLE order_form');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user_account');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
