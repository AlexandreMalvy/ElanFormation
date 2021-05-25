<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525123010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_module (formation_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_2C3D28055200282E (formation_id), INDEX IDX_2C3D2805AFC2B591 (module_id), PRIMARY KEY(formation_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_module ADD CONSTRAINT FK_2C3D28055200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_module ADD CONSTRAINT FK_2C3D2805AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE formation_modul');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_modul (formation_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_EBDCFEFD5200282E (formation_id), INDEX IDX_EBDCFEFD19952065 (module_id), PRIMARY KEY(formation_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formation_modul ADD CONSTRAINT FK_EBDCFEFD19952065 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_modul ADD CONSTRAINT FK_EBDCFEFD5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE formation_module');
    }
}
