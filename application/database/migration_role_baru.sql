-- ============================================================
-- MIGRATION: Sistem Role Baru EvSAKIP
-- Tanggal  : 2026-02-23
-- Deskripsi: Penambahan role 9-14 (tidak mengubah role lama)
-- ============================================================

-- -----------------------------------------------
-- 1. Catatan: Role tidak disimpan di tabel terpisah.
--    Role dikelola langsung di kode aplikasi (users.php, sidebar.php, dll.)
--    Role baru yang ditambahkan: 9=Admin, 10=Ketua Tim, 11=Pengendali Teknis,
--    12=Pengendali Mutu, 13=Tim Evaluator, 14=Unit Kerja
-- -----------------------------------------------

-- -----------------------------------------------
-- 2. Buat tabel penugasan evaluator ke unit kerja
-- -----------------------------------------------
CREATE TABLE IF NOT EXISTS `ta_evaluator_unit` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `id_user`     INT(11)      NOT NULL COMMENT 'ID user Tim Evaluator (role 13)',
  `id_unit`     INT(11)      NOT NULL COMMENT 'ID unit kerja yang ditugaskan',
  `tahun`       YEAR         NOT NULL,
  `created_by`  VARCHAR(100) DEFAULT NULL,
  `created_at`  DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_ev_unit_tahun` (`id_user`, `id_unit`, `tahun`),
  KEY `idx_id_user` (`id_user`),
  KEY `idx_id_unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------
-- 3. Buat tabel audit trail perubahan EV
-- -----------------------------------------------
CREATE TABLE IF NOT EXISTS `ta_ev_history` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `id_ev`       INT(11)      DEFAULT NULL COMMENT 'FK ta_ev (aspek/kriteria)',
  `id_ev0`      INT(11)      DEFAULT NULL COMMENT 'FK ta_ev0 (subkomponen)',
  `id_unit`     INT(11)      DEFAULT NULL,
  `tahun`       YEAR         DEFAULT NULL,
  `field_name`  VARCHAR(100) NOT NULL COMMENT 'Nama field yang diubah',
  `old_value`   TEXT         DEFAULT NULL,
  `new_value`   TEXT         DEFAULT NULL,
  `changed_by`  VARCHAR(100) NOT NULL COMMENT 'Username yang mengubah',
  `id_role`     INT(11)      DEFAULT NULL COMMENT 'Role saat perubahan',
  `changed_at`  DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_id_ev`  (`id_ev`),
  KEY `idx_id_ev0` (`id_ev0`),
  KEY `idx_unit_tahun` (`id_unit`, `tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------
-- 4. Insert user default untuk role baru
--    Password '123456' di-hash dengan bcrypt
--    Jalankan PHP dulu: echo password_hash('123456', PASSWORD_BCRYPT);
--    lalu ganti placeholder di bawah ini
-- -----------------------------------------------
-- CATATAN: Ganti HASH_BCRYPT_123456 dengan hasil dari password_hash()
-- Contoh placeholder — WAJIB diganti sebelum dijalankan:
SET @hash = '$2y$10$ERFXBfyyvP1b7NAr6ntCze6OrnLiUc0JG7FT.HMLV3TFlTBcGX4xa';
-- Hash di atas adalah bcrypt dari password '123456'

INSERT IGNORE INTO ta_user (username, password, nm_user, id_role, id_unit) VALUES ('admin',             '$2y$10$ERFXBfyyvP1b7NAr6ntCze6OrnLiUc0JG7FT.HMLV3TFlTBcGX4xa', 'Admin',             9,  NULL);
INSERT IGNORE INTO ta_user (username, password, nm_user, id_role, id_unit) VALUES ('ketua.tim',         '$2y$10$ERFXBfyyvP1b7NAr6ntCze6OrnLiUc0JG7FT.HMLV3TFlTBcGX4xa', 'Ketua Tim',         10, NULL);
INSERT IGNORE INTO ta_user (username, password, nm_user, id_role, id_unit) VALUES ('pengendali.teknis', '$2y$10$ERFXBfyyvP1b7NAr6ntCze6OrnLiUc0JG7FT.HMLV3TFlTBcGX4xa', 'Pengendali Teknis', 11, NULL);
INSERT IGNORE INTO ta_user (username, password, nm_user, id_role, id_unit) VALUES ('pengendali.mutu',   '$2y$10$ERFXBfyyvP1b7NAr6ntCze6OrnLiUc0JG7FT.HMLV3TFlTBcGX4xa', 'Pengendali Mutu',   12, NULL);
INSERT IGNORE INTO ta_user (username, password, nm_user, id_role, id_unit) VALUES ('evaluator',         '$2y$10$ERFXBfyyvP1b7NAr6ntCze6OrnLiUc0JG7FT.HMLV3TFlTBcGX4xa', 'Tim Evaluator',     13, NULL);
-- Akun UK1...UKn dibuat oleh Admin melalui antarmuka aplikasi

-- ============================================================
-- SELESAI — Verifikasi dengan:
-- SELECT username, nm_user, id_role FROM ta_user WHERE id_role >= 9 ORDER BY id_role;
-- SELECT * FROM ta_evaluator_unit LIMIT 1;
-- SELECT * FROM ta_ev_history LIMIT 1;
-- SELECT username, id_role FROM ta_user WHERE id_role >= 9;
-- ============================================================
