<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180724142611 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE albums (id INT AUTO_INCREMENT NOT NULL, idartiste_id INT NOT NULL, nom VARCHAR(255) NOT NULL, annee VARCHAR(4) DEFAULT NULL, pochette VARCHAR(255) DEFAULT NULL, INDEX IDX_F4E2474FEC7B457E (idartiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, date_publi DATETIME DEFAULT NULL, image VARCHAR(255) NOT NULL, video VARCHAR(255) DEFAULT NULL, INDEX IDX_BFDD316860BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artistes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, user INT DEFAULT NULL, genre VARCHAR(100) NOT NULL, article INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, idarticle_id INT NOT NULL, idtrack_id INT DEFAULT NULL, iduser_id INT DEFAULT NULL, message LONGTEXT NOT NULL, date_publi DATETIME NOT NULL, INDEX IDX_5F9E962ABF3D9BA6 (idarticle_id), INDEX IDX_5F9E962AF407744E (idtrack_id), INDEX IDX_5F9E962A786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_pass (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, INDEX IDX_395710FCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracks (id INT AUTO_INCREMENT NOT NULL, idalbum_id INT DEFAULT NULL, is_validated TINYINT(1) NOT NULL, titre VARCHAR(255) NOT NULL, lien VARCHAR(255) DEFAULT NULL, date_publi DATETIME DEFAULT NULL, INDEX IDX_246D2A2EBBE2E3C2 (idalbum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(80) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(80) NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, date_inscription DATETIME NOT NULL, score INT NOT NULL, facebook VARCHAR(255) DEFAULT NULL, soundcloud VARCHAR(255) DEFAULT NULL, bandcamp VARCHAR(255) DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, role LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE albums ADD CONSTRAINT FK_F4E2474FEC7B457E FOREIGN KEY (idartiste_id) REFERENCES artistes (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316860BB6FE6 FOREIGN KEY (auteur_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962ABF3D9BA6 FOREIGN KEY (idarticle_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF407744E FOREIGN KEY (idtrack_id) REFERENCES tracks (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_pass ADD CONSTRAINT FK_395710FCA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2EBBE2E3C2 FOREIGN KEY (idalbum_id) REFERENCES albums (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2EBBE2E3C2');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962ABF3D9BA6');
        $this->addSql('ALTER TABLE albums DROP FOREIGN KEY FK_F4E2474FEC7B457E');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF407744E');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316860BB6FE6');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A786A81FB');
        $this->addSql('ALTER TABLE reset_pass DROP FOREIGN KEY FK_395710FCA76ED395');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE artistes');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE reset_pass');
        $this->addSql('DROP TABLE tracks');
        $this->addSql('DROP TABLE users');
    }
}
