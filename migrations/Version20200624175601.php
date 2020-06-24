<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624175601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicine ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE medicine ADD CONSTRAINT FK_58362A8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_58362A8DA76ED395 ON medicine (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicine DROP FOREIGN KEY FK_58362A8DA76ED395');
        $this->addSql('DROP INDEX IDX_58362A8DA76ED395 ON medicine');
        $this->addSql('ALTER TABLE medicine DROP user_id');
    }
}
