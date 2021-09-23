<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920092035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, date DATETIME DEFAULT NULL, lieu VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coachs ADD reservations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coachs ADD CONSTRAINT FK_89E318FDD9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id)');
        $this->addSql('CREATE INDEX IDX_89E318FDD9A7F869 ON coachs (reservations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coachs DROP FOREIGN KEY FK_89E318FDD9A7F869');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP INDEX IDX_89E318FDD9A7F869 ON coachs');
        $this->addSql('ALTER TABLE coachs DROP reservations_id');
    }
}
