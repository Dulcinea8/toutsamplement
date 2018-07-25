<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725095504 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE relations');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE relations (original_id INT NOT NULL, sample_id INT NOT NULL, INDEX IDX_146CBF78108B7592 (original_id), INDEX IDX_146CBF781B1FEA20 (sample_id), PRIMARY KEY(original_id, sample_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF78108B7592 FOREIGN KEY (original_id) REFERENCES tracks (id)');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF781B1FEA20 FOREIGN KEY (sample_id) REFERENCES tracks (id)');
    }
}
