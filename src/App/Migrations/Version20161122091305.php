<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161122091305 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cantor (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, colecao_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, ativo SMALLINT NOT NULL, INDEX IDX_4E10122DD43D97B8 (colecao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_links (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, media VARCHAR(255) NOT NULL, INDEX IDX_6385FA094B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(60) NOT NULL, email VARCHAR(90) NOT NULL, password VARCHAR(50) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, roles VARCHAR(60) NOT NULL, cadastro DATETIME NOT NULL, ativo SMALLINT DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_EF687F2E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compositor (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_anexo (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, imagem VARCHAR(255) DEFAULT NULL, ativo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, mensagem VARCHAR(255) NOT NULL, cadastro DATETIME NOT NULL, INDEX IDX_8F3F68C5DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comentarios (id INT AUTO_INCREMENT NOT NULL, musica_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, comentario LONGTEXT NOT NULL, cadastro DATETIME NOT NULL, ativo TINYINT(1) NOT NULL, INDEX IDX_F54B3FC099E6F854 (musica_id), INDEX IDX_F54B3FC0DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colecao (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, imagem LONGTEXT DEFAULT NULL, ativo SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_6FBC94264B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, imagem VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, descricao LONGTEXT NOT NULL, conteudo LONGTEXT NOT NULL, cadastro DATETIME NOT NULL, year VARCHAR(255) NOT NULL, month VARCHAR(255) NOT NULL, atualizado DATETIME DEFAULT NULL, ativo SMALLINT DEFAULT 1 NOT NULL, background LONGTEXT DEFAULT NULL, INDEX IDX_885DBAFADB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musica_anexos (id INT AUTO_INCREMENT NOT NULL, musica_id INT DEFAULT NULL, tipo_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, link_externo SMALLINT NOT NULL, link LONGTEXT DEFAULT NULL, cadastro DATETIME NOT NULL, ativo TINYINT(1) NOT NULL, INDEX IDX_849BE9F099E6F854 (musica_id), INDEX IDX_849BE9F0A9276E6C (tipo_id), INDEX IDX_849BE9F0DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musica (id INT AUTO_INCREMENT NOT NULL, categoria_id INT DEFAULT NULL, album_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, numero INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, tom VARCHAR(255) NOT NULL, letra LONGTEXT DEFAULT NULL, letra_original LONGTEXT DEFAULT NULL, cadastro DATETIME NOT NULL, novo TINYINT(1) NOT NULL, ativo TINYINT(1) NOT NULL, INDEX IDX_7E7344EF3397707A (categoria_id), INDEX IDX_7E7344EF1137ABCF (album_id), INDEX IDX_7E7344EFDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, requer_previlegio TINYINT(1) NOT NULL, cadastro DATETIME NOT NULL, ativo SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, session_id VARCHAR(255) NOT NULL, session_value LONGTEXT NOT NULL, session_lifetime VARCHAR(255) NOT NULL, session_time INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) DEFAULT NULL, background VARCHAR(255) DEFAULT NULL, envia_email TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122DD43D97B8 FOREIGN KEY (colecao_id) REFERENCES colecao (id)');
        $this->addSql('ALTER TABLE posts_links ADD CONSTRAINT FK_6385FA094B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C5DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE comentarios ADD CONSTRAINT FK_F54B3FC099E6F854 FOREIGN KEY (musica_id) REFERENCES musica (id)');
        $this->addSql('ALTER TABLE comentarios ADD CONSTRAINT FK_F54B3FC0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC94264B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFADB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE musica_anexos ADD CONSTRAINT FK_849BE9F099E6F854 FOREIGN KEY (musica_id) REFERENCES musica (id)');
        $this->addSql('ALTER TABLE musica_anexos ADD CONSTRAINT FK_849BE9F0A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_anexo (id)');
        $this->addSql('ALTER TABLE musica_anexos ADD CONSTRAINT FK_849BE9F0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE musica ADD CONSTRAINT FK_7E7344EF3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE musica ADD CONSTRAINT FK_7E7344EF1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE musica ADD CONSTRAINT FK_7E7344EFDB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE musica DROP FOREIGN KEY FK_7E7344EF3397707A');
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C5DB38439E');
        $this->addSql('ALTER TABLE comentarios DROP FOREIGN KEY FK_F54B3FC0DB38439E');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFADB38439E');
        $this->addSql('ALTER TABLE musica_anexos DROP FOREIGN KEY FK_849BE9F0DB38439E');
        $this->addSql('ALTER TABLE musica DROP FOREIGN KEY FK_7E7344EFDB38439E');
        $this->addSql('ALTER TABLE musica_anexos DROP FOREIGN KEY FK_849BE9F0A9276E6C');
        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122DD43D97B8');
        $this->addSql('ALTER TABLE musica DROP FOREIGN KEY FK_7E7344EF1137ABCF');
        $this->addSql('ALTER TABLE posts_links DROP FOREIGN KEY FK_6385FA094B89032C');
        $this->addSql('ALTER TABLE tags DROP FOREIGN KEY FK_6FBC94264B89032C');
        $this->addSql('ALTER TABLE comentarios DROP FOREIGN KEY FK_F54B3FC099E6F854');
        $this->addSql('ALTER TABLE musica_anexos DROP FOREIGN KEY FK_849BE9F099E6F854');
        $this->addSql('DROP TABLE cantor');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE posts_links');
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('DROP TABLE compositor');
        $this->addSql('DROP TABLE tipo_anexo');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE comentarios');
        $this->addSql('DROP TABLE colecao');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE musica_anexos');
        $this->addSql('DROP TABLE musica');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE config');
    }
}
