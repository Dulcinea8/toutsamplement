<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180723083004 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, idarticle_id INT NOT NULL, idtrack_id INT DEFAULT NULL, iduser_id INT DEFAULT NULL, message LONGTEXT NOT NULL, date_publi DATETIME NOT NULL, INDEX IDX_5F9E962ABF3D9BA6 (idarticle_id), INDEX IDX_5F9E962AF407744E (idtrack_id), INDEX IDX_5F9E962A786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962ABF3D9BA6 FOREIGN KEY (idarticle_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF407744E FOREIGN KEY (idtrack_id) REFERENCES tracks (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE articles ADD auteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316860BB6FE6 FOREIGN KEY (auteur_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BFDD316860BB6FE6 ON articles (auteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316860BB6FE6');
        $this->addSql('DROP INDEX IDX_BFDD316860BB6FE6 ON articles');
        $this->addSql('ALTER TABLE articles DROP auteur_id');
    }
}
