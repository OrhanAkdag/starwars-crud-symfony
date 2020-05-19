<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512120538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE resident_vehicule (resident_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_6D88A2FB8012C5B0 (resident_id), INDEX IDX_6D88A2FB4A4A3511 (vehicule_id), PRIMARY KEY(resident_id, vehicule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resident_vehicule ADD CONSTRAINT FK_6D88A2FB8012C5B0 FOREIGN KEY (resident_id) REFERENCES resident (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resident_vehicule ADD CONSTRAINT FK_6D88A2FB4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE resident_vehicule');
    }
}
