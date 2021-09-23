<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210923074423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations ADD user_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239291A82DC FOREIGN KEY (user_name_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4DA239291A82DC ON reservations (user_name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239291A82DC');
        $this->addSql('DROP INDEX IDX_4DA239291A82DC ON reservations');
        $this->addSql('ALTER TABLE reservations DROP user_name_id');
    }
}
