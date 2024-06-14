<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613143538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE payment ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE product_image ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE product_image ALTER modified_at DROP NOT NULL');
        $this->addSql('ALTER TABLE review ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE tva ALTER created_at DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tva ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE review ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE product_image ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE product_image ALTER modified_at SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE payment ALTER created_at SET NOT NULL');
    }
}
