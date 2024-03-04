<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222134546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE037381B83297E7');
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE037381FF52FC51');
        $this->addSql('DROP INDEX IDX_BE037381B83297E7 ON bungalow');
        $this->addSql('DROP INDEX UNIQ_BE037381FF52FC51 ON bungalow');
        $this->addSql('ALTER TABLE bungalow ADD image_path VARCHAR(255) DEFAULT NULL, DROP reservation_id, DROP calendrier_id');
        $this->addSql('ALTER TABLE calendrier ADD date_fin DATETIME NOT NULL, CHANGE date_disponible date_debut DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bungalow ADD reservation_id INT DEFAULT NULL, ADD calendrier_id INT DEFAULT NULL, DROP image_path');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE037381B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE037381FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BE037381B83297E7 ON bungalow (reservation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE037381FF52FC51 ON bungalow (calendrier_id)');
        $this->addSql('ALTER TABLE calendrier ADD date_disponible DATETIME NOT NULL, DROP date_debut, DROP date_fin');
    }
}
