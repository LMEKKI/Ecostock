<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204094227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_section_restaurant (category_id INT NOT NULL, section_restaurant_id INT NOT NULL, INDEX IDX_9B77FBBA12469DE2 (category_id), INDEX IDX_9B77FBBAD9FA6F0B (section_restaurant_id), PRIMARY KEY(category_id, section_restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_section_restaurant (restaurant_id INT NOT NULL, section_restaurant_id INT NOT NULL, INDEX IDX_EDD976B2B1E7706E (restaurant_id), INDEX IDX_EDD976B2D9FA6F0B (section_restaurant_id), PRIMARY KEY(restaurant_id, section_restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_section_restaurant ADD CONSTRAINT FK_9B77FBBA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_section_restaurant ADD CONSTRAINT FK_9B77FBBAD9FA6F0B FOREIGN KEY (section_restaurant_id) REFERENCES section_restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_section_restaurant ADD CONSTRAINT FK_EDD976B2B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_section_restaurant ADD CONSTRAINT FK_EDD976B2D9FA6F0B FOREIGN KEY (section_restaurant_id) REFERENCES section_restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAACED5CA9E6');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC12469DE2');
        $this->addSql('ALTER TABLE restaurant_service DROP FOREIGN KEY FK_2BD6C6A7B1E7706E');
        $this->addSql('ALTER TABLE restaurant_service DROP FOREIGN KEY FK_2BD6C6A7ED5CA9E6');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE restaurant_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('ALTER TABLE user_account ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_service (category_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_2645DAAC12469DE2 (category_id), INDEX IDX_2645DAACED5CA9E6 (service_id), PRIMARY KEY(category_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE restaurant_service (restaurant_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_2BD6C6A7ED5CA9E6 (service_id), INDEX IDX_2BD6C6A7B1E7706E (restaurant_id), PRIMARY KEY(restaurant_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAACED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_service ADD CONSTRAINT FK_2BD6C6A7B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_service ADD CONSTRAINT FK_2BD6C6A7ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_section_restaurant DROP FOREIGN KEY FK_9B77FBBA12469DE2');
        $this->addSql('ALTER TABLE category_section_restaurant DROP FOREIGN KEY FK_9B77FBBAD9FA6F0B');
        $this->addSql('ALTER TABLE restaurant_section_restaurant DROP FOREIGN KEY FK_EDD976B2B1E7706E');
        $this->addSql('ALTER TABLE restaurant_section_restaurant DROP FOREIGN KEY FK_EDD976B2D9FA6F0B');
        $this->addSql('DROP TABLE category_section_restaurant');
        $this->addSql('DROP TABLE restaurant_section_restaurant');
        $this->addSql('DROP TABLE section_restaurant');
        $this->addSql('ALTER TABLE user_account DROP roles');
    }
}
