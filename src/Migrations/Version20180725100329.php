<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725100329 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE relations (id INT AUTO_INCREMENT NOT NULL, sampleur_id INT NOT NULL, original_id INT NOT NULL, INDEX IDX_146CBF784E35BEC1 (sampleur_id), INDEX IDX_146CBF78108B7592 (original_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF784E35BEC1 FOREIGN KEY (sampleur_id) REFERENCES tracks (id)');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF78108B7592 FOREIGN KEY (original_id) REFERENCES tracks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE relations');
    }
}
