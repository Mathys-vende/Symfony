<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104154113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soiree (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet ADD id_soiree_id INT NOT NULL');
        $this->addSql(' ALTER TABLE `projet` ADD CONSTRAINT `FK_50159CA93A37A35C` FOREIGN KEY (`id_soiree_id`) REFERENCES `soiree`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->addSql('CREATE INDEX IDX_50159CA93A37A35C ON projet (id_soiree_id)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA93A37A35C');
        $this->addSql('DROP TABLE soiree');
        $this->addSql('DROP INDEX IDX_50159CA93A37A35C ON projet');
        $this->addSql('ALTER TABLE projet DROP id_soiree_id');
    }
}
