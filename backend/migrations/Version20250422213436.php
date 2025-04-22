<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422213436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE board (id SERIAL NOT NULL, workspace_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_58562B4782D40A1F ON board (workspace_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN board.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE workspace (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN workspace.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE workspace_user (workspace_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(workspace_id, user_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C971A58B82D40A1F ON workspace_user (workspace_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C971A58BA76ED395 ON workspace_user (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE board ADD CONSTRAINT FK_58562B4782D40A1F FOREIGN KEY (workspace_id) REFERENCES workspace (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workspace_user ADD CONSTRAINT FK_C971A58B82D40A1F FOREIGN KEY (workspace_id) REFERENCES workspace (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workspace_user ADD CONSTRAINT FK_C971A58BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE board DROP CONSTRAINT FK_58562B4782D40A1F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workspace_user DROP CONSTRAINT FK_C971A58B82D40A1F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workspace_user DROP CONSTRAINT FK_C971A58BA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE board
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE workspace
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE workspace_user
        SQL);
    }
}
