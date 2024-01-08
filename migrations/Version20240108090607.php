<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108090607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE0373813DA5256D');
        $this->addSql('DROP INDEX UNIQ_BE0373813DA5256D ON bungalow');
        $this->addSql('ALTER TABLE bungalow DROP image_id');
        $this->addSql('ALTER TABLE image ADD bungalow_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1BADCFB6 FOREIGN KEY (bungalow_id) REFERENCES bungalow (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F1BADCFB6 ON image (bungalow_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE0373813DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE0373813DA5256D ON bungalow (image_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1BADCFB6');
        $this->addSql('DROP INDEX IDX_C53D045F1BADCFB6 ON image');
        $this->addSql('ALTER TABLE image DROP bungalow_id');
    }
}
