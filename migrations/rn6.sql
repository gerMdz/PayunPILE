CREATE TABLE cuerpo_mail
(
    id            INT AUTO_INCREMENT NOT NULL,
    texto         VARCHAR(510)       NOT NULL,
    is_activo     TINYINT(1)         NOT NULL,
    is_hability   TINYINT(1)         NOT NULL,
    textofirma    VARCHAR(255)       NOT NULL,
    nombre        VARCHAR(255)       NOT NULL,
    identificador VARCHAR(100)       NOT NULL,
    UNIQUE INDEX UNIQ_95BB1BE5A8255881 (identificador),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;
ALTER TABLE group_celebration
    ADD mail_id INT DEFAULT NULL;
ALTER TABLE group_celebration
    ADD CONSTRAINT FK_873E1EE7C8776F01 FOREIGN KEY (mail_id) REFERENCES cuerpo_mail (id);
CREATE INDEX IDX_873E1EE7C8776F01 ON group_celebration (mail_id);
