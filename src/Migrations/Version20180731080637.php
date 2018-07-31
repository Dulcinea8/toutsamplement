<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180731080637 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31681BFA63C8');
        $this->addSql('DROP INDEX UNIQ_BFDD31681BFA63C8 ON articles');
        $this->addSql('ALTER TABLE articles DROP relations_id');
        $this->addSql('ALTER TABLE relations ADD articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE relations ADD CONSTRAINT FK_146CBF781EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_146CBF781EBAF6CC ON relations (articles_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD relations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31681BFA63C8 FOREIGN KEY (relations_id) REFERENCES relations (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD31681BFA63C8 ON articles (relations_id)');
        $this->addSql('ALTER TABLE relations DROP FOREIGN KEY FK_146CBF781EBAF6CC');
        $this->addSql('DROP INDEX UNIQ_146CBF781EBAF6CC ON relations');
        $this->addSql('ALTER TABLE relations DROP articles_id');
    }
}
