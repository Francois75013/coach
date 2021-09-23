<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920083753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_coachs DROP FOREIGN KEY FK_C1125166B83297E7');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_coachs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date DATETIME DEFAULT NULL, lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_coachs (reservation_id INT NOT NULL, coachs_id INT NOT NULL, INDEX IDX_C1125166B83297E7 (reservation_id), INDEX IDX_C112516660450EA1 (coachs_id), PRIMARY KEY(reservation_id, coachs_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_coachs ADD CONSTRAINT FK_C112516660450EA1 FOREIGN KEY (coachs_id) REFERENCES coachs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_coachs ADD CONSTRAINT FK_C1125166B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
    }
}
