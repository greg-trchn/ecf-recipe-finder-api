<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218145421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_aliment (recipe_id INT NOT NULL, aliment_id INT NOT NULL, INDEX IDX_3C1B996B59D8A214 (recipe_id), INDEX IDX_3C1B996B415B9F11 (aliment_id), PRIMARY KEY(recipe_id, aliment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_aliment ADD CONSTRAINT FK_3C1B996B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_aliment ADD CONSTRAINT FK_3C1B996B415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recipe_aliment');
    }
}
