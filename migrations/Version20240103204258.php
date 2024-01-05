<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103204258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B0B83297E7 ON `option` (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0B83297E7');
        $this->addSql('DROP INDEX IDX_5A8600B0B83297E7 ON `option`');
        $this->addSql('ALTER TABLE `option` DROP reservation_id');
    }
}
