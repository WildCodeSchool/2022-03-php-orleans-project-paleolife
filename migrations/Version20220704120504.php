<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704120504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement_client ADD measurement_id INT DEFAULT NULL, ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE measurement_client ADD CONSTRAINT FK_C3833DB7924EA134 FOREIGN KEY (measurement_id) REFERENCES measurement (id)');
        $this->addSql('ALTER TABLE measurement_client ADD CONSTRAINT FK_C3833DB719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_C3833DB7924EA134 ON measurement_client (measurement_id)');
        $this->addSql('CREATE INDEX IDX_C3833DB719EB6921 ON measurement_client (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement_client DROP FOREIGN KEY FK_C3833DB719EB6921');
        $this->addSql('DROP INDEX IDX_C3833DB7924EA134 ON measurement_client');
        $this->addSql('DROP INDEX IDX_C3833DB719EB6921 ON measurement_client');
        $this->addSql('ALTER TABLE measurement_client DROP measurement_id, DROP client_id');
    }
}
