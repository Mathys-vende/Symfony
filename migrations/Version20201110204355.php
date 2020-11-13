<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110204355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA93A37A35C');
        $this->addSql('ALTER TABLE projet ADD apayer DOUBLE PRECISION DEFAULT NULL, ADD arecevoir DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA93A37A35C FOREIGN KEY (id_soiree_id) REFERENCES soiree (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA93A37A35C ');
        $this->addSql('ALTER TABLE projet DROP apayer, DROP arecevoir');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA93A37A35C FOREIGN KEY (id_soiree_id) REFERENCES soiree (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
