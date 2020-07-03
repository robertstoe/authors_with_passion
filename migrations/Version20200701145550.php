<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701145550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articles (ArticlesID INT AUTO_INCREMENT NOT NULL, Title VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Content TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, creation_date DATETIME NOT NULL, AuthorID INT NOT NULL, INDEX AuthorID (AuthorID), PRIMARY KEY(ArticlesID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articlestags (TagID INT NOT NULL, ArticleID INT NOT NULL, INDEX Constr_ArticlesTags_Article_fk (ArticleID), INDEX IDX_DBCFD12295B9A210 (TagID), PRIMARY KEY(TagID, ArticleID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE authors (AuthorsID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Surname VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, Email VARCHAR(320) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Nickname VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, total_score INT DEFAULT NULL, total_votes INT DEFAULT NULL, UNIQUE INDEX Nickname (Nickname), UNIQUE INDEX Email (Email), PRIMARY KEY(AuthorsID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tags (TagsID INT AUTO_INCREMENT NOT NULL, TagName VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(TagsID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE articles');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE articlestags');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE authors');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tags');
    }
}
