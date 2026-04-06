<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekapitulasi Unit Kerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/index') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Rekapitulasi Unit Kerja</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Style for Compact View -->
    <style>
        .table-compact {
            font-size: 0.8rem;
        }

        .table-compact td,
        .table-compact th {
            padding: 4px 5px !important;
            vertical-align: middle !important;
        }

        .unit-header {
            text-align: center;
            vertical-align: middle !important;
            min-width: 80px;
        }

        .desc-col {
            min-width: 200px;
            max-width: 350px;
            white-space: normal !important;
            line-height: 1.2;
        }

        /* Sticky Column logic */
        .sticky-col-1 {
            position: sticky;
            left: 0;
            z-index: 10;
            border-right: 1px solid #dee2e6;
        }

        .sticky-col-2 {
            position: sticky;
            left: 30px;
            z-index: 10;
            border-right: 1px solid #dee2e6;
        }

        .sticky-col-3 {
            position: sticky;
            left: 230px;
            z-index: 10;
            border-right: 1px solid #dee2e6;
        }

        /* Forces colors even in Dark Mode */
        .bg-header {
            background-color: #343a40 !important;
            color: white !important;
        }

        /* Component Row (Blue) - Force Black Text */
        .row-comp,
        .row-comp>td {
            background-color: #87CEEB !important;
            color: #000000 !important;
        }

        /* Subcomponent Row (Peach) - Force Black Text */
        .row-sub,
        .row-sub>td {
            background-color: #FFE4C4 !important;
            color: #000000 !important;
        }

        /* Criteria Row (White) - Force Black Text */
        .row-criteria,
        .row-criteria>td {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nilai Gabungan Unit Kerja - Tahun
                                <?php echo $this->session->userdata('tahun'); ?>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <?php
                            // Data Processing Logic
                            $units = [];
                            $structure = [];
                            $unit_totals = [];
                            $unit_predicates = [];

                            if (isset($rekap_units) && is_array($rekap_units)) {
                                foreach ($rekap_units as $unit) {
                                    $units[$unit['id_unit']] = $unit['nm_unit'];

                                    $total = isset($unit['total_nilai']) ? floatval($unit['total_nilai']) : 0;
                                    $unit_totals[$unit['id_unit']] = $total;

                                    $predikat = 'E';
                                    if ($total > 90) {
                                        $predikat = "AA";
                                    } elseif ($total > 80) {
                                        $predikat = "A";
                                    } elseif ($total > 70) {
                                        $predikat = "BB";
                                    } elseif ($total > 60) {
                                        $predikat = "B";
                                    } elseif ($total > 50) {
                                        $predikat = "CC";
                                    } elseif ($total > 30) {
                                        $predikat = "C";
                                    } elseif ($total > 0) {
                                        $predikat = "D";
                                    }
                                    $unit_predicates[$unit['id_unit']] = $predikat;
                                }
                            }

                            if (isset($rekap_detail) && is_array($rekap_detail)) {
                                foreach ($rekap_detail as $row) {
                                    $kid = $row['id_komponen'];
                                    $sid = $row['id_subkomponen'];
                                    $aid = $row['id_aspek'];
                                    $uid = $row['id_unit'];

                                    if (!isset($structure[$kid])) {
                                        $structure[$kid] = [
                                            'uraian' => $row['uraian_komponen'],
                                            'bobot' => $row['bobot_komponen'],
                                            'subs' => [],
                                            'scores' => []
                                        ];
                                    }

                                    if (!isset($structure[$kid]['subs'][$sid])) {
                                        $structure[$kid]['subs'][$sid] = [
                                            'uraian' => $row['uraian_subkomponen'],
                                            'bobot' => $row['bobot_subkomponen'],
                                            'aspeks' => [],
                                            'scores' => []
                                        ];
                                    }
                                    $structure[$kid]['subs'][$sid]['scores'][$uid] = $row['nilai_subkomp'];

                                    if (!isset($structure[$kid]['subs'][$sid]['aspeks'][$aid])) {
                                        $structure[$kid]['subs'][$sid]['aspeks'][$aid] = [
                                            'uraian' => $row['uraian_aspek'],
                                            'answers' => []
                                        ];
                                    }
                                    $structure[$kid]['subs'][$sid]['aspeks'][$aid]['answers'][$uid] = $row['jawaban2'];
                                }
                            }

                            if (isset($rekap_units) && is_array($rekap_units)) {
                                foreach ($rekap_units as $unit) {
                                    if (isset($structure[1]))
                                        $structure[1]['scores'][$unit['id_unit']] = $unit['komp1'];
                                    if (isset($structure[2]))
                                        $structure[2]['scores'][$unit['id_unit']] = $unit['komp2'];
                                    if (isset($structure[3]))
                                        $structure[3]['scores'][$unit['id_unit']] = $unit['komp3'];
                                    if (isset($structure[4]))
                                        $structure[4]['scores'][$unit['id_unit']] = $unit['komp4'];
                                }
                            }
                            ?>

                            <!-- Added .table-responsive for scroll safety on very small screens -->
                            <div class="table-responsive" style="max-height: 80vh;">
                                <table class="table table-bordered table-hover text-nowrap table-sm table-compact">
                                    <thead>
                                        <tr class="bg-header text-center">
                                            <th width="30px" class="sticky-col-1 bg-header">No</th>
                                            <th class="desc-col sticky-col-2 bg-header">Komponen / Indikator</th>
                                            <th width="40px" class="sticky-col-3 bg-header">Bobot</th>
                                            <?php foreach ($units as $nm_unit): ?>
                                                <th class="unit-header"><?php echo $nm_unit; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no_comp = 1;
                                        foreach ($structure as $comp_id => $comp):
                                            ?>
                                            <!-- Component Row (Blue) -->
                                            <tr class="row-comp font-weight-bold">
                                                <td class="text-center sticky-col-1"><?php echo $no_comp++; ?></td>
                                                <td class="desc-col sticky-col-2"><?php echo strtoupper($comp['uraian']); ?>
                                                </td>
                                                <td class="text-center sticky-col-3">
                                                    <?php echo number_format($comp['bobot'], 2); ?>
                                                </td>
                                                <?php foreach ($units as $uid => $nm):
                                                    $score = isset($comp['scores'][$uid]) ? $comp['scores'][$uid] : 0;
                                                    ?>
                                                    <td class="text-center"><?php echo number_format($score, 2); ?></td>
                                                <?php endforeach; ?>
                                            </tr>

                                            <?php
                                            $char_sub = 'a';
                                            foreach ($comp['subs'] as $sub_id => $sub):
                                                ?>
                                                <!-- Subcomponent Row (Peach) -->
                                                <tr class="row-sub font-weight-bold">
                                                    <td class="text-center sticky-col-1">
                                                        <?php echo $no_comp - 1 . '.' . $char_sub++; ?>
                                                    </td>
                                                    <td class="desc-col sticky-col-2"><?php echo $sub['uraian']; ?></td>
                                                    <td class="text-center sticky-col-3">
                                                        <?php echo number_format($sub['bobot'], 2); ?>
                                                    </td>
                                                    <?php foreach ($units as $uid => $nm):
                                                        $score = isset($sub['scores'][$uid]) ? $sub['scores'][$uid] : 0;
                                                        ?>
                                                        <td class="text-center"><?php echo number_format($score, 2); ?></td>
                                                    <?php endforeach; ?>
                                                </tr>

                                                <?php
                                                $no_asp = 1;
                                                foreach ($sub['aspeks'] as $asp_id => $asp):
                                                    ?>
                                                    <!-- Aspect/Criteria Row (White) -->
                                                    <tr class="row-criteria">
                                                        <td class="text-center sticky-col-1"><?php echo $no_asp++; ?></td>
                                                        <td class="desc-col sticky-col-2"><?php echo $asp['uraian']; ?></td>
                                                        <td class="text-center sticky-col-3">-</td>
                                                        <?php foreach ($units as $uid => $nm):
                                                            // Value Logic: DIRECT DISPLAY (User Request: Use Numbers)
                                                            $val = isset($asp['answers'][$uid]) ? $asp['answers'][$uid] : '';
                                                            $display = '<span class="text-muted">-</span>';
                                                            if ($val !== '')
                                                                $display = $val;
                                                            ?>
                                                            <td class="text-center"><?php echo $display; ?></td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                        <!-- Total Accumulation Row -->
                                        <tr class="bg-secondary font-weight-bold text-white">
                                            <td class="text-center sticky-col-1 bg-secondary text-white" colspan="2">
                                                TOTAL AKUMULASI NILAI</td>
                                            <td class="text-center sticky-col-3 bg-secondary text-white">100.00</td>
                                            <?php foreach ($units as $uid => $nm):
                                                $total = isset($unit_totals[$uid]) ? $unit_totals[$uid] : 0;
                                                ?>
                                                <td class="text-center"><?php echo number_format($total, 2); ?></td>
                                            <?php endforeach; ?>
                                        </tr>

                                        <!-- Predicate Row -->
                                        <tr class="bg-dark font-weight-bold text-white">
                                            <td class="text-center sticky-col-1 bg-dark text-white" colspan="3">NILAI /
                                                PREDIKAT</td>
                                            <?php foreach ($units as $uid => $nm):
                                                $pred = isset($unit_predicates[$uid]) ? $unit_predicates[$uid] : 'E';
                                                ?>
                                                <td class="text-center"><?php echo $pred; ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>