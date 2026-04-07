<?php
$file = 'c:\laragon\www\evsakippmk-inspektorat\application\models\m_pm.php';

if (file_exists($file)) {
    $content = file_get_contents($file);

    // Apply the exact replacement for the two D and E lines in m_pm.php
    $content = preg_replace(
        '/\(\(avg\(c\.bobot2\*NULLIF\(a\.jawaban1,\s*\'\'\)\)\/c\.bobot2\)\)\s*>=\s*30\s+THEN\s*\'D\'\s+WHEN\s*\(\(avg\(c\.bobot2\*NULLIF\(a\.jawaban1,\s*\'\'\)\)\/c\.bobot2\)\)\s*>=\s*0\s+THEN\s*\'E\'/',
        '((avg(c.bobot2*NULLIF(a.jawaban1, \'\'))/c.bobot2)) > 0 THEN \'D\'
			WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, \'\'))/c.bobot2)) = 0 THEN \'E\'',
        $content
    );

    file_put_contents($file, $content);
    echo "Updated: $file\n";
}
?>
