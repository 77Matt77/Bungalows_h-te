<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103204650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow ADD calendrier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE037381FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE037381FF52FC51 ON bungalow (calendrier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE037381FF52FC51');
        $this->addSql('DROP INDEX UNIQ_BE037381FF52FC51 ON bungalow');
        $this->addSql('ALTER TABLE bungalow DROP calendrier_id');
    }
}
