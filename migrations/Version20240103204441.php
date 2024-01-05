<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103204441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE037381B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_BE037381B83297E7 ON bungalow (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE037381B83297E7');
        $this->addSql('DROP INDEX IDX_BE037381B83297E7 ON bungalow');
        $this->addSql('ALTER TABLE bungalow DROP reservation_id');
    }
}
