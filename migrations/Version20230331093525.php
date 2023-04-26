<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331093525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE possess DROP FOREIGN KEY FK_CC5C24CF5814372C');
        $this->addSql('ALTER TABLE possess DROP FOREIGN KEY FK_CC5C24CFA76ED395');
        $this->addSql('ALTER TABLE desired DROP FOREIGN KEY FK_47D08D6ADDCB0EA5');
        $this->addSql('ALTER TABLE desired DROP FOREIGN KEY FK_47D08D6AA76ED395');
        $this->addSql('DROP TABLE possess');
        $this->addSql('DROP TABLE desired');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE possess (id INT AUTO_INCREMENT NOT NULL, lego_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CC5C24CF5814372C (lego_id), INDEX IDX_CC5C24CFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE desired (id INT AUTO_INCREMENT NOT NULL, lego_id_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_47D08D6ADDCB0EA5 (lego_id_id), INDEX IDX_47D08D6AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE possess ADD CONSTRAINT FK_CC5C24CF5814372C FOREIGN KEY (lego_id) REFERENCES lego (id)');
        $this->addSql('ALTER TABLE possess ADD CONSTRAINT FK_CC5C24CFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE desired ADD CONSTRAINT FK_47D08D6ADDCB0EA5 FOREIGN KEY (lego_id_id) REFERENCES lego (id)');
        $this->addSql('ALTER TABLE desired ADD CONSTRAINT FK_47D08D6AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
