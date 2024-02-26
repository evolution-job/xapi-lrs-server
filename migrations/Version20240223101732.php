<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223101732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE xapi_attachment (`identifier` INT AUTO_INCREMENT NOT NULL, `statement_id` VARCHAR(255) DEFAULT NULL, `usage_type` VARCHAR(255) NOT NULL, `content_type` VARCHAR(255) NOT NULL, `length` INT NOT NULL, `sha2` VARCHAR(255) NOT NULL, `display` JSON NOT NULL COMMENT \'(DC2Type:json_array)\', `has_description` TINYINT(1) NOT NULL, `description` JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', `file_url` VARCHAR(255) DEFAULT NULL, `content` LONGTEXT DEFAULT NULL, INDEX IDX_7148C9A1319F2A73 (`statement_id`), PRIMARY KEY(`identifier`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_context (`identifier` INT AUTO_INCREMENT NOT NULL, `registration` VARCHAR(255) DEFAULT NULL, `has_context_activities` TINYINT(1) DEFAULT NULL, `revision` VARCHAR(255) DEFAULT NULL, `platform` VARCHAR(255) DEFAULT NULL, `language` VARCHAR(255) DEFAULT NULL, `statement` VARCHAR(255) DEFAULT NULL, `instructor_id` INT DEFAULT NULL, `team_id` INT DEFAULT NULL, `extensions_id` INT DEFAULT NULL, UNIQUE INDEX UNIQ_3D777190B26C3C29 (`instructor_id`), UNIQUE INDEX UNIQ_3D77719071BF2681 (`team_id`), UNIQUE INDEX UNIQ_3D777190DB361082 (`extensions_id`), PRIMARY KEY(`identifier`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_extensions (`identifier` INT AUTO_INCREMENT NOT NULL, `extensions` JSON NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(`identifier`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_object (`identifier` INT AUTO_INCREMENT NOT NULL, `type` VARCHAR(255) DEFAULT NULL, `activity_id` VARCHAR(255) DEFAULT NULL, `has_activity_definition` TINYINT(1) DEFAULT NULL, `has_activity_name` TINYINT(1) DEFAULT NULL, `activity_name` JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', `has_activity_description` TINYINT(1) DEFAULT NULL, `activity_description` JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', `activity_type` VARCHAR(255) DEFAULT NULL, `activity_more_info` VARCHAR(255) DEFAULT NULL, `mbox` VARCHAR(255) DEFAULT NULL, `mbox_sha1_sum` VARCHAR(255) DEFAULT NULL, `open_id` VARCHAR(255) DEFAULT NULL, `account_name` VARCHAR(255) DEFAULT NULL, `account_home_page` VARCHAR(255) DEFAULT NULL, `name` VARCHAR(255) DEFAULT NULL, `referenced_statement_id` VARCHAR(255) DEFAULT NULL, `actor_id` INT DEFAULT NULL, `object_id` INT DEFAULT NULL, `activity_extensions_id` INT DEFAULT NULL, `verb_id` INT DEFAULT NULL, `group_id` INT DEFAULT NULL, `parent_context_id` INT DEFAULT NULL, `grouping_context_id` INT DEFAULT NULL, `category_context_id` INT DEFAULT NULL, `other_context_id` INT DEFAULT NULL, UNIQUE INDEX UNIQ_E2B68640DDCD8401 (`actor_id`), UNIQUE INDEX UNIQ_E2B68640EBF61561 (`object_id`), UNIQUE INDEX UNIQ_E2B68640A03118A (`activity_extensions_id`), INDEX IDX_E2B686403488C618 (`verb_id`), INDEX IDX_E2B68640A3927697 (`group_id`), INDEX IDX_E2B6864029B3DF5B (`parent_context_id`), INDEX IDX_E2B68640F3DD0B2 (`grouping_context_id`), INDEX IDX_E2B68640E632571 (`category_context_id`), INDEX IDX_E2B68640D0E91813 (`other_context_id`), INDEX uniq_search_index (activity_id, activity_type), PRIMARY KEY(`identifier`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_result (`identifier` INT AUTO_INCREMENT NOT NULL, `has_score` TINYINT(1) NOT NULL, `scaled` DOUBLE PRECISION DEFAULT NULL, `raw` DOUBLE PRECISION DEFAULT NULL, `min` DOUBLE PRECISION DEFAULT NULL, `max` DOUBLE PRECISION DEFAULT NULL, `success` TINYINT(1) DEFAULT NULL, `completion` TINYINT(1) DEFAULT NULL, `response` VARCHAR(255) DEFAULT NULL, `duration` VARCHAR(255) DEFAULT NULL, `extensions_id` INT DEFAULT NULL, UNIQUE INDEX UNIQ_5971ECBFDB361082 (`extensions_id`), PRIMARY KEY(`identifier`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_state (`registration_id` VARCHAR(255) NOT NULL, `activity_id` VARCHAR(255) NOT NULL, `state_id` VARCHAR(255) NOT NULL, `actor_id` INT DEFAULT NULL, `data` LONGTEXT DEFAULT NULL, INDEX IDX_671B3F9FDDCD8401 (`actor_id`), PRIMARY KEY(`activity_id`, `state_id`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_statement (`id` VARCHAR(255) NOT NULL, `created` DATETIME DEFAULT NULL, `stored` DATETIME DEFAULT NULL, `has_attachments` TINYINT(1) NOT NULL, `result_id` INT DEFAULT NULL, `actor_id` INT DEFAULT NULL, `verb_id` INT DEFAULT NULL, `object_id` INT DEFAULT NULL, `authority_id` INT DEFAULT NULL, `context_id` INT DEFAULT NULL, UNIQUE INDEX UNIQ_BAF6663BA8BB76EB (`result_id`), INDEX IDX_BAF6663BDDCD8401 (`actor_id`), INDEX IDX_BAF6663B3488C618 (`verb_id`), INDEX IDX_BAF6663BEBF61561 (`object_id`), INDEX IDX_BAF6663B319A5A43 (`authority_id`), INDEX IDX_BAF6663BAC004ABE (`context_id`), PRIMARY KEY(`id`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xapi_verb (`identifier` INT AUTO_INCREMENT NOT NULL, `id` VARCHAR(255) NOT NULL, `display` JSON NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(`identifier`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE xapi_attachment ADD CONSTRAINT FK_7148C9A1319F2A73 FOREIGN KEY (`statement_id`) REFERENCES xapi_statement (`id`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_context ADD CONSTRAINT FK_3D777190B26C3C29 FOREIGN KEY (`instructor_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_context ADD CONSTRAINT FK_3D77719071BF2681 FOREIGN KEY (`team_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_context ADD CONSTRAINT FK_3D777190DB361082 FOREIGN KEY (`extensions_id`) REFERENCES xapi_extensions (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640DDCD8401 FOREIGN KEY (`actor_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640EBF61561 FOREIGN KEY (`object_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640A03118A FOREIGN KEY (`activity_extensions_id`) REFERENCES xapi_extensions (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B686403488C618 FOREIGN KEY (`verb_id`) REFERENCES xapi_verb (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640A3927697 FOREIGN KEY (`group_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B6864029B3DF5B FOREIGN KEY (`parent_context_id`) REFERENCES xapi_context (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640F3DD0B2 FOREIGN KEY (`grouping_context_id`) REFERENCES xapi_context (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640E632571 FOREIGN KEY (`category_context_id`) REFERENCES xapi_context (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_object ADD CONSTRAINT FK_E2B68640D0E91813 FOREIGN KEY (`other_context_id`) REFERENCES xapi_context (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_result ADD CONSTRAINT FK_5971ECBFDB361082 FOREIGN KEY (`extensions_id`) REFERENCES xapi_extensions (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_state ADD CONSTRAINT FK_671B3F9FDDCD8401 FOREIGN KEY (`actor_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_statement ADD CONSTRAINT FK_BAF6663BA8BB76EB FOREIGN KEY (`result_id`) REFERENCES xapi_result (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_statement ADD CONSTRAINT FK_BAF6663BDDCD8401 FOREIGN KEY (`actor_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_statement ADD CONSTRAINT FK_BAF6663B3488C618 FOREIGN KEY (`verb_id`) REFERENCES xapi_verb (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_statement ADD CONSTRAINT FK_BAF6663BEBF61561 FOREIGN KEY (`object_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_statement ADD CONSTRAINT FK_BAF6663B319A5A43 FOREIGN KEY (`authority_id`) REFERENCES xapi_object (`identifier`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE xapi_statement ADD CONSTRAINT FK_BAF6663BAC004ABE FOREIGN KEY (`context_id`) REFERENCES xapi_context (`identifier`) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B6864029B3DF5B');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640F3DD0B2');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640E632571');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640D0E91813');
        $this->addSql('ALTER TABLE xapi_statement DROP FOREIGN KEY FK_BAF6663BAC004ABE');
        $this->addSql('ALTER TABLE xapi_context DROP FOREIGN KEY FK_3D777190DB361082');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640A03118A');
        $this->addSql('ALTER TABLE xapi_result DROP FOREIGN KEY FK_5971ECBFDB361082');
        $this->addSql('ALTER TABLE xapi_context DROP FOREIGN KEY FK_3D777190B26C3C29');
        $this->addSql('ALTER TABLE xapi_context DROP FOREIGN KEY FK_3D77719071BF2681');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640DDCD8401');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640EBF61561');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B68640A3927697');
        $this->addSql('ALTER TABLE xapi_state DROP FOREIGN KEY FK_671B3F9FDDCD8401');
        $this->addSql('ALTER TABLE xapi_statement DROP FOREIGN KEY FK_BAF6663BDDCD8401');
        $this->addSql('ALTER TABLE xapi_statement DROP FOREIGN KEY FK_BAF6663BEBF61561');
        $this->addSql('ALTER TABLE xapi_statement DROP FOREIGN KEY FK_BAF6663B319A5A43');
        $this->addSql('ALTER TABLE xapi_statement DROP FOREIGN KEY FK_BAF6663BA8BB76EB');
        $this->addSql('ALTER TABLE xapi_attachment DROP FOREIGN KEY FK_7148C9A1319F2A73');
        $this->addSql('ALTER TABLE xapi_object DROP FOREIGN KEY FK_E2B686403488C618');
        $this->addSql('ALTER TABLE xapi_statement DROP FOREIGN KEY FK_BAF6663B3488C618');
        $this->addSql('DROP TABLE xapi_attachment');
        $this->addSql('DROP TABLE xapi_context');
        $this->addSql('DROP TABLE xapi_extensions');
        $this->addSql('DROP TABLE xapi_object');
        $this->addSql('DROP TABLE xapi_result');
        $this->addSql('DROP TABLE xapi_state');
        $this->addSql('DROP TABLE xapi_statement');
        $this->addSql('DROP TABLE xapi_verb');
    }
}
