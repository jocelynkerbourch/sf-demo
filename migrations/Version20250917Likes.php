<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250917Likes extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add likes_count to article and user_article_like table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE blog_post ADD likes_count INT NOT NULL');
        $this->addSql('CREATE TABLE user_article_like (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            post_id INT NOT NULL,
            created_at DATETIME NOT NULL,
            UNIQUE INDEX UNIQ_USER_POST (user_id, post_id),
            INDEX IDX_LIKE_POST (post_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_article_like ADD CONSTRAINT FK_LIKE_USER FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_article_like ADD CONSTRAINT FK_LIKE_POST FOREIGN KEY (post_id) REFERENCES blog_post (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE blog_post DROP likes_count');
        $this->addSql('DROP TABLE user_article_like');
    }
}