<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402090115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lego_user_relation DROP FOREIGN KEY FK_3583ACB9A76ED395');
        $this->addSql('ALTER TABLE lego_user_relation DROP FOREIGN KEY FK_3583ACB95814372C');
        $this->addSql('DROP TABLE lego_user_relation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lego_user_relation (id INT AUTO_INCREMENT NOT NULL, lego_id INT NOT NULL, user_id INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3583ACB95814372C (lego_id), INDEX IDX_3583ACB9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lego_user_relation ADD CONSTRAINT FK_3583ACB9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lego_user_relation ADD CONSTRAINT FK_3583ACB95814372C FOREIGN KEY (lego_id) REFERENCES lego (id)');
    }
}
