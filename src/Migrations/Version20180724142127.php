<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180724142127 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artistes CHANGE user user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artistes ADD CONSTRAINT FK_FDF1943FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_FDF1943FA76ED395 ON artistes (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artistes DROP FOREIGN KEY FK_FDF1943FA76ED395');
        $this->addSql('DROP INDEX IDX_FDF1943FA76ED395 ON artistes');
        $this->addSql('ALTER TABLE artistes CHANGE user_id user INT DEFAULT NULL');
    }
}
