<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190312073318 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE post_address (id INT AUTO_INCREMENT NOT NULL, cities LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', areas LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', warehouses LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, skype VARCHAR(50) DEFAULT NULL, cards_number VARCHAR(20) DEFAULT NULL, ref_link VARCHAR(255) DEFAULT NULL, cards_owner_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9444F97DD (phone), UNIQUE INDEX UNIQ_1483A5E9DDB0A2FE (skype), UNIQUE INDEX UNIQ_1483A5E921DFD876 (ref_link), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, refAmount INT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', name VARCHAR(255) NOT NULL, cost INT NOT NULL, recomendedCost INT NOT NULL, new TINYINT(1) NOT NULL, top TINYINT(1) NOT NULL, description VARCHAR(3000) NOT NULL, provider VARCHAR(50) NOT NULL, orders VARCHAR(255) DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(1500) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ord (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, status VARCHAR(255) NOT NULL, saleAmount INT NOT NULL, purchaseAmount INT NOT NULL, income INT NOT NULL, settlementType VARCHAR(255) NOT NULL, clientPhone VARCHAR(20) NOT NULL, clientName VARCHAR(255) NOT NULL, waybill VARCHAR(255) NOT NULL, deliveryAddress VARCHAR(1000) NOT NULL, comment VARCHAR(1500) DEFAULT NULL, INDEX IDX_EB1CEB3AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ord_product (ord_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_99B86CA6E636D3F5 (ord_id), INDEX IDX_99B86CA64584665A (product_id), PRIMARY KEY(ord_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ord ADD CONSTRAINT FK_EB1CEB3AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ord_product ADD CONSTRAINT FK_99B86CA6E636D3F5 FOREIGN KEY (ord_id) REFERENCES ord (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ord_product ADD CONSTRAINT FK_99B86CA64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ord DROP FOREIGN KEY FK_EB1CEB3AA76ED395');
        $this->addSql('ALTER TABLE ord_product DROP FOREIGN KEY FK_99B86CA64584665A');
        $this->addSql('ALTER TABLE ord_product DROP FOREIGN KEY FK_99B86CA6E636D3F5');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP TABLE post_address');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE ord');
        $this->addSql('DROP TABLE ord_product');
        $this->addSql('DROP TABLE category');
    }
}
