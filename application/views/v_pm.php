<!DOCTYPE html>
<html lang="en">

<body>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-">
          <div class="col-sm-5 col-7">
            <h1>Pengisian Penilaian</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengisian Penilaian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">



                <div <?php if ($this->session->userdata('id_unit') == "") {
                  echo "hidden";
                } else {
                  echo "";
                }
                ; ?>
                  class="col-">




                  <?php foreach ($loadtu as $load): ?>
                    <?php if ($load['id_pm'] != ""): ?>
                      <a class="btn btn-success" href="<?php echo base_url('pm/excel') ?>">Hasil Penilain.xlsx</a>
                    <?php endif; ?>
                  <?php endforeach; ?>





                </div>
              </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive">

                <div class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    <div class="row col-md-12">

                      <tbody>




                        <tr>

                          <td>







                            <div class="card-body p-0">

                              <table class="table table-hover">
                                <thead class="thead-dark">
                                  <tr>
                                    <th class="text-center align-middle" style="width: 50px">Kode</th>
                                    <th class="text-center align-middle" style="width: 950px">Komponen</th>
                                    <th class="text-center align-middle" style="width: 50px">Bobot</th>
                                    <th class="text-center align-middle" style="width: 100px" colspan="2">Nilai
                                      Akuntabilitas Kinerja</th>


                                </thead>
                                <tbody>


                                  <?php foreach ($komp as $kom): ?>

                                    <tr data-widget="expandable-table" elementId="k<?php echo $kom['id_komponen']; ?>"
                                      aria-expanded="false">
                                      <td class="text-center align-middle"><?php echo $kom['kd_komponen']; ?></td>
                                      <td>
                                        <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                        <?php echo $kom['uraian_komponen']; ?>
                                      </td>
                                      <td class="text-center align-middle" style="width: 50px">
                                        <?php echo $kom['bobot']; ?>
                                      </td>
                                      <td class="text-center align-middle" style="width: 50px">
                                        <?php $format = number_format((float) $kom['nilaik'], 2, ",", ".");
                                        echo $format; ?>
                                      </td>
                                      <td class="text-center align-middle" style="width: 50px">
                                        <?php $format = number_format((float) $kom['nilaikpersen'], 2, ",", ".");
                                        echo $format; ?>%
                                      </td>

                                    </tr>



                                    <tr class="expandable-body">
                                      <td colspan="5">
                                        <div class="p-0" style="display: none;">
                                          <table class="table table-hover table-bordered">
                                            <thead class="table-dark">
                                              <tr>
                                                <th class="text-center align-middle" style="width: 50px">Kode</th>
                                                <th class="text-center align-middle" style="width: 450px">Subkomponen</th>
                                                <th class="text-center align-middle" style="width: 50px">Bobot</th>
                                                <th class="text-center align-middle" style="width: 50px" colspan="2">
                                                  Keberadaan, Kualitas dan Pemanfaatan</th>
                                                <th class="text-center align-middle" style="width: 50px" hidden>Jawaban Antara
                                                </th>
                                                <th class="text-center align-middle" style="width: 50px">Nilai Unit</th>
                                                <th class="text-center align-middle" style="width: 50px" colspan="2">Nilai
                                                  Akuntabilitas Kinerja</th>
                                                <th class="text-center align-middle" style="width: 50px">Penjelasan
                                                  Jawaban</th>
                                                <th class="text-center align-middle" style="width: 200px" colspan="2">
                                                  Bukti (Link/File)</th>
                                                <th class="text-center align-middle" style="width: 20px">Aksi</th>


                                              </tr>
                                            </thead>

                                            <tbody>

                                              <?php foreach ($sub as $subk): ?>
                                                <?php if ($subk['id_komponen'] === $kom['id_komponen']): ?>
                                                  <tr data-widget="expandable-table"
                                                    elementId="s<?php echo $subk['id_subkomponen']; ?>" aria-expanded="false">
                                                    <td class="text-center"><?php echo $subk['kd_subkomponen']; ?></td>
                                                    <td class="text-justify">
                                                      <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                      <?php echo $subk['uraian_subkomponen']; ?>
                                                    </td>
                                                    <td class="text-center align-middle"><?php echo $subk['bobot2']; ?></td>
                                                    <td class="text-center align-middle">
                                                      <?php $format = number_format($subk['skorpersen'], 2, ",", ".");
                                                      echo $format; ?>%
                                                    </td>
                                                    <td class="text-center align-middle">
                                                      <?php $format = number_format($subk['skor'], 2, ",", ".");
                                                      echo $format; ?>
                                                    </td>
                                                    <?php
                                                    /**
                                                     * [KOLOM: Jawaban Antara]
                                                     * Sumber  : $subk['jawabanantara'] → dihitung di m_pm.php get_datasub()
                                                     * Formula : AVG(ta_pm.jawaban1 * bobot) / bobot
                                                     * Isi     : Rata-rata tertimbang jawaban UNIT per indikator (otomatis).
                                                     */
                                                    ?>
                                                    <td class="text-center align-middle" hidden><?php echo $subk['jawabanantara']; ?>
                                                    </td>
                                                    <?php
                                                    /**
                                                     * [KOLOM: Nilai Akhir]
                                                     * Sumber  : $subk['jawabanantara'] (saat ini — setelah perbaikan 2026-04-01)
                                                     *
                                                     * [CATATAN UNTUK PROGRAMMER — Fix #1 Pending]
                                                     * Masalah : Kolom ini sebelumnya menggunakan $subk['jawaban0']
                                                     *           (ta_pm0.jawaban0) yang merupakan nilai manual unit.
                                                     *           Diubah sementara ke jawabanantara agar konsisten.
                                                     *
                                                     * Keputusan desain diperlukan:
                                                     *   A) Kembalikan ke $subk['jawaban0'] jika "Nilai Akhir" dimaksudkan
                                                     *      sebagai nilai konfirmasi manual yang bisa berbeda dari rata-rata.
                                                     *   B) Hapus kolom ini jika dianggap duplikat dari "Jawaban Antara".
                                                     *   C) Pertahankan jawabanantara dan hapus kolom "Jawaban Antara".
                                                     *
                                                     * Lihat juga: Fix #2 — sinkronisasi ta_pm0.jawaban0 dengan jawabanantara.
                                                     */
                                                    ?>
                                                    <td class="text-center align-middle">
                                                      <?php echo $subk['jawabanantara']; ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                      <?php $format = number_format((float) $subk['nilai'], 2, ",", ".");
                                                      echo $format; ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                      <?php $format = number_format($subk['nilaipersen'], 2, ",", ".");
                                                      echo $format; ?>%
                                                    </td>
                                                    <td
                                                      title="<?php echo htmlspecialchars($subk['uraian_jawaban0'], ENT_QUOTES, 'UTF-8'); ?>"
                                                      class="text-center align-middle" style="width: 50px">
                                                      <i class="expandable-table-caret"></i>
                                                      <?php
                                                      $fullText = htmlspecialchars($subk['uraian_jawaban0'], ENT_QUOTES, 'UTF-8');
                                                      $shortText = (strlen($fullText) > 3) ? substr($fullText, 0, 3) . '...' : $fullText;
                                                      echo $shortText;
                                                      if (strlen($fullText) > 3) {
                                                        echo ' <a href="#" class="read-more" data-fulltext="' . $fullText . '" data-toggle="modal" data-target="#readMoreModal">more</a>';
                                                      }
                                                      ?>
                                                    </td>

                                                    <td title="<?php echo $subk['dok_pendukung']; ?>"
                                                      class="text-truncate align-middle" style="max-width: 150px;"
                                                      style="width: 150px">
                                                      <i class="expandable-table-caret "></i>
                                                      <div class="text-truncate">
                                                        <?php
                                                        $url = $subk['link_bukti0'];

                                                        // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                                        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                          $url = "http://" . $url;
                                                        }
                                                        ?>
                                                        <a href="<?php echo $url; ?>"
                                                          target="_blank"><?php echo htmlspecialchars($subk['link_bukti0'], ENT_QUOTES, 'UTF-8'); ?></a>
                                                      </div>
                                                      <div class="text-truncate">
                                                        <?php
                                                        $url = $subk['link_bukti03'];

                                                        // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                                        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                          $url = "http://" . $url;
                                                        }
                                                        ?>
                                                        <a href="<?php echo $url; ?>"
                                                          target="_blank"><?php echo htmlspecialchars($subk['link_bukti03'], ENT_QUOTES, 'UTF-8'); ?></a>
                                                      </div>
                                                    </td>
                                                    <td class="text-center align-middle" style="width: 30px">
                                                      <?php if (
                                                        ($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                                                          $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $subk['status_data'] == "0"
                                                      ): ?>
                                                        <div class="btn btn-primary btn-xs open-modal02" data-toggle="modal"
                                                          data-id_pm0="<?php echo $subk['id_pm0']; ?>">
                                                          <i class="fas fa-upload"></i>
                                                        </div>
                                                      <?php endif; ?>
                                                      <?php if ($subk['link_bukti02'] != ""): ?>
                                                        <button class="btn btn-secondary btn-xs view-files-btn-pm0"
                                                          data-files="<?php echo $subk['link_bukti02']; ?>"
                                                          data-id_pm0="<?php echo $subk['id_pm0']; ?>"><i
                                                            class="fas fa-search"></i></button>
                                                      <?php endif; ?>
                                                    </td>

                                                    <td class="text-center align-middle" style="width: 30px">
                                                      <?php if (
                                                        ($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                                                          $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $subk['status_data'] == "0"
                                                      ): ?>
                                                        <div <?php if ($subk['pm_modified_by'] != ""): ?>
                                                            title="last modified by: <?php echo $subk['pm_modified_by']; ?>" <?php endif; ?> class="btn btn-info btn-xs open-modal0"
                                                          data-id_pm0="<?php echo $subk['id_pm0']; ?>">
                                                          <i class="fas fa-edit"></i>
                                                        </div>
                                                      <?php endif; ?>
                                                      <?php if ($subk['status_data'] == "1" || (($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7)))) && $subk['status_data'] == "0")): ?>
                                                        <div <?php if ($subk['pm_modified_by'] != ""): ?>
                                                            title="last modified by: <?php echo $subk['pm_modified_by']; ?>" <?php endif; ?> class="btn btn-info btn-xs open-modal0"
                                                          data-id_pm0="<?php echo $subk['id_pm0']; ?>">
                                                          <i class="fas fa-search"></i>
                                                        </div>
                                                      <?php endif; ?>
                                                    </td>


                                                  </tr>



                                                  <tr class="expandable-body">
                                                    <td colspan="13">
                                                      <div class="p-0" style="display: none;">
                                                        <table class="table table-hover table-bordered">
                                                          <thead class="table-dark">




                                                            <tr>
                                                              <th class="text-center align-middle" style="width: 20px">Kode
                                                              </th>
                                                              <th class="text-center align-middle" style="width: 300px">
                                                                Kriteria yang dinilai</th>
                                                              <th class="text-center align-middle" style="width: 50px">
                                                                Jawaban Unit</th>
                                                              <th class="text-center align-middle" style="width: 300px">
                                                                Penjelasan Jawaban</th>
                                                              <th class="text-center align-middle" style="width: 50px"
                                                                colspan="2">Bukti (Link/File)</th>
                                                              <th class="text-center align-middle" style="width: 20px">Aksi
                                                              </th>


                                                          </thead>
                                                          <tbody>

                                                            <?php foreach ($kri as $krit): ?>
                                                              <?php if ($krit['id_subkomponen'] === $subk['id_subkomponen']): ?>
                                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                                  <td class="text-center"><?php echo $krit['kd_aspek']; ?></td>
                                                                  <td class="text-justify" style="width: 400px">
                                                                    <i class="expandable-table-caret"></i>
                                                                    <?php echo $krit['uraian_aspek']; ?>
                                                                  </td>
                                                                  <td title="<?php echo $krit['catatan']; ?>" <?php
                                                                     if ($krit['opsi5'] == "0") {
                                                                       echo "";
                                                                     } elseif ($krit['opsi3'] == "0.5") {
                                                                       echo "";
                                                                     } elseif ($krit['opsi1'] == "1") {
                                                                       echo "";
                                                                     } elseif ($krit['opsi4'] == "0.33") {
                                                                       echo "";
                                                                     } elseif ($krit['opsi2'] == "0.66") {
                                                                       echo "";
                                                                     } else {
                                                                       echo "hidden";
                                                                     }
                                                                     ; ?> class="text-center align-middle"> <?php
                                                                       if ($krit['jawaban1'] == "100") {
                                                                         echo "AA";
                                                                       } elseif ($krit['jawaban1'] == "90") {
                                                                         echo "A";
                                                                       } elseif ($krit['jawaban1'] == "80") {
                                                                         echo "BB";
                                                                       } elseif ($krit['jawaban1'] == "70") {
                                                                         echo "B";
                                                                       } elseif ($krit['jawaban1'] == "60") {
                                                                         echo "CC";
                                                                       } elseif ($krit['jawaban1'] == "50") {
                                                                         echo "C";
                                                                       } elseif ($krit['jawaban1'] == "30") {
                                                                         echo "D";
                                                                       } elseif ($krit['jawaban1'] === "0" || $krit['jawaban1'] === 0) {
                                                                         echo "E";
                                                                       } else {
                                                                         echo "kosong";
                                                                       } ?> </td>
                                                                  <td class="text-justify" style="width: 600px">
                                                                    <i class="expandable-table-caret"></i>
                                                                    <?php
                                                                    $fullText = htmlspecialchars($krit['uraian_jawaban1'], ENT_QUOTES, 'UTF-8');
                                                                    $shortText = (strlen($fullText) > 350) ? substr($fullText, 0, 340) . '...' : $fullText;
                                                                    echo $shortText;
                                                                    if (strlen($fullText) > 340) {
                                                                      echo ' <a href="#" class="read-more" data-fulltext="' . $fullText . '" data-toggle="modal" data-target="#readMoreModal">read more</a>';
                                                                    }
                                                                    ?>
                                                                  </td>
                                                                  <td title="<?php echo $krit['dok_pendukung2']; ?>"
                                                                    class="text-truncate align-middle"
                                                                    style="max-width: 150px; width: 150px;">
                                                                    <i class="expandable-table-caret"></i>
                                                                    <div class="text-truncate">
                                                                      <?php
                                                                      $url = $krit['link_bukti'];

                                                                      // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                                                      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                                        $url = "http://" . $url;
                                                                      }
                                                                      ?>
                                                                      <a href="<?php echo $url; ?>"
                                                                        target="_blank"><?php echo htmlspecialchars($krit['link_bukti'], ENT_QUOTES, 'UTF-8'); ?></a>
                                                                    </div>
                                                                    <div class="text-truncate">
                                                                      <?php
                                                                      $url = $krit['link_bukti3'];

                                                                      // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                                                      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                                        $url = "http://" . $url;
                                                                      }
                                                                      ?>
                                                                      <a href="<?php echo $url; ?>"
                                                                        target="_blank"><?php echo htmlspecialchars($krit['link_bukti3'], ENT_QUOTES, 'UTF-8'); ?></a>
                                                                    </div>
                                                                  </td>

                                                                  <td class="text-center align-middle" style="width: 30px">
                                                                    <?php if (
                                                                      ($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                                                                        $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $krit['status_data'] == "0"
                                                                    ): ?>
                                                                      <div class="btn btn-primary btn-xs open-modal2"
                                                                        data-toggle="modal"
                                                                        data-id_pm="<?php echo $krit['id_pm']; ?>">
                                                                        <i class="fas fa-upload"></i>
                                                                      </div>
                                                                    <?php endif; ?>
                                                                    <?php if ($krit['link_bukti2'] != ""): ?>
                                                                      <button class="btn btn-secondary btn-xs view-files-btn-pm"
                                                                        data-files="<?php echo $krit['link_bukti2']; ?>"
                                                                        data-id_pm="<?php echo $krit['id_pm']; ?>"><i
                                                                          class="fas fa-search"></i></button>
                                                                    <?php endif; ?>
                                                                  </td>




                                                                  <td class="text-center align-middle" style="width: 30px">
                                                                    <?php if (
                                                                      ($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                                                                        $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $krit['status_data'] == "0"
                                                                    ): ?>
                                                                      <div <?php if ($krit['pm_modified_by'] != ""): ?>
                                                                          title="last modified by: <?php echo $krit['pm_modified_by']; ?>"
                                                                        <?php endif; ?> class="btn btn-success btn-xs open-modal"
                                                                        data-id_pm="<?php echo $krit['id_pm']; ?>">
                                                                        <i class="fas fa-edit"></i>
                                                                      </div>
                                                                    <?php endif; ?>
                                                                    <?php if (($krit['status_data'] == "0" && ($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7))))) || $krit['status_data'] == "1"): ?>
                                                                      <div <?php if ($krit['pm_modified_by'] != ""): ?>
                                                                          title="last modified by: <?php echo $krit['pm_modified_by']; ?>"
                                                                        <?php endif; ?> class="btn btn-primary btn-xs open-modal"
                                                                        data-id_pm="<?php echo $krit['id_pm']; ?>">
                                                                        <i class="fas fa-search"></i>
                                                                      </div>
                                                                    <?php endif; ?>
                                                                  </td>

                                                                </tr>
                                                              <?php endif; ?>
                                                            <?php endforeach; ?>



                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    </td>
                                                  </tr>

                                                <?php endif; ?>
                                              <?php endforeach; ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </td>
                                    </tr>



                                  <?php endforeach; ?>

                                  <thead class="table-dark">
                                    <?php foreach ($sumkom as $sumk): ?>

                                      <tr class="table" data-widget="expandable-table" aria-expanded="false">
                                        <td colspan="2">
                                          <i class="expandable-table-caret "></i>
                                          NILAI AKUNTABILITAS KINERJA
                                        </td>
                                        <td class="text-center align-middle"><?php echo $sumk['sumbobot']; ?></td>
                                        <td class="text-center align-middle">
                                          <?php $format = number_format((float) $sumk['sumnilaik'], 2, ",", ".");
                                          echo $format; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                          <?php $format = number_format((float) $sumk['sumnilaikpersen'], 2, ",", ".");
                                          echo $format; ?>%
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </thead>
                                  <?php foreach ($sumkom as $sumk): ?>
                                    <tr class="table" data-widget="expandable-table" aria-expanded="false">
                                      <td colspan="3">
                                        <i class="expandable-table-caret "></i>
                                        PREDIKAT
                                      </td>

                                      <td <?php if ($this->session->userdata('id_unit') == "") {
                                        echo "hidden";
                                      } else {
                                        echo "";
                                      }
                                      ; ?> class="text-center align-middle">
                                        <?php $format = floatval(str_replace(',', '.', $sumk['sumnilaik']));
                                        if ($format == 0) {
                                          echo "E";
                                        } elseif ($format > 0.01 && $format <= 30.00) {
                                          echo "D";
                                        } elseif ($format > 30.01 && $format <= 50.00) {
                                          echo "C";
                                        } elseif ($format >= 50.01 && $format <= 60.00) {
                                          echo "CC";
                                        } elseif ($format >= 60.01 && $format <= 70.00) {
                                          echo "B";
                                        } elseif ($format >= 70.01 && $format <= 80.00) {
                                          echo "BB";
                                        } elseif ($format >= 80.01 && $format <= 90.00) {
                                          echo "A";
                                        } elseif ($format >= 90.01 && $format <= 100) {
                                          echo "AA";
                                        } else {
                                          echo "";
                                        }
                                        ; ?>
                                      </td>
                                      <td <?php if ($this->session->userdata('id_unit') != "") {
                                        echo "hidden";
                                      } else {
                                        echo "";
                                      }
                                      ; ?> class="text-center align-middle"></td>
                                      <td class="text-center align-middle"></td>

                                    </tr>
                                  <?php endforeach; ?>

                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </td>




                        </tr>

                      </tbody>
                      </table>


                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->




              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">

                </ul>
              </div>


            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal HTML using Bootstrap -->
  <div class="modal fade" id="readMoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Full Text</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-justify" id="modalText">
          <!-- Full text will be injected here by JavaScript -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', (event) => {
      // Add click event to read-more links
      var readMoreLinks = document.querySelectorAll('.read-more');
      readMoreLinks.forEach(link => {
        link.addEventListener('click', function (event) {
          event.preventDefault();
          var fullText = this.getAttribute('data-fulltext');
          document.getElementById('modalText').innerText = fullText;
        });
      });
    });
  </script>






  <!-- Modal Edit -->
  <div class="modal fade" id="EditData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Penilaian Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formkrit">

            <input type="hidden" id="id_pm" name="id_pm">

            <div class="row">
              <div class="form-group col-md-6">
                <label>Kriteria yang Dinilai</label>
                <textarea readonly type="text" rows="8" name="uraian_aspek" id="uraian_aspek"
                  class="form-control text-justify"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Contoh Dokumen yang Bisa Disediakan</label>
                <textarea readonly type="text" rows="8" name="dok_pendukung2" id="dok_pendukung2"
                  class="form-control text-justify"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-2">
                <label>Jawaban Unit</label>
                <select name="jawaban1" id="jawaban1" class="form-control" <?php if (($krit['status_data'] == "0" && ($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7))))) || $krit['status_data'] == "1"): ?> <?php endif; ?>>
                  <option hidden value="">Pilih Jawaban 1</option>
                  <option value="100">AA</option>
                  <option value="90">A</option>
                  <option value="80">BB</option>
                  <option value="70">B</option>
                  <option value="60">CC</option>
                  <option value="50">C</option>
                  <option value="30">D</option>
                  <option value="0">E</option>
                </select>
              </div>
              <div class="form-group col-md-5">
                <label>Bukti Dokumen (Link)</label>
                <input type="text" name="link_bukti" id="link_bukti" class="form-control"
                  placeholder="Jawaban Ya Wajib isi Link/Upload Bukti" <?php if (($krit['status_data'] == "0" && ($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7))))) || $krit['status_data'] == "1"): ?> readonly <?php endif; ?>>
              </div>
              <div class="form-group col-md-5">
                <label>Bukti Dokumen Tambahan (Link)</label>
                <input type="text" name="link_bukti3" id="link_bukti3" class="form-control" <?php if (($krit['status_data'] == "0" && ($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7))))) || $krit['status_data'] == "1"): ?> readonly <?php endif; ?>>
              </div>
            </div>

            <table style="width: 100%;" class="table ">
              <thead class="no">
                <tr>
                  <th class="align-middle" id="keterangan_pengisian_header">Informasi Tambahan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="align-middle" id="ket_pengisian1"></td>
                </tr>
                <tr>
                  <td class="align-middle" id="ket_pengisian2"></td>
                </tr>
                <tr>
                  <td class="align-middle" id="ket_pengisian3"></td>
                </tr>
              </tbody>
            </table>

            <div class="row">
              <div class="form-group col-md-12">
                <label>Penjelasan Jawaban</label>
                <textarea type="text" rows="7" name="uraian_jawaban1" id="uraian_jawaban1"
                  class="form-control text-justify" <?php if (($krit['status_data'] == "0" && ($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7))))) || $krit['status_data'] == "1"): ?> readonly <?php endif; ?>></textarea>
              </div>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?php if (
              ($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $krit['status_data'] == "0"
            ): ?>
              <button id="submitkrit" class="btn btn-primary">Save</button>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>



  <script>
    $(document).ready(function () {
      $("#submitkrit").click(function (event) {
        event.preventDefault();
        // Jika validasi kedua tidak memunculkan pesan kesalahan
        if ($('#formkrit').valid()) {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('pm/update_data'); ?>",
            data: $("#formkrit").serialize(),
            success: function (response) {
              toastr.success('Data berhasil disimpan!', 'Sukses');
              location.reload();
            },
            error: function () {
              alert("Terjadi kesalahan saat menyimpan data.");
            }
          });
        }
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#EditData').on('show.bs.modal', function (event) {
        var modal = $(this);

        // Periksa ket_pengisian1
        if ($.trim(modal.find('#ket_pengisian1').text()) === '') {
          modal.find('#ket_pengisian1').closest('tr').hide();
        } else {
          modal.find('#ket_pengisian1').closest('tr').show();
        }

        // Periksa ket_pengisian2
        if ($.trim(modal.find('#ket_pengisian2').text()) === '') {
          modal.find('#ket_pengisian2').closest('tr').hide();
        } else {
          modal.find('#ket_pengisian2').closest('tr').show();
        }

        // Periksa ket_pengisian3
        if ($.trim(modal.find('#ket_pengisian3').text()) === '') {
          modal.find('#ket_pengisian3').closest('tr').hide();
        } else {
          modal.find('#ket_pengisian3').closest('tr').show();
        }

        // Sembunyikan/munculkan header sesuai kondisi
        if ($.trim(modal.find('#ket_pengisian3').text()) === '' && $.trim(modal.find('#ket_pengisian2').text()) === '' && $.trim(modal.find('#ket_pengisian1').text()) === '') {
          $('#keterangan_pengisian_header').hide();
        } else {
          $('#keterangan_pengisian_header').show();
        }

      });
    });
  </script>


  <!-- Modal Edit Sub -->
  <div class="modal fade" id="EditDataSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Penilaian Akhir Setelah Penambahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">


          <form id="formsub">

            <input type="hidden" name="id_pm0" id="id_pm0">

            <div class="row">
              <div class="form-group col-md-6">
                <label>Subkomponen yang Dinilai</label>
                <textarea readonly type="text" rows="8" name="uraian_subkomponen" id="uraian_subkomponen"
                  class="form-control text-justify"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Dokumen yang Harus Disediakan</label>
                <textarea readonly type="text" rows="8" name="dok_pendukung" id="dok_pendukung"
                  class="form-control text-justify"></textarea>
              </div>

            </div>
            <div class="row">


              <div class="form-group col-md-2" style="display:none">
                <label>Jawaban Antara</label>
                <input readonly type="text" name="jawabanantara" id="jawabanantara" class="form-control">
              </div>

              <!-- Jawaban Akhir Otomatis: disembunyikan (display:none), tetap dikirim ke backend via name="jawaban0" -->
              <div class="form-group col-md-2" style="display:none">
                <label>Jawaban Akhir Otomatis</label>
                <select id="jawaban0otomatis" name="jawaban0" class="form-control" <?php if ($subk['status_data'] == "1" || (($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7)))) && $subk['status_data'] == "0")): ?> readonly <?php endif; ?>>
                  <option value="" hidden="true">Pilih Jawaban</option>
                  <option value="100">AA</option>
                  <option value="90">A</option>
                  <option value="80">BB</option>
                  <option value="70">B</option>
                  <option value="60">CC</option>
                  <option value="50">C</option>
                  <option value="30">D</option>
                  <option value="0">E</option>
                </select>
              </div>


              <!-- Jawaban Unit: tampil sebagai input readonly, terisi otomatis = Jawaban Antara -->
              <div class="form-group col-md-2">
                <label>Jawaban Unit</label>
                <input readonly type="text" id="jawaban0display" class="form-control">
              </div>


              <div class="form-group col-md-4">
                <label>Bukti Dokumen (Link)</label>
                <input title="Wajib isi Link Bukti / Upload Bukti jika Jawaban Akhir A / AA" type="text"
                  id="link_bukti0" name="link_bukti0" class="form-control"
                  placeholder="A/AA Wajib isi Link/Upload Bukti" <?php if ($subk['status_data'] == "1" || (($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7)))) && $subk['status_data'] == "0")): ?> readonly <?php endif; ?>>
              </div>
              <div class="form-group col-md-4">
                <label>Bukti Dokumen Tambahan (Link)</label>
                <input title="Bukti Tambahan" type="text" id="link_bukti03" name="link_bukti03" class="form-control"
                  placeholder="Bukti Tambahan" <?php if ($subk['status_data'] == "1" || (($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7)))) && $subk['status_data'] == "0")): ?> readonly <?php endif; ?>>
              </div>



            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label>Penjelasan Jawaban</label>
                <textarea id="uraian_jawaban0" title="Wajib diisi jika Jawaban Akhir A atau AA" type="text" rows="7"
                  name="uraian_jawaban0" class="form-control text-justify"
                  placeholder="Wajib diisi jika Jawaban Akhir A atau AA" <?php if ($subk['status_data'] == "1" || (($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $this->session->userdata('id_unit') != $this->session->userdata('id_unit2') && !in_array($this->session->userdata('id_unit'), array(1, 2, 3, 4, 5, 6, 7)))) && $subk['status_data'] == "0")): ?> readonly <?php endif; ?>></textarea>
              </div>



            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?php if (
              ($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $subk['status_data'] == "0"
            ): ?>
              <button id="submitsub" class="btn btn-primary">Save</button>
            <?php endif; ?>


          </form>
        </div>


      </div>
    </div>
  </div>



  <script>
    $(document).ready(function () {
      $("#submitsub").click(function (event) {
        event.preventDefault();
        // Jika validasi kedua tidak memunculkan pesan kesalahan
        if ($('#formsub').valid()) {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('pm/update_data2'); ?>",
            data: $("#formsub").serialize(),
            success: function (response) {
              toastr.success('Data berhasil disimpan!', 'Sukses');
              location.reload();
            },
            error: function () {
              alert("Terjadi kesalahan saat menyimpan data.");
            }
          });
        }
      });
    });
  </script>



  <!-- Modal Upload Bukti -->
  <div class="modal fade" id="UploadData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <?php echo form_open_multipart('pm/upload_bukti'); ?>


          <input type="hidden" name="id_pm" id="id_pm2">
          <div class="row">
            <div class="form-group col-md-12">
              <label>File Bukti</label>
              <input type="file" name="link_bukti2[]" id="link_bukti2" class="form-control" multiple>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>*Keterangan</label>
              <br>Max file size: 15MB masing-masing file
              <br>Format file: pdf, jpg, jpeg, png, xlsx, docx
              <br>
              <br>
            </div>
          </div>


          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>

          <?php echo form_close(); ?>
        </div>


      </div>
    </div>
  </div>



  <!-- Modal Upload Bukti Sub -->
  <div class="modal fade" id="UploadDataSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Subkomponen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <?php echo form_open_multipart('pm/upload_bukti0'); ?>


          <input type="hidden" name="id_pm0" id="id_pm02">
          <div class="row">
            <div class="form-group col-md-12">
              <label>File Bukti</label>
              <input type="file" name="link_bukti02[]" id="link_bukti02" class="form-control" multiple>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>*Keterangan</label>
              <br>Max file size: 15MB masing-masing file
              <br>Format file: pdf, jpg, jpeg, png, xlsx, docx
              <br>
              <br>
            </div>
          </div>


          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>

          <?php echo form_close(); ?>
        </div>


      </div>
    </div>
  </div>



  <!-- Modal View Uploaded Files -->
  <div class="modal fade" id="ViewFilesModalPM" tabindex="-1" role="dialog" aria-labelledby="ViewFilesModalPMLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ViewFilesModalPMLabel">File yang Telah Diupload pada Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama File</th>
                <th style="width: 30px">Preview</th>
                <th style="width: 30px">Hapus</th>
              </tr>
            </thead>
            <tbody id="fileListBodyPM">
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="ViewFilesModalPM0" tabindex="-1" role="dialog" aria-labelledby="ViewFilesModalPM0Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ViewFilesModalPM0Label">File yang Telah Diupload pada Subkomponen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama File</th>
                <th style="width: 30px">Preview</th>
                <th style="width: 30px">Hapus</th>
              </tr>
            </thead>
            <tbody id="fileListBodyPM0">
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const viewFilesBtnsPM = document.querySelectorAll('.view-files-btn-pm');

      viewFilesBtnsPM.forEach(btn => {
        btn.addEventListener('click', function () {
          const files = this.getAttribute('data-files').split(';');
          const id_pm = this.getAttribute('data-id_pm');

          showUploadedFilesPM(files, id_pm);
          $('#ViewFilesModalPM').modal('show');
        });
      });
    });

    function showUploadedFilesPM(files, id_pm) {
      const fileListBody = document.getElementById('fileListBodyPM');
      fileListBody.innerHTML = ''; // Clear existing rows

      files.forEach(file => {
        const row = document.createElement('tr');

        const fileNameCell = document.createElement('td');
        fileNameCell.textContent = file;

        const previewCell = document.createElement('td');
        const previewLink = document.createElement('a');
        previewLink.href = `../assets/bukti_pm/${file}`;
        previewLink.target = '_blank';
        previewLink.textContent = 'Preview';
        previewLink.classList.add('btn', 'btn-secondary', 'btn-xs');
        previewCell.appendChild(previewLink);

        const deleteCell = document.createElement('td');
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Hapus';
        deleteBtn.classList.add('btn', 'btn-danger', 'btn-xs');
        deleteBtn.dataset.file = file;
        deleteBtn.addEventListener('click', function () {
          const file = this.dataset.file;
          deleteFilePM(file, id_pm);
        });
        deleteCell.appendChild(deleteBtn);

        row.appendChild(fileNameCell);
        row.appendChild(previewCell);
        row.appendChild(deleteCell);
        fileListBody.appendChild(row);
      });
    }

    function deleteFilePM(file, id_pm) {
      const url = '<?php echo base_url("pm/delete_file"); ?>';
      const data = { file: file, id_pm: id_pm };

      fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json'
        }
      })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            alert('File berhasil dihapus');
            showUploadedFilesPM(result.files.split(';'), id_pm);
          } else {
            alert('Gagal menghapus file: ' + result.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>



  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const viewFilesBtnsPM0 = document.querySelectorAll('.view-files-btn-pm0');

      viewFilesBtnsPM0.forEach(btn => {
        btn.addEventListener('click', function () {
          const files = this.getAttribute('data-files').split(';');
          const id_pm0 = this.getAttribute('data-id_pm0');

          showUploadedFilesPM0(files, id_pm0);
          $('#ViewFilesModalPM0').modal('show');
        });
      });
    });

    function showUploadedFilesPM0(files, id_pm0) {
      const fileListBody = document.getElementById('fileListBodyPM0');
      fileListBody.innerHTML = ''; // Clear existing rows

      files.forEach(file => {
        const row = document.createElement('tr');

        const fileNameCell = document.createElement('td');
        fileNameCell.textContent = file;

        const previewCell = document.createElement('td');
        const previewLink = document.createElement('a');
        previewLink.href = `../assets/bukti_pm/${file}`;
        previewLink.target = '_blank';
        previewLink.textContent = 'Preview';
        previewLink.classList.add('btn', 'btn-secondary', 'btn-xs');
        previewCell.appendChild(previewLink);

        const deleteCell = document.createElement('td');
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Hapus';
        deleteBtn.classList.add('btn', 'btn-danger', 'btn-xs');
        deleteBtn.dataset.file = file;
        deleteBtn.dataset.id_pm0 = id_pm0;
        deleteBtn.addEventListener('click', function () {
          const file = this.dataset.file;
          const id_pm0 = this.dataset.id_pm0;
          deleteFilePM0(file, id_pm0);
        });
        deleteCell.appendChild(deleteBtn);

        row.appendChild(fileNameCell);
        row.appendChild(previewCell);
        row.appendChild(deleteCell);
        fileListBody.appendChild(row);
      });
    }

    function deleteFilePM0(file, id_pm0) {
      const url = '<?php echo base_url("pm/delete_file0"); ?>';
      const data = { file: file, id_pm0: id_pm0 };

      fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json'
        }
      })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            alert('File berhasil dihapus');
            showUploadedFilesPM0(result.files.split(';'), id_pm0);
          } else {
            alert('Gagal menghapus file: ' + result.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>




  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    // Simpan status tree view saat diubah
    function saveTreeViewState(elementId, expanded) {
      localStorage.setItem("treeview_" + elementId, expanded);
    }

    // Baca status tree view saat halaman dimuat
    function loadTreeViewState(elementId) {
      var expanded = localStorage.getItem("treeview_" + elementId);
      if (expanded === "true") {
        return true;
      }
      return false;
    }

    // Tandai tree view yang harus diubah saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
      var expandableElements = document.querySelectorAll("[data-widget='expandable-table']");
      expandableElements.forEach(function (element) {
        var elementId = element.getAttribute("elementId");
        var expanded = loadTreeViewState(elementId);

        // Atur aria-expanded berdasarkan status yang disimpan
        element.setAttribute("aria-expanded", expanded);

        // Tambahkan event listener untuk menyimpan status saat diubah
        element.addEventListener("click", function () {
          var expanded = element.getAttribute("aria-expanded") === "true";
          saveTreeViewState(elementId, !expanded);
        });
      });
    });

  </script>

  <script>
    $(document).ready(function () {
      // Fungsi untuk mengambil dan menampilkan data pada modal
      function showData(id_pm) {
        // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_pm
        $.ajax({
          url: '<?php echo base_url("Datakriteria/getData"); ?>',
          type: 'GET',
          data: { id_pm: id_pm }, // Menggunakan parameter id_pm
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_pm').val(response.id_pm);
            $('#uraian_aspek').val(response.uraian_aspek);
            $('#dok_pendukung2').val(response.dok_pendukung2);
            $('#jawaban1').val(response.jawaban1);
            $('#link_bukti').val(response.link_bukti);
            $('#link_bukti3').val(response.link_bukti3);
            $('#uraian_jawaban1').val(response.uraian_jawaban1);
            $('#ket_pengisian1').html(response.ket_pengisian1);
            $('#ket_pengisian2').html(response.ket_pengisian2);
            $('#ket_pengisian3').html(response.ket_pengisian3);
            // Tampilkan modal
            $('#EditData').modal('show');
          },
          error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
          }
        });
      }

      // Event click pada link dengan class "open-modal"
      $('.open-modal').click(function (e) {
        e.preventDefault();
        // Mengambil id dari atribut data-id
        var id_pm = $(this).data('id_pm'); // Menggunakan data-id_pm sebagai sumber id_pm
        // Memanggil fungsi showData dengan parameter id_pm
        showData(id_pm);
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      // Fungsi untuk mengambil dan menampilkan data pada modal
      function showDataSub(id_pm0) {
        // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_pm
        $.ajax({
          url: '<?php echo base_url("Datasub/getData"); ?>',
          type: 'GET',
          data: { id_pm0: id_pm0 }, // Menggunakan parameter id_pm
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_pm0').val(response.id_pm0);
            $('#uraian_subkomponen').val(response.uraian_subkomponen);
            $('#dok_pendukung').val(response.dok_pendukung);
            $('#jawabanantara').val(response.jawabanantara);

            // Auto-fill: Jawaban Akhir Otomatis (hidden) dipaksa sinkron dengan jawabanantara terbaru
            var jwb = response.jawabanantara;
            var j_val = "";
            if (jwb === 'AA') j_val = "100";
            else if (jwb === 'A') j_val = "90";
            else if (jwb === 'BB') j_val = "80";
            else if (jwb === 'B') j_val = "70";
            else if (jwb === 'CC') j_val = "60";
            else if (jwb === 'C') j_val = "50";
            else if (jwb === 'D') j_val = "30";
            else if (jwb === 'E') j_val = "0";
            $('#jawaban0otomatis').val(j_val);

            // Jawaban Akhir (display) terisi otomatis = Jawaban Antara
            $('#jawaban0display').val(response.jawabanantara);
            $('#link_bukti0').val(response.link_bukti0);
            $('#link_bukti03').val(response.link_bukti03);
            $('#uraian_jawaban0').val(response.uraian_jawaban0);
            // Tampilkan modal
            $('#EditDataSub').modal('show');
          },
          error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
          }
        });
      }

      // Event click pada link dengan class "open-modal"
      $('.open-modal0').click(function (e) {
        e.preventDefault();
        // Mengambil id dari atribut data-id
        var id_pm0 = $(this).data('id_pm0'); // Menggunakan data-id_pm sebagai sumber id_pm
        // Memanggil fungsi showData dengan parameter id_pm
        showDataSub(id_pm0);
      });
    });
  </script>



  <script>
    $(document).ready(function () {
      // Fungsi untuk mengambil dan menampilkan data pada modal
      function showData2(id_pm) {
        // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_pm
        $.ajax({
          url: '<?php echo base_url("Datakriteria/getData"); ?>',
          type: 'GET',
          data: { id_pm: id_pm }, // Menggunakan parameter id_pm
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_pm2').val(response.id_pm);
            // Tampilkan modal
            $('#UploadData').modal('show');
          },
          error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
          }
        });
      }

      // Event click pada link dengan class "open-modal"
      $('.open-modal2').click(function (e) {
        e.preventDefault();
        // Mengambil id dari atribut data-id
        var id_pm = $(this).data('id_pm'); // Menggunakan data-id_pm sebagai sumber id_pm
        // Memanggil fungsi showData dengan parameter id_pm
        showData2(id_pm);
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      // Fungsi untuk mengambil dan menampilkan data pada modal
      function showDataSub2(id_pm0) {
        // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_pm
        $.ajax({
          url: '<?php echo base_url("Datasub/getData"); ?>',
          type: 'GET',
          data: { id_pm0: id_pm0 }, // Menggunakan parameter id_pm
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_pm02').val(response.id_pm0);
            // Tampilkan modal
            $('#UploadDataSub').modal('show');
          },
          error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
          }
        });
      }

      // Event click pada link dengan class "open-modal"
      $('.open-modal02').click(function (e) {
        e.preventDefault();
        // Mengambil id dari atribut data-id
        var id_pm0 = $(this).data('id_pm0'); // Menggunakan data-id_pm sebagai sumber id_pm
        // Memanggil fungsi showData dengan parameter id_pm
        showDataSub2(id_pm0);
      });
    });
  </script>


  <script>
    $(document).ready(function () {

      $.validator.addMethod("noLeadingZero", function (value, element) {
        return /^(?!0\d+)/.test(value);
      }, "Angka tidak boleh memiliki 0 di depannya.");
      $('#formkrit').validate({
        rules: {
          jawaban1: {
            required: true,
            digits: true,
            range: [0, 100],  // Diperbarui untuk menerima nilai 0-100
            noLeadingZero: true
          },
          uraian_jawaban1: {
            required: function () {
              // Tetap wajib diisi jika jawaban dipilih (bukan kosong)
              return $('#jawaban1').val() !== '';
            }
          }
        },
        messages: {
          jawaban1: {
            required: "Silakan pilih jawaban",
            digits: "Jawaban hanya boleh berupa angka",
            range: "Nilai jawaban tidak valid",
            noLeadingZero: "Angka tidak boleh memiliki 0 di depannya."
          },
          uraian_jawaban1: {
            required: "Penjelasan Jawaban harus diisi"
          }
        },
        // ... kode errorElement dan errorPlacement yang ada ...
      });
      errorElement: 'span',
        errorClass: 'invalid-feedback',
          errorPlacement: function(error, element) {
            error.insertAfter(element);
          },

      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
      submitHandler: function(form) {
        console.log('valid');
        form.submit();
      }
    });
});

  </script>

  <script>
    $(document).ready(function () {
      // Menambahkan metode validasi khusus untuk jawaban0
      $.validator.addMethod("allowedValue", function (value, element, param) {
        return param.includes(parseInt(value, 10));
      }, "Jawaban hanya boleh 0, 30, 50, 60, 70, 80, 90, atau 100.");

      $.validator.addMethod("noLeadingZero", function (value, element) {
        return /^(?!0\d+)/.test(value);
      }, "Angka tidak boleh memiliki 0 di depannya.");

      $('#formsub').validate({
        rules: {
          jawaban0: {
            required: true,
            digits: true,
            allowedValue: [0, 30, 50, 60, 70, 80, 90, 100],
            noLeadingZero: true
          },
          uraian_jawaban0: {
            required: function (element) {
              return parseInt($('#jawaban0').val(), 10) > 81;
            }
          }
        },
        messages: {
          jawaban0: {
            required: "Jawaban Akhir harus diisi!",
            digits: "Jawaban hanya boleh sesuai pilihan!",
            allowedValue: "Jawaban hanya boleh sesuai pilihan!",
            noLeadingZero: "Jawaban hanya boleh sesuai pilihan!"
          },
          uraian_jawaban0: {
            required: "Penjelasan Jawaban harus diisi jika Jawaban Akhir A atau AA!"
          }
        },
        errorElement: 'span',
        errorClass: 'invalid-feedback',
        errorPlacement: function (error, element) {
          error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
          console.log('valid');
          form.submit();
        }
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      $('#EditDataSub').on('shown.bs.modal', function () {
        $('#jawabanantara').on('change', function () {
          var jawabanantara = $(this).val();
          var jawaban0Dropdown = $('#jawaban0');
          var selectedJawaban0 = $('#jawaban0').val();

          // Menghapus semua opsi jawaban akhir
          jawaban0Dropdown.empty();

          // Menambahkan semua opsi jawaban akhir
          var options = {
            '80': 'BB',
            '90': 'A',
            '100': 'AA',
            '70': 'B',
            '60': 'CC',
            '50': 'C',
            '30': 'D',
            '0': 'E'
          };

          for (var value in options) {
            var text = options[value];
            jawaban0Dropdown.append($('<option>', { value: value, text: text }));
          }

          // Menyembunyikan opsi yang tidak sesuai dengan jawaban antara
          if (jawabanantara === 'BB') {
            jawaban0Dropdown.find('option[value!="80"][value!="90"][value!="100"]').attr('hidden', true);
          } else if (jawabanantara === 'B') {
            jawaban0Dropdown.find('option[value!="70"]').attr('hidden', true);
          } else if (jawabanantara === 'CC') {
            jawaban0Dropdown.find('option[value!="60"]').attr('hidden', true);
          } else if (jawabanantara === 'C') {
            jawaban0Dropdown.find('option[value!="50"]').attr('hidden', true);
          } else if (jawabanantara === 'D') {
            jawaban0Dropdown.find('option[value!="30"]').attr('hidden', true);
          } else if (jawabanantara === 'E') {
            jawaban0Dropdown.find('option[value!="0"]').attr('hidden', true);
          }

          // Menetapkan nilai jawaban akhir pertama sebagai nilai default
          jawaban0Dropdown.val(selectedJawaban0);
        });

        // Memanggil perubahan acara saat halaman dimuat
        $('#jawabanantara').trigger('change');
      });
    });
  </script>




</body>

</html>