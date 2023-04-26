<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402090424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lego_user (lego_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6572566A5814372C (lego_id), INDEX IDX_6572566AA76ED395 (user_id), PRIMARY KEY(lego_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lego_user ADD CONSTRAINT FK_6572566A5814372C FOREIGN KEY (lego_id) REFERENCES lego (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lego_user ADD CONSTRAINT FK_6572566AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lego_user DROP FOREIGN KEY FK_6572566A5814372C');
        $this->addSql('ALTER TABLE lego_user DROP FOREIGN KEY FK_6572566AA76ED395');
        $this->addSql('DROP TABLE lego_user');
    }
}
