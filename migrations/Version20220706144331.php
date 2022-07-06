<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706144331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nutrition_meal (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, meal_name VARCHAR(255) DEFAULT NULL, proteins INT DEFAULT NULL, lipids INT DEFAULT NULL, carbohydrate INT DEFAULT NULL, INDEX IDX_B5CC600F19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nutrition_meal ADD CONSTRAINT FK_B5CC600F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client ADD objective_nutrition VARCHAR(255) DEFAULT NULL, ADD energy_expenditure INT DEFAULT NULL, ADD water INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE nutrition_meal');
        $this->addSql('ALTER TABLE client DROP objective_nutrition, DROP energy_expenditure, DROP water');
    }
}
