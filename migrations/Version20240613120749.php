<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613120749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE customer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE customer_address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_line_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE review_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tva_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN category.modified_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, user_id INT NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, phone VARCHAR(100) NOT NULL, bithdate_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09A76ED395 ON customer (user_id)');
        $this->addSql('COMMENT ON COLUMN customer.bithdate_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE customer_address (id INT NOT NULL, customer_id INT NOT NULL, name VARCHAR(255) NOT NULL, line1 VARCHAR(255) NOT NULL, line2 VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, type TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
        $this->addSql('COMMENT ON COLUMN customer_address.type IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, customer_id INT NOT NULL, order_number VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, shipped_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON "order" (customer_id)');
        $this->addSql('COMMENT ON COLUMN "order".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "order".shipped_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE order_line (id INT NOT NULL, inside_id INT NOT NULL, product_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION DEFAULT NULL, qty INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9CE58EE1D899CF62 ON order_line (inside_id)');
        $this->addSql('CREATE INDEX IDX_9CE58EE14584665A ON order_line (product_id)');
        $this->addSql('CREATE TABLE payment (id INT NOT NULL, command_id INT NOT NULL, type VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D28840D33E1689A ON payment (command_id)');
        $this->addSql('COMMENT ON COLUMN payment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('COMMENT ON COLUMN product.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product.modified_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_tva (product_id INT NOT NULL, tva_id INT NOT NULL, PRIMARY KEY(product_id, tva_id))');
        $this->addSql('CREATE INDEX IDX_F46C23F4584665A ON product_tva (product_id)');
        $this->addSql('CREATE INDEX IDX_F46C23F4D79775F ON product_tva (tva_id)');
        $this->addSql('CREATE TABLE product_image (id INT NOT NULL, product_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, file VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64617F034584665A ON product_image (product_id)');
        $this->addSql('COMMENT ON COLUMN product_image.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN product_image.modified_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE review (id INT NOT NULL, customer_id INT NOT NULL, product_id INT NOT NULL, content TEXT NOT NULL, review INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C69395C3F3 ON review (customer_id)');
        $this->addSql('CREATE INDEX IDX_794381C64584665A ON review (product_id)');
        $this->addSql('COMMENT ON COLUMN review.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN review.modified_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE tva (id INT NOT NULL, name VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tva.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN tva.modified_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_address ADD CONSTRAINT FK_1193CB3F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1D899CF62 FOREIGN KEY (inside_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE14584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D33E1689A FOREIGN KEY (command_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_tva ADD CONSTRAINT FK_F46C23F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_tva ADD CONSTRAINT FK_F46C23F4D79775F FOREIGN KEY (tva_id) REFERENCES tva (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C69395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customer_address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE order_line_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE review_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tva_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09A76ED395');
        $this->addSql('ALTER TABLE customer_address DROP CONSTRAINT FK_1193CB3F9395C3F3');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE order_line DROP CONSTRAINT FK_9CE58EE1D899CF62');
        $this->addSql('ALTER TABLE order_line DROP CONSTRAINT FK_9CE58EE14584665A');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840D33E1689A');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product_tva DROP CONSTRAINT FK_F46C23F4584665A');
        $this->addSql('ALTER TABLE product_tva DROP CONSTRAINT FK_F46C23F4D79775F');
        $this->addSql('ALTER TABLE product_image DROP CONSTRAINT FK_64617F034584665A');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C69395C3F3');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C64584665A');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_line');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_tva');
        $this->addSql('DROP TABLE product_image');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE tva');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
