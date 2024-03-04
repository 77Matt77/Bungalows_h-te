<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222194038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_option DROP FOREIGN KEY FK_1277492BA7C41D6F');
        $this->addSql('ALTER TABLE reservation_option DROP FOREIGN KEY FK_1277492BB83297E7');
        $this->addSql('DROP TABLE reservation_option');
        $this->addSql('ALTER TABLE bungalow ADD image_id INT DEFAULT NULL, ADD calendrier_id INT DEFAULT NULL, DROP activation, DROP image_path, CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE0373813DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE bungalow ADD CONSTRAINT FK_BE037381FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE0373813DA5256D ON bungalow (image_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE037381FF52FC51 ON bungalow (calendrier_id)');
        $this->addSql('ALTER TABLE reservation ADD option_reservation_id INT DEFAULT NULL, ADD bungalow_id INT DEFAULT NULL, CHANGE date_arrive date_arriver DATETIME NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495530A8D3A5 FOREIGN KEY (option_reservation_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551BADCFB6 FOREIGN KEY (bungalow_id) REFERENCES bungalow (id)');
        $this->addSql('CREATE INDEX IDX_42C8495530A8D3A5 ON reservation (option_reservation_id)');
        $this->addSql('CREATE INDEX IDX_42C849551BADCFB6 ON reservation (bungalow_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_option (reservation_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_1277492BA7C41D6F (option_id), INDEX IDX_1277492BB83297E7 (reservation_id), PRIMARY KEY(reservation_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_option ADD CONSTRAINT FK_1277492BA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_option ADD CONSTRAINT FK_1277492BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE0373813DA5256D');
        $this->addSql('ALTER TABLE bungalow DROP FOREIGN KEY FK_BE037381FF52FC51');
        $this->addSql('DROP INDEX UNIQ_BE0373813DA5256D ON bungalow');
        $this->addSql('DROP INDEX UNIQ_BE037381FF52FC51 ON bungalow');
        $this->addSql('ALTER TABLE bungalow ADD activation TINYINT(1) DEFAULT NULL, ADD image_path VARCHAR(255) DEFAULT NULL, DROP image_id, DROP calendrier_id, CHANGE name nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495530A8D3A5');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849551BADCFB6');
        $this->addSql('DROP INDEX IDX_42C8495530A8D3A5 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849551BADCFB6 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP option_reservation_id, DROP bungalow_id, CHANGE date_arriver date_arrive DATETIME NOT NULL');
    }
}
