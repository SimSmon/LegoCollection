<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426215520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lego ADD theme_id INT DEFAULT NULL, DROP theme');
        $this->addSql('ALTER TABLE lego ADD CONSTRAINT FK_E9191FC559027487 FOREIGN KEY (theme_id) REFERENCES lego_theme (id)');
        $this->addSql('CREATE INDEX IDX_E9191FC559027487 ON lego (theme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lego DROP FOREIGN KEY FK_E9191FC559027487');
        $this->addSql('DROP INDEX IDX_E9191FC559027487 ON lego');
        $this->addSql('ALTER TABLE lego ADD theme VARCHAR(255) DEFAULT NULL, DROP theme_id');
    }
}
