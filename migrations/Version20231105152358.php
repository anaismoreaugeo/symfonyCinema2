<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105152358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__quizz AS SELECT id, title FROM quizz');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('CREATE TABLE quizz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, CONSTRAINT FK_7C77973DF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO quizz (id, title) SELECT id, title FROM __temp__quizz');
        $this->addSql('DROP TABLE __temp__quizz');
        $this->addSql('CREATE INDEX IDX_7C77973DF675F31B ON quizz (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__quizz AS SELECT id, title FROM quizz');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('CREATE TABLE quizz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO quizz (id, title) SELECT id, title FROM __temp__quizz');
        $this->addSql('DROP TABLE __temp__quizz');
    }
}
