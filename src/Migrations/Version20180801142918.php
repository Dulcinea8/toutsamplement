<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180801142918 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations DROP FOREIGN KEY FK_146CBF78108B7592');
        $this->addSql('DROP INDEX IDX_146CBF78108B7592 ON relations');
        $this->addSql('ALTER TABLE relations DROP original_id, CHANGE sampleur_id sampleur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tracks ADD relations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E1BFA63C8 FOREIGN KEY (relations_id) REFERENCES relations (id)');
        $this->addSql('CREATE INDEX IDX_246D2A2E1BFA63C8 ON tracks (relations_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations ADD original_id INT NOT NULL, CHANGE sampleur_id sampleur_id INT NOT NULL');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF78108B7592 FOREIGN KEY (original_id) REFERENCES tracks (id)');
        $this->addSql('CREATE INDEX IDX_146CBF78108B7592 ON relations (original_id)');
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E1BFA63C8');
        $this->addSql('DROP INDEX IDX_246D2A2E1BFA63C8 ON tracks');
        $this->addSql('ALTER TABLE tracks DROP relations_id');
    }
}
