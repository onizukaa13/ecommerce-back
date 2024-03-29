<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621101820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33116A2B381');
        $this->addSql('DROP INDEX IDX_CBE5A33116A2B381 ON book');
        $this->addSql('ALTER TABLE book DROP book_id');
        $this->addSql('ALTER TABLE orderline ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orderline ADD CONSTRAINT FK_DF24E26C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_DF24E26C16A2B381 ON orderline (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CBE5A33116A2B381 ON book (book_id)');
        $this->addSql('ALTER TABLE orderline DROP FOREIGN KEY FK_DF24E26C16A2B381');
        $this->addSql('DROP INDEX IDX_DF24E26C16A2B381 ON orderline');
        $this->addSql('ALTER TABLE orderline DROP book_id');
    }
}
