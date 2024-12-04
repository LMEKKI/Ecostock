<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204095938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AEB1E7706E');
        $this->addSql('CREATE TABLE camping (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, INDEX IDX_81A904E4642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camping_section_restaurant (camping_id INT NOT NULL, section_restaurant_id INT NOT NULL, INDEX IDX_C2B2F60C3CC6385 (camping_id), INDEX IDX_C2B2F60CD9FA6F0B (section_restaurant_id), PRIMARY KEY(camping_id, section_restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE camping ADD CONSTRAINT FK_81A904E4642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE camping_section_restaurant ADD CONSTRAINT FK_C2B2F60C3CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE camping_section_restaurant ADD CONSTRAINT FK_C2B2F60CD9FA6F0B FOREIGN KEY (section_restaurant_id) REFERENCES section_restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F642B8210');
        $this->addSql('ALTER TABLE restaurant_section_restaurant DROP FOREIGN KEY FK_EDD976B2B1E7706E');
        $this->addSql('ALTER TABLE restaurant_section_restaurant DROP FOREIGN KEY FK_EDD976B2D9FA6F0B');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_section_restaurant');
        $this->addSql('DROP INDEX IDX_253B48AEB1E7706E ON user_account');
        $this->addSql('ALTER TABLE user_account CHANGE restaurant_id camping_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE3CC6385 FOREIGN KEY (camping_id) REFERENCES camping (id)');
        $this->addSql('CREATE INDEX IDX_253B48AE3CC6385 ON user_account (camping_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AE3CC6385');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_EB95123F642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE restaurant_section_restaurant (restaurant_id INT NOT NULL, section_restaurant_id INT NOT NULL, INDEX IDX_EDD976B2B1E7706E (restaurant_id), INDEX IDX_EDD976B2D9FA6F0B (section_restaurant_id), PRIMARY KEY(restaurant_id, section_restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE restaurant_section_restaurant ADD CONSTRAINT FK_EDD976B2B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_section_restaurant ADD CONSTRAINT FK_EDD976B2D9FA6F0B FOREIGN KEY (section_restaurant_id) REFERENCES section_restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE camping DROP FOREIGN KEY FK_81A904E4642B8210');
        $this->addSql('ALTER TABLE camping_section_restaurant DROP FOREIGN KEY FK_C2B2F60C3CC6385');
        $this->addSql('ALTER TABLE camping_section_restaurant DROP FOREIGN KEY FK_C2B2F60CD9FA6F0B');
        $this->addSql('DROP TABLE camping');
        $this->addSql('DROP TABLE camping_section_restaurant');
        $this->addSql('DROP INDEX IDX_253B48AE3CC6385 ON user_account');
        $this->addSql('ALTER TABLE user_account CHANGE camping_id restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AEB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_253B48AEB1E7706E ON user_account (restaurant_id)');
    }
}
