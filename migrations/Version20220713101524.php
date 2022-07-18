<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713101524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, photo_before VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, photo_after VARCHAR(255) DEFAULT NULL, global_name VARCHAR(255) NOT NULL, month_name VARCHAR(255) DEFAULT NULL, date_before DATE DEFAULT NULL, date_after DATE DEFAULT NULL, objective_nutrition VARCHAR(255) DEFAULT NULL, energy_expenditure INT DEFAULT NULL, water INT DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, session_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, repetition VARCHAR(255) NOT NULL, INDEX IDX_AEDAD51C613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measurement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, unity VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measurement_client (id INT AUTO_INCREMENT NOT NULL, measurement_id INT DEFAULT NULL, client_id INT DEFAULT NULL, value_before NUMERIC(4, 1) DEFAULT NULL, value_after NUMERIC(4, 1) DEFAULT NULL, INDEX IDX_C3833DB7924EA134 (measurement_id), INDEX IDX_C3833DB719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nutrition_meal (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, meal_name VARCHAR(255) NOT NULL, proteins INT DEFAULT NULL, lipids INT DEFAULT NULL, carbohydrate INT DEFAULT NULL, INDEX IDX_B5CC600F19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(255) NOT NULL, question LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_D044D5D419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE measurement_client ADD CONSTRAINT FK_C3833DB7924EA134 FOREIGN KEY (measurement_id) REFERENCES measurement (id)');
        $this->addSql('ALTER TABLE measurement_client ADD CONSTRAINT FK_C3833DB719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE nutrition_meal ADD CONSTRAINT FK_B5CC600F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('INSERT INTO service(title, description, photo, question, updated_at) VALUES ("Personal Training",
        "Ressentez le pouvoir du sport, en vous octroyant les services d’un professionnel.
        Je vous accompagne, vous guide et vous encourage dans la réussite de votre challenge sportif.
        Un coach juste pour vous pendant une heure, j’anime avec un large choix
        d’activité adaptées à des capacités diverses.
        Mon objectif, vous faire tomber amoureux du sport, pour que vous découvriez ses 
        nouvelles sensations de bien-être et de satisfaction.
        Les cours ne vous arrêteront pas de vous surprendre et de vous dépasser.
        Plaisir et régularité sont des ingrédients essentiels pour obtenir vos résultats.",
        "personnal0.jpg",
        "Et si vous voulez vous sentir libre dans votre corps ?",
        "2022-07-13 15:30:00"),
        ("Suivis à distance",
        "A la maison ou à la salle de sport, cette offre s’adresse précisément à vous qui 
        souhaitez mettre toutes les chances de votre côté.
        Une méthode conçu sur 16 semaines, idéal pour une première transformation physique.
        Je vous propose de structurer votre temps d’entraînement, un programme évolutif 
        avec des exercices adaptés et spécialisés.
        Cela vous évitera de perdre un temps considérable et qui, à la longue pèseront sur votre motivation.
        S’ajoute un plan diététique également personnalisé selon votre génétique et objectif.",
        "personnal1.jpg",
        "Et si votre entraînement était sur mesure ?",
        "2022-07-13 15:30:00")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement_client DROP FOREIGN KEY FK_C3833DB719EB6921');
        $this->addSql('ALTER TABLE nutrition_meal DROP FOREIGN KEY FK_B5CC600F19EB6921');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D419EB6921');
        $this->addSql('ALTER TABLE measurement_client DROP FOREIGN KEY FK_C3833DB7924EA134');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C613FECDF');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('DROP TABLE measurement_client');
        $this->addSql('DROP TABLE nutrition_meal');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('TRUNCATE TABLE service');
        $this->addSql('TRUNCATE TABLE user');
    }
}
