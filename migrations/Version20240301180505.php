<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301180505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image CHANGE bungalow_id bungalow_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551BADCFB6');
        $this->addSql('DROP INDEX IDX_42C849551BADCFB6 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP bungalow_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD bungalow_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551BADCFB6 FOREIGN KEY (bungalow_id) REFERENCES bungalow (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_42C849551BADCFB6 ON reservation (bungalow_id)');
        $this->addSql('ALTER TABLE image CHANGE bungalow_id bungalow_id INT DEFAULT NULL');
    }
}
