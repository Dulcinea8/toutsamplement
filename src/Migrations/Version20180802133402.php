<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180802133402 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE likes_users (likes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_A87F096F2F23775F (likes_id), INDEX IDX_A87F096F67B3B43D (users_id), PRIMARY KEY(likes_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE likes_users ADD CONSTRAINT FK_A87F096F2F23775F FOREIGN KEY (likes_id) REFERENCES likes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes_users ADD CONSTRAINT FK_A87F096F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('DROP INDEX UNIQ_49CA4E7DA76ED395 ON likes');
        $this->addSql('ALTER TABLE likes DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE likes_users');
        $this->addSql('ALTER TABLE likes ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_49CA4E7DA76ED395 ON likes (user_id)');
    }
}
