<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-04-22 01:48:42 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 01:48:42 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 01:59:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:07:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:23:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:31:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:31:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:32:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:32:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:32:44 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:32:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:32:59 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:32:59 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:32:59 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:32:59 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776825179
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = 'v2ob0qbqqcinod45fs7sh6pa3r'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:32:59 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-22 02:32:59 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-22 02:33:00 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:33:00 --> Query error: Unknown column 'komentar_evaluasi.indikator_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776825180
WHERE `komentar_evaluasi`.`indikator_id` = '1'
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = 'v2ob0qbqqcinod45fs7sh6pa3r'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:33:00 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-22 02:33:00 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-22 02:33:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:33:37 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:33:38 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:33:38 --> Query error: Unknown column 'komentar_evaluasi.subkomponen_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776825218
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = 'v2ob0qbqqcinod45fs7sh6pa3r'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:33:38 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-22 02:33:38 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-22 02:33:39 --> Query error: Table 'evsakippmk.ta_unit' doesn't exist - Invalid query: SELECT komentar_evaluasi.*, IF(ta_user.id_role IN (1, 5, 14), CONCAT(ta_user.nm_user, " - ", COALESCE(ta_unit.nm_unit, "Unit Kerja")), ta_user.nm_user) as sender_name
FROM `komentar_evaluasi`
LEFT JOIN `ta_user` ON `komentar_evaluasi`.`evaluator_id` = `ta_user`.`id_user`
LEFT JOIN `ta_unit` ON `ta_user`.`id_unit` = `ta_unit`.`id_unit`
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:33:39 --> Query error: Unknown column 'komentar_evaluasi.subkomponen_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1776825219
WHERE `komentar_evaluasi`.`subkomponen_id` = '1'
AND `komentar_evaluasi`.`indikator_id` =0
AND `komentar_evaluasi`.`id_unit` = '1'
AND `komentar_evaluasi`.`tahun` = '2025'
AND `id` = 'v2ob0qbqqcinod45fs7sh6pa3r'
ORDER BY `komentar_evaluasi`.`created_at` ASC
ERROR - 2026-04-22 02:33:39 --> Severity: Warning --> Unknown: Cannot call session save handler in a recursive manner Unknown 0
ERROR - 2026-04-22 02:33:39 --> Severity: Warning --> Unknown: Failed to write session data using user defined save handler. (session.save_path: C:/laragon/tmp) Unknown 0
ERROR - 2026-04-22 02:37:52 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:37:53 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:38:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:38:08 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:38:08 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:43:25 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:43:26 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:43:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:43:47 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:43:47 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:45:32 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:45:32 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:45:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:45:54 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:45:54 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:49:43 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:49:43 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:50:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:50:55 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:51:02 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:51:02 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:51:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:51:21 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:51:29 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:51:29 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:51:53 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:53:11 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:53:11 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:53:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:53:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 02:55:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:55:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 02:56:00 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:56:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:56:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 02:56:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:56:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 02:56:42 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:56:42 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:56:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:56:51 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 02:57:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:57:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:57:23 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:58:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:58:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 02:58:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:58:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:58:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:58:52 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:58:52 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:59:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:59:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 02:59:27 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 02:59:51 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 02:59:51 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:00:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:00:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 03:00:07 --> 404 Page Not Found: Notification/delete51
ERROR - 2026-04-22 03:00:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:00:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:00:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:00:31 --> 404 Page Not Found: Notification/delete67
ERROR - 2026-04-22 03:00:36 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:00:43 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:00:43 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:15:33 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:15:33 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:15:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:16:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:23:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:31:31 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:32:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:33:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:44:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:44:43 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:44:43 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:45:04 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:45:04 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:45:11 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:45:11 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:45:20 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:46:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:46:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:46:19 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 03:46:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:46:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 03:46:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 03:47:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 04:17:41 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 04:17:41 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 04:29:30 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 04:29:30 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 04:30:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 04:30:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 354
ERROR - 2026-04-22 04:30:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 04:37:24 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 04:37:24 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 04:37:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 04:38:10 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 04:38:10 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 04:38:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 06:40:59 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 06:40:59 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 06:41:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 06:41:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 06:41:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 06:41:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 69
ERROR - 2026-04-22 06:41:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 06:41:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 69
ERROR - 2026-04-22 06:41:38 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 06:41:42 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 06:41:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 06:41:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 69
ERROR - 2026-04-22 07:04:32 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:04:32 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:04:42 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:04:42 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:04:55 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:04:55 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:06:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:06:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 69
ERROR - 2026-04-22 07:06:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 72
ERROR - 2026-04-22 07:06:51 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:06:51 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:06:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:06:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 354
ERROR - 2026-04-22 07:06:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\footer.php 79
ERROR - 2026-04-22 07:07:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:07:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:07:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:07:49 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:08:53 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:09:18 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:09:31 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:09:31 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:09:55 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:10:03 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:10:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:10:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:10:28 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:14:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\laragon\www\evsakippmk-inspektorat\application\views\templates\header.php 153
ERROR - 2026-04-22 07:15:13 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:16:40 --> 404 Page Not Found: Dist/img
ERROR - 2026-04-22 07:42:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:42:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2026-04-22 07:47:15 --> 404 Page Not Found: Dist/img
