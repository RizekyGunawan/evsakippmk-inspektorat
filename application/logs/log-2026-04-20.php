<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-04-20 02:43:23 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 02:43:24 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 02:43:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 02:44:40 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 02:44:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:44:44 --> Query error: Unknown column 'komentar_evaluasi.subkomponen_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653084
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:44:44 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:44:44 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:44:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`subkomponen_id` = '2'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:44:48 --> Query error: Unknown column 'komentar_evaluasi.subkomponen_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653088
WHERE `komentar_evaluasi`.`subkomponen_id` = '2'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:44:48 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:44:48 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:44:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:44:57 --> Query error: Unknown column 'komentar_evaluasi.subkomponen_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653097
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:44:57 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:44:57 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:01 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653101
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:01 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:45:01 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '3'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:04 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653104
WHERE `komentar_evaluasi`.`indikator_id` = '3'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:04 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:45:04 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:08 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653108
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:08 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:45:08 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '1008'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:11 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653111
WHERE `komentar_evaluasi`.`indikator_id` = '1008'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:11 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:45:11 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 02:45:20 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 02:45:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:21 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653121
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:21 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:45:21 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:22 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653122
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:45:22 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:45:22 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:45:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 02:45:57 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 02:46:15 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 02:46:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:19 --> Query error: Unknown column 'komentar_evaluasi.subkomponen_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653179
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:19 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:46:19 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:46:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:23 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653183
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:23 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:46:23 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:46:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:28 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653188
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:28 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:46:28 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:46:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 02:46:37 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 02:46:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:38 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653198
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:38 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:46:38 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:46:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:39 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653199
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:39 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:46:39 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:46:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '8'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:52 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653212
WHERE `komentar_evaluasi`.`indikator_id` = '8'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:46:52 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:46:52 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:47:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:47:00 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776653220
WHERE `komentar_evaluasi`.`indikator_id` = '7'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 02:47:00 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 02:47:00 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 02:52:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 03:00:09 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:00:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:00:13 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654013
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '8'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:00:13 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:00:13 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:00:18 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:00:18 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:00:35 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:00:35 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:00:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '2'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:00:38 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654038
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '2'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:00:38 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:00:38 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:00:55 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:00:56 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:07:28 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:07:28 --> Unable to connect to the database
ERROR - 2026-04-20 03:07:29 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:07:37 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:07:37 --> Unable to connect to the database
ERROR - 2026-04-20 03:07:42 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:07:42 --> Unable to connect to the database
ERROR - 2026-04-20 03:07:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:09:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:09:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:09:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 03:09:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 353
ERROR - 2026-04-20 03:09:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-20 03:09:37 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:09:37 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:10:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 03:10:32 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:10:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '4'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:10:38 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654638
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '4'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:10:38 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:10:38 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:11:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `...' at line 1 - Invalid query: SELECT `komentar_evaluasi`.*, IF(ta_user.id_role IN (1, 5, `14)`, CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit `Kerja"))`, `ta_user`.`nm_user)` as `sender_name`
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '4'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:11:12 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654672
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '4'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:11:12 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:11:12 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:14:27 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:14:27 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:14:30 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '4'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:30 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654870
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '4'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:30 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:14:30 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:14:40 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:14:43 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:43 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654883
WHERE `komentar_evaluasi`.`indikator_id` = '4'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:43 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:14:43 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:14:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-20 03:14:52 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-20 03:14:52 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '6'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:52 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654892
WHERE `komentar_evaluasi`.`indikator_id` = '6'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:52 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:14:52 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:14:53 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '6'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:53 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654893
WHERE `komentar_evaluasi`.`indikator_id` = '6'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:14:53 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:14:53 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:15:34 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '1008'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:15:34 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776654934
WHERE `komentar_evaluasi`.`indikator_id` = '1008'
AND `komentar_evaluasi`.`id_unit` = '5'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = '2gba0uupinjkupvvt1qrkkmqdk'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-20 03:15:34 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-20 03:15:34 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-20 03:16:10 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:16:10 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-20 03:19:44 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:19:44 --> Unable to connect to the database
ERROR - 2026-04-20 03:19:44 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:21:02 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:21:02 --> Unable to connect to the database
ERROR - 2026-04-20 03:21:02 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:21:22 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:21:22 --> Unable to connect to the database
ERROR - 2026-04-20 03:21:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:21:27 --> Unable to connect to the database
ERROR - 2026-04-20 03:22:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:22:09 --> Unable to connect to the database
ERROR - 2026-04-20 03:22:09 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:22:55 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:22:55 --> Unable to connect to the database
ERROR - 2026-04-20 03:22:56 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:39:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:39:33 --> Unable to connect to the database
ERROR - 2026-04-20 03:39:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:45:45 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:45:45 --> Unable to connect to the database
ERROR - 2026-04-20 03:46:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:46:20 --> Unable to connect to the database
ERROR - 2026-04-20 03:52:55 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:52:55 --> Unable to connect to the database
ERROR - 2026-04-20 03:52:55 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:53:11 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:53:11 --> Unable to connect to the database
ERROR - 2026-04-20 03:53:11 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:54:00 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:54:00 --> Unable to connect to the database
ERROR - 2026-04-20 03:54:00 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:56:15 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:56:15 --> Unable to connect to the database
ERROR - 2026-04-20 03:56:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:56:39 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:56:39 --> Unable to connect to the database
ERROR - 2026-04-20 03:56:48 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:56:48 --> Unable to connect to the database
ERROR - 2026-04-20 03:56:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 03:59:24 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 03:59:24 --> Unable to connect to the database
ERROR - 2026-04-20 03:59:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:00:03 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:00:03 --> Unable to connect to the database
ERROR - 2026-04-20 04:00:03 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:01:04 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:01:04 --> Unable to connect to the database
ERROR - 2026-04-20 04:01:04 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:02:04 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:02:04 --> Unable to connect to the database
ERROR - 2026-04-20 04:02:05 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:02:24 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:02:24 --> Unable to connect to the database
ERROR - 2026-04-20 04:02:49 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:02:49 --> Unable to connect to the database
ERROR - 2026-04-20 04:02:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:03:49 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:03:49 --> Unable to connect to the database
ERROR - 2026-04-20 04:03:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:04:14 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:04:14 --> Unable to connect to the database
ERROR - 2026-04-20 04:04:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:04:35 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:04:35 --> Unable to connect to the database
ERROR - 2026-04-20 04:04:35 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:05:30 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:05:30 --> Unable to connect to the database
ERROR - 2026-04-20 04:05:43 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:05:43 --> Unable to connect to the database
ERROR - 2026-04-20 04:06:30 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:06:30 --> Unable to connect to the database
ERROR - 2026-04-20 04:06:30 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:07:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:07:33 --> Unable to connect to the database
ERROR - 2026-04-20 04:07:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:08:19 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:08:19 --> Unable to connect to the database
ERROR - 2026-04-20 04:08:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:08:43 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:08:43 --> Unable to connect to the database
ERROR - 2026-04-20 04:08:43 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:09:01 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:09:01 --> Unable to connect to the database
ERROR - 2026-04-20 04:09:01 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:11:45 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:11:45 --> Unable to connect to the database
ERROR - 2026-04-20 04:11:45 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:11:45 --> Unable to connect to the database
ERROR - 2026-04-20 04:11:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:14:50 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:14:50 --> Unable to connect to the database
ERROR - 2026-04-20 04:14:50 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:14:50 --> Unable to connect to the database
ERROR - 2026-04-20 04:14:51 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:18:29 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:18:29 --> Unable to connect to the database
ERROR - 2026-04-20 04:18:29 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 04:19:25 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 04:19:25 --> Unable to connect to the database
ERROR - 2026-04-20 06:58:48 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 06:58:48 --> Unable to connect to the database
ERROR - 2026-04-20 06:58:48 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 07:55:58 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 07:55:58 --> Unable to connect to the database
ERROR - 2026-04-20 08:24:12 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 08:24:12 --> Unable to connect to the database
ERROR - 2026-04-20 08:24:12 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-04-20 08:34:58 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 08:34:58 --> Unable to connect to the database
ERROR - 2026-04-20 08:37:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
 C:\laragon\www\evsakippmk-inspektorat\system\database\drivers\mysqli\mysqli_driver.php 135
ERROR - 2026-04-20 08:37:10 --> Unable to connect to the database
