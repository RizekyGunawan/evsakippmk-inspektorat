<?php
$files = [
    'c:\laragon\www\evsakippmk-inspektorat\application\models\m_ev.php',
    'c:\laragon\www\evsakippmk-inspektorat\application\controllers\Datasub_ev.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);

    // Target 1: jawabanantara evaluator (`a.jawaban2`) that has bad logic >= 90
    // We regex match the CASE block for `a.jawaban2` and replace its inside with standard.
    // e.g. WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) >= 90 THEN 'AA'
    $content = preg_replace_callback('/\(CASE\s+WHEN\s*\(\(avg\(c\.bobot2\*a\.jawaban2\)\/c\.bobot2\)\)\s*>=\s*90\s+THEN\s*\'AA\'.*?END\)\s+as\s+jawabanantara/s', function($m) {
        return "(CASE 
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) = 100 THEN 'AA'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) >= 90 THEN 'A'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) >= 80 THEN 'BB'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) >= 70 THEN 'B'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) >= 60 THEN 'CC'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) >= 50 THEN 'C'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) > 0 THEN 'D'
			WHEN ((avg(c.bobot2*a.jawaban2)/c.bobot2)) = 0 THEN 'E'
			ELSE ''
			END) as jawabanantara";
    }, $content);

    // Target 2: jawabanantara evaluator without double parenthesis logic (found in Datasub_ev.php)
    // WHEN AVG(a.jawaban2) = 100 THEN 'AA'   <-- Wait, Datasub_ev already has = 100 for a.jawaban2?
    // Let's replace the whole block in Datasub_ev.php
    $content = preg_replace_callback('/\(CASE\s+WHEN\s*AVG\(a\.jawaban2\)\s*=\s*100\s+THEN\s*\'AA\'.*?END\)\s+as\s+jawabanantara/s', function($m) {
        return "(CASE 
                    WHEN AVG(a.jawaban2) = 100 THEN 'AA'
                    WHEN AVG(a.jawaban2) >= 90 THEN 'A'
                    WHEN AVG(a.jawaban2) >= 80 THEN 'BB'
                    WHEN AVG(a.jawaban2) >= 70 THEN 'B'
                    WHEN AVG(a.jawaban2) >= 60 THEN 'CC'
                    WHEN AVG(a.jawaban2) >= 50 THEN 'C'
                    WHEN AVG(a.jawaban2) > 0 THEN 'D'
                    WHEN AVG(a.jawaban2) = 0 THEN 'E'
                    ELSE ''
                END) as jawabanantara";
    }, $content);

    // Target 3: jawabanantara_unit (from Unit Data - `NULLIF(f.jawaban1, '')` or `NULLIF(e.jawaban1, '')`)
    // With double parens: WHEN ((avg(c.bobot2*NULLIF(f.jawaban1, ''))/c.bobot2)) > 90 THEN 'AA'
    $content = preg_replace_callback('/\(CASE\s+WHEN\s*\(\(avg\(c\.bobot2\*NULLIF\([a-z]\.jawaban1,\s*\'\'\)\)\/c\.bobot2\)\)\s*>\s*90\s+THEN\s*\'AA\'.*?END\)\s+as\s+jawabanantara_unit/s', function($m) {
        // Extract the alias prefix (e.g. 'f' or 'e')
        preg_match('/NULLIF\(([a-z])\.jawaban1/', $m[0], $match);
        $alias = $match[1];
        return "(CASE 
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) = 100 THEN 'AA'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) >= 90 THEN 'A'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) >= 80 THEN 'BB'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) >= 70 THEN 'B'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) >= 60 THEN 'CC'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) >= 50 THEN 'C'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) > 0 THEN 'D'
			WHEN ((avg(c.bobot2*NULLIF($alias.jawaban1, ''))/c.bobot2)) = 0 THEN 'E'
			ELSE ''
			END) as jawabanantara_unit";
    }, $content);

    // Target 4: Datasub_ev.php jawabanantara_unit (With single parens: WHEN (AVG(c.bobot2 * NULLIF(e.jawaban1, '')) / c.bobot2) >  90 THEN 'AA')
    $content = preg_replace_callback('/\(CASE\s+WHEN\s*\(AVG\(c\.bobot2\s*\*\s*NULLIF\([a-z]\.jawaban1,\s*\'\'\)\)\s*\/\s*c\.bobot2\)\s*>\s*90\s+THEN\s*\'AA\'.*?END\)\s+as\s+jawabanantara_unit/s', function($m) {
        preg_match('/NULLIF\(([a-z])\.jawaban1/', $m[0], $match);
        $alias = $match[1];
        return "(CASE
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) = 100 THEN 'AA'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) >= 90 THEN 'A'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) >= 80 THEN 'BB'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) >= 70 THEN 'B'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) >= 60 THEN 'CC'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) >= 50 THEN 'C'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) > 0 THEN 'D'
                    WHEN (AVG(c.bobot2 * NULLIF($alias.jawaban1, '')) / c.bobot2) = 0 THEN 'E'
                    ELSE ''
                END) as jawabanantara_unit";
    }, $content);

    file_put_contents($file, $content);
    echo "Updated: $file\n";
}
?>
