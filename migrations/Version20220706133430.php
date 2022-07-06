<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706133430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, nutrition_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, proteins INT DEFAULT NULL, lipids INT DEFAULT NULL, carbohydrate INT DEFAULT NULL, INDEX IDX_9EF68E9CB5D724CD (nutrition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nutrition (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, objective VARCHAR(255) DEFAULT NULL, energy_expenditure INT DEFAULT NULL, water INT DEFAULT NULL, UNIQUE INDEX UNIQ_B7C360F119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CB5D724CD FOREIGN KEY (nutrition_id) REFERENCES nutrition (id)');
        $this->addSql('ALTER TABLE nutrition ADD CONSTRAINT FK_B7C360F119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CB5D724CD');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE nutrition');
    }
}
