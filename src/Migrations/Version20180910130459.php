<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180910130459 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes_users (likes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_A87F096F2F23775F (likes_id), INDEX IDX_A87F096F67B3B43D (users_id), PRIMARY KEY(likes_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes_articles (likes_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_ECDC1B342F23775F (likes_id), INDEX IDX_ECDC1B341EBAF6CC (articles_id), PRIMARY KEY(likes_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE likes_users ADD CONSTRAINT FK_A87F096F2F23775F FOREIGN KEY (likes_id) REFERENCES likes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes_users ADD CONSTRAINT FK_A87F096F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes_articles ADD CONSTRAINT FK_ECDC1B342F23775F FOREIGN KEY (likes_id) REFERENCES likes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes_articles ADD CONSTRAINT FK_ECDC1B341EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE likes_users DROP FOREIGN KEY FK_A87F096F2F23775F');
        $this->addSql('ALTER TABLE likes_articles DROP FOREIGN KEY FK_ECDC1B342F23775F');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE likes_users');
        $this->addSql('DROP TABLE likes_articles');
    }
}
