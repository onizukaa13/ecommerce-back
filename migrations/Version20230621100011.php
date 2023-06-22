<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621100011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orderline ADD order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orderline ADD CONSTRAINT FK_DF24E26C8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_DF24E26C8D9F6D38 ON orderline (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orderline DROP FOREIGN KEY FK_DF24E26C8D9F6D38');
        $this->addSql('DROP INDEX IDX_DF24E26C8D9F6D38 ON orderline');
        $this->addSql('ALTER TABLE orderline DROP order_id');
    }
}
