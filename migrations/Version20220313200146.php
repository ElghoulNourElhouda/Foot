<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220313200146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statistique (id INT AUTO_INCREMENT NOT NULL, joueur_id INT DEFAULT NULL, equipe_id INT DEFAULT NULL, saison_id INT DEFAULT NULL, nbrematchs INT NOT NULL, nbrebuts INT NOT NULL, nbreminutes INT NOT NULL, nbrepasses INT NOT NULL, INDEX IDX_73A038ADA9E2D76C (joueur_id), INDEX IDX_73A038AD6D861B89 (equipe_id), INDEX IDX_73A038ADF965414C (saison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT FK_73A038ADA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT FK_73A038AD6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT FK_73A038ADF965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('DROP TABLE saison_equipe');
        $this->addSql('DROP TABLE saison_joueur');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C56D861B89');
        $this->addSql('DROP INDEX IDX_FD71A9C56D861B89 ON joueur');
        $this->addSql('ALTER TABLE joueur DROP equipe_id');
        $this->addSql('ALTER TABLE saison DROP nombrematch, DROP nobreminite, DROP nombrepasse, DROP nombrebuts');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE saison_equipe (saison_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_8BF79E9DF965414C (saison_id), INDEX IDX_8BF79E9D6D861B89 (equipe_id), PRIMARY KEY(saison_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE saison_joueur (saison_id INT NOT NULL, joueur_id INT NOT NULL, INDEX IDX_52CF8D4DF965414C (saison_id), INDEX IDX_52CF8D4DA9E2D76C (joueur_id), PRIMARY KEY(saison_id, joueur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE saison_equipe ADD CONSTRAINT FK_8BF79E9D6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_equipe ADD CONSTRAINT FK_8BF79E9DF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_joueur ADD CONSTRAINT FK_52CF8D4DA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_joueur ADD CONSTRAINT FK_52CF8D4DF965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('ALTER TABLE joueur ADD equipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C56D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_FD71A9C56D861B89 ON joueur (equipe_id)');
        $this->addSql('ALTER TABLE saison ADD nombrematch INT NOT NULL, ADD nobreminite INT NOT NULL, ADD nombrepasse INT NOT NULL, ADD nombrebuts INT NOT NULL');
    }
}
