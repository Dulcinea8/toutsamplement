<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180726080433 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations DROP FOREIGN KEY FK_146CBF789D86650F');
        $this->addSql('DROP INDEX IDX_146CBF789D86650F ON relations');
        $this->addSql('ALTER TABLE relations CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF78A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_146CBF78A76ED395 ON relations (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relations DROP FOREIGN KEY FK_146CBF78A76ED395');
        $this->addSql('DROP INDEX IDX_146CBF78A76ED395 ON relations');
        $this->addSql('ALTER TABLE relations CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF789D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_146CBF789D86650F ON relations (user_id_id)');
    }
}
