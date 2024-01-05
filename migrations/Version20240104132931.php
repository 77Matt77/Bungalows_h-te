<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104132931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_option (reservation_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_1277492BB83297E7 (reservation_id), INDEX IDX_1277492BA7C41D6F (option_id), PRIMARY KEY(reservation_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_option ADD CONSTRAINT FK_1277492BB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_option ADD CONSTRAINT FK_1277492BA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B0B83297E7');
        $this->addSql('DROP INDEX IDX_5A8600B0B83297E7 ON `option`');
        $this->addSql('ALTER TABLE `option` DROP reservation_id');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_option DROP FOREIGN KEY FK_1277492BB83297E7');
        $this->addSql('ALTER TABLE reservation_option DROP FOREIGN KEY FK_1277492BA7C41D6F');
        $this->addSql('DROP TABLE reservation_option');
        $this->addSql('ALTER TABLE user DROP is_verified');
        $this->addSql('ALTER TABLE `option` ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A8600B0B83297E7 ON `option` (reservation_id)');
    }
}
