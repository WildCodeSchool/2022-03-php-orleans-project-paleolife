<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621151704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD session_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51C613FECDF ON exercise (session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C613FECDF');
        $this->addSql('DROP INDEX IDX_AEDAD51C613FECDF ON exercise');
        $this->addSql('ALTER TABLE exercise DROP session_id');
    }
}
