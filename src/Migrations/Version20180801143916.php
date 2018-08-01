<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180801143916 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations DROP FOREIGN KEY FK_146CBF784E35BEC1');
        $this->addSql('DROP INDEX IDX_146CBF784E35BEC1 ON relations');
        $this->addSql('ALTER TABLE relations DROP sampleur_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations ADD sampleur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF784E35BEC1 FOREIGN KEY (sampleur_id) REFERENCES tracks (id)');
        $this->addSql('CREATE INDEX IDX_146CBF784E35BEC1 ON relations (sampleur_id)');
    }
}
