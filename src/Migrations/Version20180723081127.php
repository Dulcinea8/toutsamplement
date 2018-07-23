<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180723081127 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tracks (id INT AUTO_INCREMENT NOT NULL, idalbum_id INT DEFAULT NULL, is_validated TINYINT(1) NOT NULL, titre VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, date_publi DATETIME DEFAULT NULL, INDEX IDX_246D2A2EBBE2E3C2 (idalbum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2EBBE2E3C2 FOREIGN KEY (idalbum_id) REFERENCES albums (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tracks');
    }
}
