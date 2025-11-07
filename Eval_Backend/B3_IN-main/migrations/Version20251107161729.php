<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251107161729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infraction ADD pilote_id INT DEFAULT NULL, ADD ecurie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE infraction ADD CONSTRAINT FK_C1A458F5F510AAE9 FOREIGN KEY (pilote_id) REFERENCES pilotes (id)');
        $this->addSql('ALTER TABLE infraction ADD CONSTRAINT FK_C1A458F557F92A74 FOREIGN KEY (ecurie_id) REFERENCES ecurie (id)');
        $this->addSql('CREATE INDEX IDX_C1A458F5F510AAE9 ON infraction (pilote_id)');
        $this->addSql('CREATE INDEX IDX_C1A458F557F92A74 ON infraction (ecurie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infraction DROP FOREIGN KEY FK_C1A458F5F510AAE9');
        $this->addSql('ALTER TABLE infraction DROP FOREIGN KEY FK_C1A458F557F92A74');
        $this->addSql('DROP INDEX IDX_C1A458F5F510AAE9 ON infraction');
        $this->addSql('DROP INDEX IDX_C1A458F557F92A74 ON infraction');
        $this->addSql('ALTER TABLE infraction DROP pilote_id, DROP ecurie_id');
    }
}
