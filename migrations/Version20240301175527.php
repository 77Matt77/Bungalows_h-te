<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301175527 extends AbstractMigration
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
        $this->addSql('ALTER TABLE image CHANGE bungalow_id bungalow_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE0373813DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE0373813DA5256D ON bungalow (image_id)');
        $this->addSql('ALTER TABLE image CHANGE bungalow_id bungalow_id INT DEFAULT NULL');
    }
}
