<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220313104421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE saison_joueur (saison_id INT NOT NULL, joueur_id INT NOT NULL, INDEX IDX_52CF8D4DF965414C (saison_id), INDEX IDX_52CF8D4DA9E2D76C (joueur_id), PRIMARY KEY(saison_id, joueur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE saison_joueur ADD CONSTRAINT FK_52CF8D4DF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_joueur ADD CONSTRAINT FK_52CF8D4DA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE saison_saison');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE saison_saison (saison_source INT NOT NULL, saison_target INT NOT NULL, INDEX IDX_6F6EF10EF0345BFB (saison_source), INDEX IDX_6F6EF10EE9D10B74 (saison_target), PRIMARY KEY(saison_source, saison_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE saison_saison ADD CONSTRAINT FK_6F6EF10EE9D10B74 FOREIGN KEY (saison_target) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_saison ADD CONSTRAINT FK_6F6EF10EF0345BFB FOREIGN KEY (saison_source) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE saison_joueur');
    }
}
