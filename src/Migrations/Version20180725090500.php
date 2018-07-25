<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725090500 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE relations (id INT AUTO_INCREMENT NOT NULL, is_validated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relations_tracks (relations_id INT NOT NULL, tracks_id INT NOT NULL, INDEX IDX_6AFCA8C51BFA63C8 (relations_id), INDEX IDX_6AFCA8C58FA7F33 (tracks_id), PRIMARY KEY(relations_id, tracks_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relations_tracks ADD CONSTRAINT FK_6AFCA8C51BFA63C8 FOREIGN KEY (relations_id) REFERENCES relations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relations_tracks ADD CONSTRAINT FK_6AFCA8C58FA7F33 FOREIGN KEY (tracks_id) REFERENCES tracks (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations_tracks DROP FOREIGN KEY FK_6AFCA8C51BFA63C8');
        $this->addSql('DROP TABLE relations');
        $this->addSql('DROP TABLE relations_tracks');
    }
}
