<!DOCTYPE html>
<html lang="en">

<style>
  .datetimepicker-input {
    font-size: 8px;
    /* Atur ukuran font sesuai keinginan */
  }
</style>

<style>
  /* Ganti angka 300px sesuai dengan lebar yang diinginkan */
  .input-group.col-sm-12 .form-control {
    width: 150px;
    height: 10px;
    font-size: 8px;
  }
</style>

<style>
  @keyframes blink {
    0% {
      opacity: 0;
    }

    50% {
      opacity: 1;
    }

    100% {
      opacity: 0;
    }
  }

  .blinking {
    animation: blink 1s infinite;
  }

  @keyframes flash {
    0% {
      background-color: #fff3cd;
    }

    100% {
      background-color: transparent;
    }
  }

  .highlight {
    animation: flash 2s ease-in-out;
    background-color: #fff3cd !important;
  }

  @keyframes blinkSub {
    0% {
      box-shadow: inset 0 0 0 rgba(255, 193, 7, 0);
    }

    50% {
      box-shadow: inset 0 0 0 9999px rgba(255, 193, 7, 0.2);
    }

    100% {
      box-shadow: inset 0 0 0 rgba(255, 193, 7, 0);
    }
  }

  @keyframes blinkRow {
    0% {
      box-shadow: inset 0 0 0 rgba(255, 193, 7, 0);
    }

    50% {
      box-shadow: inset 0 0 0 9999px rgba(255, 193, 7, 0.25);
    }

    100% {
      box-shadow: inset 0 0 0 rgba(255, 193, 7, 0);
    }
  }

  .blink-soft {
    animation: blinkSub 1s ease-in-out 2;
  }

  .revision-notice {
    background: #fff3cd;
    border-left: 5px solid #ffc107;
    padding: 10px;
    margin-bottom: 15px;
    font-weight: bold;
    display: none;
    color: #856404;
  }
</style>


<body>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-">
          <div class="col-sm-5 col-7">
            <h1>Evaluasi Inspektorat</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Evaluasi Inspektorat</li>
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

  
              <?php
              $id_role_switcher = (int) $this->session->userdata('id_role');
              if (in_array($id_role_switcher, [10, 11, 12])): ?>
              <!-- Unit Switcher untuk Supervisor (Ketua Tim / Pengendali Teknis / Pengendali Mutu) -->
              <div class="col-12 mb-2 d-flex align-items-center" style="gap: 8px;">
                <label class="mb-0 font-weight-bold text-secondary" style="white-space:nowrap; font-size:13px;">
                  <i class="fas fa-building mr-1"></i>Unit Kerja:
                </label>
                <form method="post" action="<?php echo base_url('ev/set_unit_session_supervisor'); ?>" style="margin:0; display:flex; align-items:center; gap:6px;">
                  <select name="id_unit" class="form-control form-control-sm" style="min-width:220px;" onchange="this.form.submit()">
                    <?php foreach ($all_units as $u): ?>
                      <option value="<?php echo $u['id_unit']; ?>"
                        <?php echo ($u['id_unit'] == $this->session->userdata('id_unit')) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($u['nm_unit'], ENT_QUOTES, 'UTF-8'); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </form>
              </div>
              <?php endif; ?>

              <div <?php if ($this->session->userdata('id_unit') == "") {
                  echo "hidden";
                } else {
                  echo "";
                }
                ; ?>
                  class="col-">


                  <?php foreach ($loadtu as $load): ?>
                    <?php if ($load['id_ev'] != "" && in_array($this->session->userdata('id_role'), [2, 3, 4, 6, 7, 10, 11, 12, 13])): ?>
                      <a class="btn btn-success" href="<?php echo base_url('ev/excel') ?>">Hasil Penilain.xlsx</a>
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
                                    <th class="text-center align-middle" style="width: 50px" colspan="2">Nilai
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
                                                <th class="text-center align-middle" style="width: 950px">Subkomponen</th>
                                                <th class="text-center align-middle" style="width: 50px">Nilai Akhir Unit
                                                </th>
                                                <th class="text-center align-middle" style="width: 50px">Penjelasan
                                                  Jawaban</th>
                                                <th class="text-center align-middle" style="width: 20px" colspan="2">Bukti
                                                  Unit (Link/File)</th>
                                                <th class="text-center align-middle" style="width: 50px">Bobot</th>
                                                <th class="text-center align-middle" style="width: 50px" colspan="2">
                                                  Keberadaan, Kualitas dan Pemanfaatan</th>
                                                <th class="text-center align-middle" style="width: 50px">Jawaban Antara
                                                </th>
                                                <th class="text-center align-middle" style="width: 50px">Nilai Akhir</th>
                                                <th class="text-center align-middle" style="width: 50px" colspan="2">Nilai
                                                  Akuntabilitas Kinerja</th>
                                                <th class="text-center align-middle" style="width: 50px">Catatan Evaluasi
                                                </th>
                                                <th class="text-center align-middle" style="width: 20px">Konfir-
                                                  masi</th>
                                                <th class="text-center align-middle" style="width: 20px">Aksi</th>


                                              </tr>
                                            </thead>

                                            <tbody>

                                              <?php foreach ($sub as $subk): ?>
                                                <?php if ($subk['id_komponen'] === $kom['id_komponen']): ?>
                                                  <tr id="subkomponen-<?php echo $subk['kd_subkomponen']; ?>"
                                                    data-id="subkomponen-<?php echo $subk['id_subkomponen']; ?>"
                                                    data-widget="expandable-table"
                                                    elementId="s<?php echo $subk['id_subkomponen']; ?>" aria-expanded="false"
                                                    data-komponen="k<?php echo $kom['id_komponen']; ?>"
                                                    data-kode="<?php echo $subk['kd_subkomponen']; ?>">
                                                    <td class="text-center align-middle">
                                                      <?php echo $subk['kd_subkomponen']; ?>
                                                    </td>
                                                    <td class="text-justify">
                                                      <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                      <?php echo $subk['uraian_subkomponen']; ?>
                                                    </td>
                                                    <?php
                                                    /**
                                                     * [KOLOM: Nilai Akhir Unit]
                                                     * Sumber  : $subk['jawaban0'] → ta_pm0.jawaban0
                                                     * Isi     : Nilai sub-komponen yang disimpan oleh unit secara manual.
                                                     *
                                                     * [CATATAN UNTUK PROGRAMMER — Fix #4 Pending]
                                                     * Masalah : Nilai ini bisa stale (tidak sinkron) jika unit
                                                     *           hanya mengisi indikator (jawaban1 di ta_pm) tanpa
                                                     *           menyimpan ulang nilai sub-komponen nya.
                                                     *
                                                     * Solusi  : Tambahkan alias 'jawabanantara_unit' pada query
                                                     *           get_datasub() di m_ev.php yang menghitung:
                                                     *           AVG(ta_pm.jawaban1) — rata-rata jawaban UNIT per indikator.
                                                     *           Lalu ganti $subk['jawaban0'] di bawah ini
                                                     *           dengan $subk['jawabanantara_unit'].
                                                     *
                                                     * PERHATIAN: Jangan ganti dengan $subk['jawabanantara'] karena
                                                     *            di konteks v_ev.php, jawabanantara = AVG(ta_ev.jawaban2)
                                                     *            yaitu rata-rata jawaban EVALUATOR, bukan unit.
                                                     */
                                                    ?>
                                                    <td class="text-center align-middle">
                                                      <?php echo $subk['jawabanantara_unit']; ?>
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
                                                      class="text-truncate align-middle" style="max-width: 100px;"
                                                      style="width: 100px">
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
                                                      <?php if ($subk['link_bukti02'] != ""): ?>
                                                        <button class="btn btn-secondary btn-xs view-files-btn-pm0"
                                                          data-files="<?php echo $subk['link_bukti02']; ?>"
                                                          data-id_pm0="<?php echo $subk['id_pm0']; ?>"><i
                                                            class="fas fa-search"></i></button>
                                                      <?php endif; ?>
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
                                                     * Sumber  : $subk['jawabanantara'] → dihitung di m_ev.php get_datasub()
                                                     * Formula : AVG(ta_ev.jawaban2 * bobot) / bobot
                                                     * Isi     : Rata-rata tertimbang jawaban EVALUATOR per indikator.
                                                     *
                                                     * PENTING : Ini adalah rata-rata jawaban evaluator (jawaban2),
                                                     *           BUKAN rata-rata jawaban unit (jawaban1).
                                                     *           Keduanya adalah field berbeda di tabel yang berbeda.
                                                     */
                                                    ?>
                                                    <td class="text-center align-middle"><?php echo $subk['jawabanantara']; ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                      <?php
                                                      if ($subk['jawaban0ev'] == "100") {
                                                        echo "AA";
                                                      } elseif ($subk['jawaban0ev'] == "90") {
                                                        echo "A";
                                                      } elseif ($subk['jawaban0ev'] == "80") {
                                                        echo "BB";
                                                      } elseif ($subk['jawaban0ev'] == "70") {
                                                        echo "B";
                                                      } elseif ($subk['jawaban0ev'] == "60") {
                                                        echo "CC";
                                                      } elseif ($subk['jawaban0ev'] == "50") {
                                                        echo "C";
                                                      } elseif ($subk['jawaban0ev'] == "30") {
                                                        echo "D";
                                                      } elseif ($subk['jawaban0ev'] == "0") {
                                                        echo "E";
                                                      } else {
                                                        echo "";
                                                      }
                                                      ; ?>
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
                                                      title="<?php echo htmlspecialchars($subk['catatan_ev0'], ENT_QUOTES, 'UTF-8'); ?>"
                                                      class="text-center align-middle" style="width: 50px">
                                                      <i class="expandable-table-caret"></i>
                                                      <?php
                                                      $fullText = htmlspecialchars($subk['catatan_ev0'], ENT_QUOTES, 'UTF-8');
                                                      $shortText = (strlen($fullText) > 3) ? substr($fullText, 0, 3) . '...' : $fullText;
                                                      echo $shortText;
                                                      if (strlen($fullText) > 3) {
                                                        echo ' <a href="#" class="read-more" data-fulltext="' . $fullText . '" data-toggle="modal" data-target="#readMoreModal">more</a>';
                                                      }
                                                      ?>
                                                    </td>
                                                    <td class="text-center align-middle" style="width: 30px">
                                                      <?php if ($subk['status_data'] == "1" && $subk['perbaikan0'] == "1"): ?>
                                                        <div class="btn btn-xs open-modal02"
                                                          data-id_ev0="<?php echo $subk['id_ev0']; ?>"
                                                          onclick="setSessionIdEv0('<?php echo $subk['id_ev0']; ?>')"><i
                                                            class="fas fa-comments text-danger"></i>
                                                          <?php foreach ($konfirmasi0notif as $k0n): ?>
                                                            <?php if (($this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 13) && $k0n['id_ev0'] == $subk['id_ev0'] && ($k0n['id_role'] == 1 || $k0n['id_role'] == 5)): ?>
                                                              <span class="badge badge-danger blinking">!</span>
                                                            <?php endif; ?>
                                                            <?php if (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $k0n['id_ev0'] == $subk['id_ev0'] && ($k0n['id_role'] == 3 || $k0n['id_role'] == 7 || $k0n['id_role'] == 13)): ?>
                                                              <span class="badge badge-danger blinking">!</span>
                                                            <?php endif; ?>
                                                          <?php endforeach; ?>
                                                        </div>
                                                      <?php endif; ?>
                                                    </td>


                                                    <td class="text-center align-middle" style="width: 30px">
                                                      <?php if ($can_edit_ev && $subk['status_data'] == "1" && $subk['status_data1'] == "0"): ?>
                                                        <div <?php if ($subk['ev_modified_by'] != ""): ?>
                                                            title="last modified by: <?php echo $subk['ev_modified_by']; ?>" <?php endif; ?> class="btn btn-info btn-xs open-modal0"
                                                          data-id_ev0="<?php echo $subk['id_ev0']; ?>"><i
                                                            class="fas fa-edit"></i>
                                                        </div>
                                                      <?php else: ?>
                                                        <div <?php if ($subk['ev_modified_by'] != ""): ?>
                                                            title="last modified by: <?php echo $subk['ev_modified_by']; ?>" <?php endif; ?> class="btn btn-info btn-xs open-modal0"
                                                          data-id_ev0="<?php echo $subk['id_ev0']; ?>">
                                                          <i class="fas fa-search"></i>
                                                        </div>
                                                      <?php endif; ?>
                                                      <div class="btn btn-warning btn-xs btn-komentar"
                                                        data-komponen="<?php echo $subk['id_komponen']; ?>"
                                                        data-komponen-name="<?php echo htmlspecialchars($kom['uraian_komponen'], ENT_QUOTES); ?>"
                                                        data-subkomponen="<?php echo $subk['id_subkomponen']; ?>"
                                                        data-subkomponen-kode="<?php echo $subk['kd_subkomponen']; ?>"
                                                        data-subkomponen-name="<?php echo htmlspecialchars($subk['uraian_subkomponen'], ENT_QUOTES); ?>"
                                                        data-indikator="0" data-section="Subkomponen" title="Komentar">
                                                        <i class="fas fa-comment-dots"></i>
                                                      </div>
                                                    </td>

                                                  </tr>



                                                  <tr class="expandable-body">
                                                    <td colspan="16">
                                                      <div class="p-0" style="display: none;">
                                                        <table class="table table-hover table-bordered">
                                                          <thead class="table-dark">




                                                            <tr>
                                                              <th class="text-center align-middle" style="width: 20px">Kode
                                                              </th>
                                                              <th class="text-center align-middle" style="width: 200px">
                                                                Kriteria yang dinilai</th>
                                                              <th class="text-center align-middle" style="width: 50px">Jawaban
                                                                Unit</th>
                                                              <th class="text-center align-middle" style="width: 50px">
                                                                Penjelasan Jawaban</th>
                                                              <th class="text-center align-middle" style="width: 20px"
                                                                colspan="2">Bukti Unit (Link/File)</th>
                                                              <th class="text-center align-middle" style="width: 50px">Jawaban
                                                              </th>
                                                              <th class="text-center align-middle" style="width: 200px">
                                                                Catatan Evaluasi</th>
                                                              <th class="text-center align-middle" style="width: 20px">Konfir-
                                                                masi</th>
                                                              <th class="text-center align-middle" style="width: 20px">Aksi
                                                              </th>


                                                          </thead>
                                                          <tbody>


                                                            <?php foreach ($kri as $krit): ?>
                                                              <?php if ($krit['id_subkomponen'] === $subk['id_subkomponen']): ?>
                                                                <tr id="indikator-<?php echo $krit['id_aspek']; ?>"
                                                                  data-widget="expandable-table " aria-expanded="false"
                                                                  data-subkomponen="s<?php echo $subk['id_subkomponen']; ?>">
                                                                  <td class="text-center"><?php echo $krit['kd_aspek']; ?></td>
                                                                  <td class="text-justify" style="width: 350px">
                                                                    <i class="expandable-table-caret"></i>
                                                                    <?php echo $krit['uraian_aspek']; ?>
                                                                  </td>
                                                                  <td <?php
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
                                                                  ; ?> class="text-center align-middle">
                                                                    <?php
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
                                                                      echo "";
                                                                    }
                                                                    ?>
                                                                  </td>
                                                                  <td
                                                                    title="<?php echo htmlspecialchars($krit['uraian_jawaban1'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    class=" text-center align-middle" style="width: 100px">
                                                                    <i class="expandable-table-caret"></i>
                                                                    <?php
                                                                    $fullText = htmlspecialchars($krit['uraian_jawaban1'], ENT_QUOTES, 'UTF-8');
                                                                    $shortText = (strlen($fullText) > 3) ? substr($fullText, 0, 3) . '...' : $fullText;
                                                                    echo $shortText;
                                                                    if (strlen($fullText) > 3) {
                                                                      echo ' <a href="#" class="read-more" data-fulltext="' . $fullText . '" data-toggle="modal" data-target="#readMoreModal">more</a>';
                                                                    }
                                                                    ?>
                                                                  </td>
                                                                  <td title="<?php echo $krit['dok_pendukung2']; ?>"
                                                                    class=" text-truncate align-middle" style="max-width: 100px;"
                                                                    style="width: 100px">
                                                                    <i class="expandable-table-caret "></i>
                                                                    <div class="text-truncate">
                                                                      <?php
                                                                      $url = $krit['link_bukti'];

                                                                      // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                                                      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                                        $url = "http://" . $url;
                                                                      }
                                                                      ?>
                                                                      <a href="<?php echo $url; ?>" target=" _blank">
                                                                        <?php echo htmlspecialchars($krit['link_bukti'], ENT_QUOTES, 'UTF-8'); ?>
                                                                        < /a>
                                                                    </div>
                                                                    <div class="text-truncate">
                                                                      <?php
                                                                      $url = $krit['link_bukti3'];

                                                                      // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                                                      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                                                        $url = "http://" . $url;
                                                                      }
                                                                      ?>
                                                                      <a href="<?php echo $url; ?>" target=" _blank">
                                                                        <?php echo htmlspecialchars($krit['link_bukti3'], ENT_QUOTES, 'UTF-8'); ?>
                                                                        < /a>
                                                                    </div>
                                                                  </td>
                                                                  <td class="text-center align-middle" style="width: 30px">
                                                                    <?php if ($krit['link_bukti2'] != ""): ?> <button
                                                                        class="btn btn-secondary btn-xs view-files-btn-pm"
                                                                        data-files="<?php echo $krit['link_bukti2']; ?>"
                                                                        data-id_pm=" <?php echo $krit['id_pm']; ?>"><i
                                                                          class="fas fa-search"></i></button>
                                                                    <?php endif; ?>
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
                                                                     ; ?> class=" text-center align-middle">
                                                                    <?php
                                                                    if ($krit['jawaban2'] == "100") {
                                                                      echo "AA";
                                                                    } elseif ($krit['jawaban2'] == "90") {
                                                                      echo "A";
                                                                    } elseif ($krit['jawaban2'] == "80") {
                                                                      echo "BB";
                                                                    } elseif ($krit['jawaban2'] == "70") {
                                                                      echo "B";
                                                                    } elseif ($krit['jawaban2'] == "60") {
                                                                      echo "CC";
                                                                    } elseif ($krit['jawaban2'] == "50") {
                                                                      echo "C";
                                                                    } elseif ($krit['jawaban2'] == "30") {
                                                                      echo "D";
                                                                    } elseif ($krit['jawaban2'] === "0" || $krit['jawaban2'] === 0) {
                                                                      echo "E";
                                                                    } else {
                                                                      echo "";
                                                                    }
                                                                    ; ?>
                                                                  </td>
                                                                  <td class="text-justify" style="width: 350px">
                                                                    <i class="expandable-table-caret"></i>
                                                                    <?php
                                                                    $fullText = htmlspecialchars($krit['catatan_ev'], ENT_QUOTES, 'UTF-8');
                                                                    $shortText = (strlen($fullText) > 350) ? substr($fullText, 0, 340) . '...' : $fullText;
                                                                    echo $shortText;
                                                                    if (strlen($fullText) > 340) {
                                                                      echo ' <a href="#" class="read-more" data-fulltext="' . $fullText . '" data-toggle="modal" data-target="#readMoreModal">read more</a>';
                                                                    }
                                                                    ?>
                                                                  <td class="text-center align-middle" style="width: 30px">
                                                                    <?php if ($krit['status_data'] == "1" && $krit['perbaikan'] == "1"): ?>
                                                                      <div class="btn btn-xs open-modal2"
                                                                        data-id_ev="<?php echo $krit['id_ev']; ?>"
                                                                        onclick="setSessionIdEv('<?php echo $krit['id_ev']; ?>')"><i
                                                                          class="fas fa-comments text-danger"></i>
                                                                        <?php foreach ($konfirmasinotif as $kn): ?>
                                                                          <?php if (($this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 13) && $kn['id_ev'] == $krit['id_ev'] && ($kn['id_role'] == 1 || $kn['id_role'] == 5)): ?>
                                                                            <span class="badge badge-danger blinking">!</span>
                                                                          <?php endif; ?>
                                                                          <?php if (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && $kn['id_ev'] == $krit['id_ev'] && ($kn['id_role'] == 3 || $kn['id_role'] == 7 || $kn['id_role'] == 13)): ?>
                                                                            <span class="badge badge-danger blinking">!</span>
                                                                          <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                      </div>
                                                                    <?php endif; ?>
                                                                  </td>
                                                                  <td class="text-center align-middle" style="width: 30px">
                                                                    <?php if ($can_edit_ev && $krit['status_data'] == "1" && $krit['status_data1'] == "0"): ?>
                                                                      <div <?php if ($krit['ev_modified_by'] != ""): ?>
                                                                          title="last modified by: <?php echo $krit['ev_modified_by']; ?>"
                                                                        <?php endif; ?> class="btn btn-success btn-xs open-modal"
                                                                        data-id_ev="<?php echo $krit['id_ev']; ?>"><i
                                                                          class="fas fa-edit"></i></div>
                                                                    <?php else: ?>
                                                                      <div <?php if ($krit['ev_modified_by'] != ""): ?>
                                                                          title="last modified by: <?php echo $krit['ev_modified_by']; ?>"
                                                                        <?php endif; ?> class="btn btn-primary btn-xs open-modal"
                                                                        data-id_ev="<?php echo $krit['id_ev']; ?>"><i
                                                                          class="fas fa-search"></i></div>
                                                                    <?php endif; ?>
                                                                    <div class="btn btn-warning btn-xs btn-komentar"
                                                                      data-komponen="<?php echo $krit['id_komponen']; ?>"
                                                                      data-komponen-name="<?php echo htmlspecialchars($kom['uraian_komponen'], ENT_QUOTES); ?>"
                                                                      data-subkomponen="<?php echo $krit['id_subkomponen']; ?>"
                                                                      data-subkomponen-kode="<?php echo $subk['kd_subkomponen']; ?>"
                                                                      data-subkomponen-name="<?php echo htmlspecialchars($subk['uraian_subkomponen'], ENT_QUOTES); ?>"
                                                                      data-indikator="<?php echo $krit['id_aspek']; ?>"
                                                                      data-indikator-name="<?php echo htmlspecialchars($krit['uraian_aspek'], ENT_QUOTES); ?>"
                                                                      data-section="Indikator Kinerja" title="Komentar">
                                                                      <i class="fas fa-comment-dots"></i>
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

            <?php
            $id_role_v = (int) $this->session->userdata('id_role');
            ?>

            <?php
            /* =========================================================
             * UNIT SWITCHER — hanya tampil untuk Tim Evaluator (role 13)
             * jika ditugaskan ke lebih dari 1 unit
             * ========================================================= */
            if ($id_role_v === 13 && !empty($assigned_units) && count($assigned_units) > 1):
              ?>
              <div class="card card-info card-outline mt-3">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-exchange-alt mr-1"></i>Ganti Unit Kerja</h3>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('ev/set_unit_session') ?>" method="post" class="form-inline">
                    <label class="mr-2">Unit yang Ditugaskan:</label>
                    <select name="id_unit" class="form-control mr-2">
                      <?php foreach ($assigned_units as $au): ?>
                        <option value="<?php echo $au['id_unit'] ?>" <?php echo ($this->session->userdata('id_unit') == $au['id_unit']) ? 'selected' : '' ?>>
                          <?php echo htmlspecialchars($au['nm_unit']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-info">
                      <i class="fas fa-arrow-right mr-1"></i>Pindah Unit
                    </button>
                  </form>
                </div>
              </div>
            <?php endif; ?>

            <?php
            /* =========================================================
             * HISTORY PERUBAHAN EV — hanya tampil untuk Supervisor (10, 11, 12)
             * ========================================================= */
            if (in_array($id_role_v, [10, 11, 12])):
              ?>
              <div class="card card-warning card-outline mt-3">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i>History Perubahan Penilaian EV
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm table-bordered table-striped mb-0">
                    <thead class="bg-warning">
                      <tr>
                        <th style="width:140px">Waktu Perubahan</th>
                        <th>Field</th>
                        <th>Nilai Lama</th>
                        <th>Nilai Baru</th>
                        <th>Diubah Oleh</th>
                        <th>Jabatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($ev_history)): ?>
                        <?php foreach ($ev_history as $h): ?>
                          <tr>
                            <td><small><?php echo htmlspecialchars($h['changed_at']) ?></small></td>
                            <td><code><?php echo htmlspecialchars($h['field_name']) ?></code></td>
                            <td class="text-danger"><?php echo htmlspecialchars($h['old_value'] ?: '-') ?></td>
                            <td class="text-success"><strong><?php echo htmlspecialchars($h['new_value'] ?: '-') ?></strong>
                            </td>
                            <td><strong><?php echo htmlspecialchars($h['changed_by']) ?></strong></td>
                            <td><span
                                class="badge badge-secondary"><?php echo htmlspecialchars($h['nm_role'] ?? 'Role ' . $h['id_role']) ?></span>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center text-muted"><em>Belum ada riwayat perubahan pada unit
                              kerja/tahun ini.</em></td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php endif; ?>

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
      // Add click e      vent to read-more links
      var readMoreLinks = document.querySelectorAll('.read-more');
      readMoreLinks.forEach(link => {
        link.addEventListener('click', function (event) {
          event.preventDefault();
          var fullText = this.getAttribute('data-fulltext');
          document.getElementById('modalText').innerText = fullText;
        });
      });
    }
    );
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


            <input type="hidden" name="id_ev" id="id_ev">

            <div class="row">
              <div class="form-group col-md-6">
                <label>Kriteria yang Dinilai</label>
                <textarea readonly type="text" rows="8" name="uraian_aspek" id="uraian_aspek"
                  class="form-control text-justify"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Daftar Evidance</label>
                <textarea readonly type="text" rows="8" name="dok_pendukung2" id="dok_pendukung2"
                  class="form-control text-justify"></textarea>
              </div>

            </div>
            <div class="row">

              <div class="form-group col-md-2">
                <label>Jawaban Unit</label>
                <select readonly disabled name="jawaban1" id="jawaban1" class="form-control">
                  <option hidden value="">Pilih Jawaban</option>
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

              <div class="form-group col-md-2">
                <label>Jawaban</label>
                <select id="jawaban2" name="jawaban2" class="form-control" <?php if ($can_edit_ev): ?> <?php else: ?>
                    readonly disabled <?php endif; ?>>
                  <option hidden value="">Pilih Jawaban</option>
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

              <div class="form-group col-md-2">
                <label>Konfirmasi?</label>
                <select id="perbaikan" name="perbaikan" class="form-control" <?php if ($can_edit_ev): ?> <?php else: ?>
                    readonly disabled <?php endif; ?>>
                  <option value="0">Tidak</option>
                  <option value="1" selected>Ya</option>
                </select>
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
              <div class="form-group col-md-6">
                <label>Penjelasan Jawaban Unit</label>
                <textarea readonly id="uraian_jawaban1" type="text" rows="7" name="uraian_jawaban1"
                  class="form-control text-justify"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Catatan Evaluasi</label>
                <textarea type="text" rows="7" name="catatan_ev" id="catatan_ev" class="form-control text-justify" <?php if ($can_edit_ev): ?> <?php else: ?> readonly disabled <?php endif; ?>></textarea>
              </div>


            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?php if ($can_edit_ev): ?>
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
            url: "<?php echo base_url('ev/update_data'); ?>",
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

            <input type="hidden" name="id_ev0" id="id_ev0">

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


              <div class="form-group col-md-3">
                <label>Jawaban Akhir Unit</label>
                <input readonly type="text" id="jawaban0" class="form-control">
              </div>

              <div class="form-group col-md-3">
                <label>Jawaban Antara</label>
                <input readonly type="text" name="jawabanantara" id="jawabanantara" class="form-control">
              </div>

              <div class="form-group col-md-3">
                <label>Jawaban Akhir</label>
                <select id="jawaban0ev" name="jawaban0ev" class="form-control" <?php if ($can_edit_ev): ?> <?php else: ?> readonly disabled <?php endif; ?>>
                  <option value="" hidden>Pilih Jawaban</option>
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


              <div class="form-group col-md-3">
                <label>Perlu Konfirmasi?</label>
                <select id="perbaikan0" name="perbaikan0" class="form-control" <?php if ($can_edit_ev): ?> <?php else: ?> readonly disabled <?php endif; ?>>
                  <option value="0">Tidak</option>
                  <option value="1" selected>Ya</option>
                </select>
              </div>

            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Penjelasan Jawaban Unit</label>
                <textarea readonly id="uraian_jawaban0" title="Wajib diisi jika Jawaban Akhir A atau AA" type="text"
                  rows="7" name="uraian_jawaban0" class="form-control text-justify"
                  placeholder="Wajib diisi jika Jawaban Akhir A atau AA"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Catatan Evaluasi</label>
                <textarea id="catatan_ev0" type="text" rows="7" name="catatan_ev0" class="form-control text-justify"
                  <?php if ($can_edit_ev): ?> <?php else: ?> readonly disabled <?php endif; ?>></textarea>
              </div>



            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?php if ($can_edit_ev): ?>
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
            url: "<?php echo base_url('ev/update_data2'); ?>",
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



        row.appendChild(fileNameCell);
        row.appendChild(previewCell);
        fileListBody.appendChild(row);
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



        row.appendChild(fileNameCell);
        row.appendChild(previewCell);
        fileListBody.appendChild(row);
      });
    }


  </script>





  <!-- Modal Edit Konfirmasi -->
  <div class="modal fade" id="EditKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">


        <?php echo form_open_multipart('ev/update_konfirmasi'); ?>


        <input type="hidden" name="id_ev" id="id_ev2">
        <input type="hidden" name="id_unit" value="<?php echo $this->session->userdata('id_unit'); ?>">
        <input type="hidden" name="tahun" value="<?php echo $this->session->userdata('tahun'); ?>">
        <input type="hidden" name="id_role" value="<?php echo $this->session->userdata('id_role'); ?>">
        <input type="hidden" name="log_user" value="<?php echo $this->session->userdata('username'); ?>">


        <div class="row">
          <div class="col-md-12" style="height:500px;">
            <!-- DIRECT CHAT DANGER -->
            <div class="card card-danger direct-chat direct-chat-danger">
              <div class="card-header">
                <h3 class="card-title">Konfirmasi</h3>

                <div class="card-tools">
                  <?php foreach ($evaluasiform as $evf): ?>
                    <span title="<?php echo $evf['uraian_aspek']; ?>" class="badge text-truncate"
                      style="width: 600px; text-align: right;"><?php echo $evf['kd_komponen']; ?>.<?php echo $evf['kd_subkomponen']; ?>.<?php echo $evf['kd_aspek']; ?>
                      <?php echo $evf['uraian_aspek']; ?></span>
                  <?php endforeach; ?>
                  <!-- <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button> -->
                  <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->

                <div class="direct-chat-messages" style="height:500px;">
                  <?php foreach ($h_konfirmasi as $hkon): ?>
                    <!-- Message. Default to the left -->
                    <?php if ($hkon['id_role'] == 3 || $hkon['id_role'] == 7 || $hkon['id_role'] == 13): ?>
                      <div class="direct-chat-msg col-md-6 ml-auto">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left"><?php echo $hkon['log_user']; ?></span>
                          <span class="direct-chat-timestamp float-right"><?php echo $hkon['created_at']; ?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="<?php echo base_url() ?>assets/dist/img/evaluator.jpg"
                          alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          <?php echo htmlspecialchars($hkon['uraian_konfirmasi'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-timestamp float-right">Tenggat Waktu :
                            <?php echo $hkon['tenggat_waktu']; ?></span>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                    <?php endif; ?>

                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <?php if ($hkon['id_role'] == 1 || $hkon['id_role'] == 5): ?>
                      <div class="direct-chat-msg right col-md-6">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right"><?php echo $hkon['log_user']; ?></span>
                          <span class="direct-chat-timestamp float-left"><?php echo $hkon['created_at']; ?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="<?php echo base_url() ?>assets/dist/img/klien.png"
                          alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          <?php echo htmlspecialchars($hkon['uraian_konfirmasi'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="direct-chat-infos clearfix">
                          <a class="direct-chat-timestamp float-left" href="<?php echo $hkon['bukti_perbaikan']; ?>"
                            target="_blank"><?php echo htmlspecialchars($hkon['bukti_perbaikan'], ENT_QUOTES, 'UTF-8'); ?></a>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                    <?php endif; ?>
                    <!-- /.direct-chat-msg -->
                  <?php endforeach; ?>
                </div>

                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                  </ul>
                  <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="row">
                    <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 13)): ?>
                      <div class="input-group col-md-2 date" id="datetimepicker" data-target-input="nearest">
                        <input required type="text" name="tenggat_waktu" class="form-control datetimepicker-input"
                          data-target="#datetimepicker" />
                        <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                      <div class="input-group col-md-10">
                        <input required type="text" name="uraian_konfirmasi" placeholder="Type Message ..."
                          class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger">Send</button>
                        </span>
                      </div>
                    <?php endif; ?>
                    <?php if (
                      $this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                        $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))
                    ): ?>
                      <div class="input-group col-md-1">
                        <button title="Bukti Perbaikan" class="btn btn-secondary" id="showButton"><i
                            class="fas fa-paperclip"></i></button>
                      </div>
                      <div class="input-group col-md-11">
                        <input required type="text" name="uraian_konfirmasi" placeholder="Type Message ..."
                          class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger">Send</button>
                        </span>
                      </div>
                      <div class="input-group col-sm-12 hidden-div" id="buktiPerbaikanDiv" style="display:none;">
                        <input type="text" name="bukti_perbaikan" class="form-control" placeholder="Bukti Link ...">
                      </div>
                    <?php endif; ?>


                  </div>

                </form>
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>
        </div>

        <!--   -->


        <?php echo form_close(); ?>



      </div>
    </div>
  </div>






  <!-- Modal Edit Konfirmasi0 -->
  <div class="modal fade" id="EditKonfirmasi0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">


        <?php echo form_open_multipart('ev/update_konfirmasi0'); ?>


        <input type="hidden" name="id_ev0" id="id_ev02">
        <input type="hidden" name="id_unit" value="<?php echo $this->session->userdata('id_unit'); ?>">
        <input type="hidden" name="tahun" value="<?php echo $this->session->userdata('tahun'); ?>">
        <input type="hidden" name="id_role" value="<?php echo $this->session->userdata('id_role'); ?>">
        <input type="hidden" name="log_user" value="<?php echo $this->session->userdata('username'); ?>">


        <div class="row">
          <div class="col-md-12" style="height:500px;">
            <!-- DIRECT CHAT DANGER -->
            <div class="card card-danger direct-chat direct-chat-danger">
              <div class="card-header">
                <h3 class="card-title">Konfirmasi</h3>

                <div class="card-tools">
                  <?php foreach ($evaluasi0form as $ev0f): ?>
                    <span title="<?php echo $ev0f['uraian_subkomponen']; ?>" class="badge text-truncate"
                      style="width: 600px; text-align: right;"><?php echo $ev0f['kd_komponen']; ?>.<?php echo $ev0f['kd_subkomponen']; ?>
                      <?php echo $ev0f['uraian_subkomponen']; ?></span>
                  <?php endforeach; ?>
                  <!-- <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button> -->
                  <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->

                <div class="direct-chat-messages" style="height:500px;">
                  <?php foreach ($h_konfirmasi0 as $hkon0): ?>
                    <!-- Message. Default to the left -->
                    <?php if ($hkon0['id_role'] == 3 || $hkon0['id_role'] == 7 || $hkon0['id_role'] == 13): ?>
                      <div class="direct-chat-msg col-md-6 ml-auto">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left"><?php echo $hkon0['log_user']; ?></span>
                          <span class="direct-chat-timestamp float-right"><?php echo $hkon0['created_at']; ?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="<?php echo base_url() ?>assets/dist/img/evaluator.jpg"
                          alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          <?php echo htmlspecialchars($hkon0['uraian_konfirmasi'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-timestamp float-right">Tenggat Waktu :
                            <?php echo $hkon0['tenggat_waktu']; ?></span>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                    <?php endif; ?>

                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <?php if ($hkon0['id_role'] == 1 || $hkon0['id_role'] == 5): ?>
                      <div class="direct-chat-msg right col-md-6">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right"><?php echo $hkon0['log_user']; ?></span>
                          <span class="direct-chat-timestamp float-left"><?php echo $hkon0['created_at']; ?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="<?php echo base_url() ?>assets/dist/img/klien.png"
                          alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          <?php echo htmlspecialchars($hkon0['uraian_konfirmasi'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="direct-chat-infos clearfix">
                          <a class="direct-chat-timestamp float-left" href="<?php echo $hkon0['bukti_perbaikan']; ?>"
                            target="_blank"><?php echo htmlspecialchars($hkon0['bukti_perbaikan'], ENT_QUOTES, 'UTF-8'); ?></a>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                    <?php endif; ?>
                    <!-- /.direct-chat-msg -->
                  <?php endforeach; ?>
                </div>

                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                  </ul>
                  <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="row">
                    <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 13)): ?>
                      <div class="input-group col-md-2 date" id="datetimepicker0" data-target-input="nearest">
                        <input required type="text" name="tenggat_waktu" class="form-control datetimepicker-input"
                          data-target="#datetimepicker0" />
                        <div class="input-group-append" data-target="#datetimepicker0" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                      <div class="input-group col-md-10">
                        <input required type="text" name="uraian_konfirmasi" placeholder="Type Message ..."
                          class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger">Send</button>
                        </span>
                      </div>
                    <?php endif; ?>
                    <?php if (
                      $this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 14) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') ||
                        $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))
                    ): ?>
                      <div class="input-group col-md-1">
                        <button title="Bukti Perbaikan" class="btn btn-secondary" id="showButton"><i
                            class="fas fa-paperclip"></i></button>
                      </div>
                      <div class="input-group col-md-11">
                        <input required type="text" name="uraian_konfirmasi" placeholder="Type Message ..."
                          class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger">Send</button>
                        </span>
                      </div>
                      <div class="input-group col-sm-12 hidden-div" id="buktiPerbaikanDiv" style="display:none;">
                        <input type="text" name="bukti_perbaikan" class="form-control" placeholder="Bukti Link ...">
                      </div>
                    <?php endif; ?>


                  </div>

                </form>
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>
        </div>

        <!--   -->


        <?php echo form_close(); ?>



      </div>
    </div>
  </div>








  <script>
    document.getElementById('showButton').addEventListener('click', function (event) {
      event.preventDefault();
      var divElement = document.getElementById('buktiPerbaikanDiv');
      if (divElement.style.display === 'none') {
        divElement.style.display = 'block';
      } else {
        divElement.style.display = 'none';
      }
    });
  </script>

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
      function showData(id_ev) {
        // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_ev
        $.ajax({
          url: '<?php echo base_url("Datakriteria_ev/getData"); ?>',
          type: 'GET',
          data: { id_ev: id_ev }, // Menggunakan parameter id_ev
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_ev').val(response.id_ev);
            $('#uraian_aspek').val(response.uraian_aspek);
            $('#dok_pendukung2').val(response.dok_pendukung2);
            $('#jawaban1').val(response.jawaban1);
            $('#jawaban2').val(response.jawaban2);
            $('#uraian_jawaban1').val(response.uraian_jawaban1);
            $('#ket_pengisian1').html(response.ket_pengisian1);
            $('#ket_pengisian2').html(response.ket_pengisian2);
            $('#ket_pengisian3').html(response.ket_pengisian3);
            $('#catatan_ev').val(response.catatan_ev);
            // Default Konfirmasi = Ya (1) jika jawaban evaluasi belum pernah diisi
            // Jika jawaban2 kosong = data fresh, paksa Konfirmasi = Ya
            // Jika jawaban2 sudah ada = ikuti nilai perbaikan dari DB
            var konfirmasiVal = (response.jawaban2 === null || response.jawaban2 === '') ? '1' : response.perbaikan;
            $('#perbaikan').val(konfirmasiVal);
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
        var id_ev = $(this).data('id_ev'); // Menggunakan data-id_ev sebagai sumber id_ev
        // Memanggil fungsi showData dengan parameter id_ev
        showData(id_ev);
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      // Fungsi untuk mengambil dan menampilkan data pada modal
      function showDataSub(id_ev0) {
        // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_ev0
        $.ajax({
          url: '<?php echo base_url("Datasub_ev/getData"); ?>',
          type: 'GET',
          data: { id_ev0: id_ev0 }, // Menggunakan parameter id_ev0
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_ev0').val(response.id_ev0);
            $('#uraian_subkomponen').val(response.uraian_subkomponen);
            $('#dok_pendukung').val(response.dok_pendukung);
            $('#jawabanantara').val(response.jawabanantara);
            // Menampilkan Jawaban Akhir Unit (dihitung dinamis dari indikator unit)
            $('#jawaban0').val(response.jawabanantara_unit || '');
            $('#jawaban0ev').val(response.jawaban0ev);
            $('#uraian_jawaban0').val(response.uraian_jawaban0);
            $('#catatan_ev0').val(response.catatan_ev0);
            // Default Perlu Konfirmasi = Ya (1) jika jawaban evaluasi belum pernah diisi
            var konfirmasi0Val = (response.jawaban0ev === null || response.jawaban0ev === '') ? '1' : response.perbaikan0;
            $('#perbaikan0').val(konfirmasi0Val);
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
        var id_ev0 = $(this).data('id_ev0'); // Menggunakan data-id_ev0 sebagai sumber id_ev0
        // Memanggil fungsi showData dengan parameter id_ev0
        showDataSub(id_ev0);
      });
    });
  </script>



  <script>
    $(document).ready(function () {

      $.validator.addMethod("allowedValue", function (value, element, param) {
        return param.includes(parseInt(value, 10));
      }, "Jawaban hanya boleh 0, 30, 50, 60, 70, 80, 90, atau 100.");

      $.validator.addMethod("noLeadingZero", function (value, element) {
        return /^(?!0\d+)/.test(value);
      }, "Angka tidak boleh memiliki 0 di depannya.");

      $('#formkrit').validate({
        rules: {
          jawaban2: {
            required: true,
            digits: true,
            allowedValue: [0, 30, 50, 60, 70, 80, 90, 100],
            noLeadingZero: true
          }
        },
        messages: {
          jawaban2: {
            required: "Jawaban harus diisi!",
            digits: "Jawaban hanya boleh sesuai pilihan!",
            allowedValue: "Jawaban hanya boleh sesuai pilihan!",
            noLeadingZero: "Jawaban hanya boleh sesuai pilihan!"
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
      // Menambahkan metode validasi khusus untuk jawaban0
      $.validator.addMethod("allowedValue", function (value, element, param) {
        return param.includes(parseInt(value, 10));
      }, "Jawaban hanya boleh 0, 30, 50, 60, 70, 80, 90, atau 100.");

      $.validator.addMethod("noLeadingZero", function (value, element) {
        return /^(?!0\d+)/.test(value);
      }, "Angka tidak boleh memiliki 0 di depannya.");

      $('#formsub').validate({
        rules: {
          jawaban0ev: {
            required: true,
            digits: true,
            allowedValue: [0, 30, 50, 60, 70, 80, 90, 100],
            noLeadingZero: true
          }
        },
        messages: {
          jawaban0ev: {
            required: "Jawaban Akhir harus diisi!",
            digits: "Jawaban hanya boleh sesuai pilihan!",
            allowedValue: "Jawaban hanya boleh sesuai pilihan!",
            noLeadingZero: "Jawaban hanya boleh sesuai pilihan!"
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
    // Menangani perubahan pada jawaban antara
    $(document).ready(function () {
      $('#EditDataSub').on('shown.bs.modal', function () {
        $('#jawabanantara').on('change', function () {
          var jawabanantara = $(this).val();
          var jawaban0evDropdown = $('#jawaban0ev');
          var selectedJawaban0ev = $('#jawaban0ev').val();

          // Menghapus semua opsi jawaban akhir
          jawaban0evDropdown.empty();

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
            jawaban0evDropdown.append($('<option>', { value: value, text: text }));
          }

          // Menambahkan opsi jawaban akhir yang sesuai berdasarkan jawaban antara
          if (jawabanantara === 'AA') {
            jawaban0evDropdown.find('option[value!="100"]').attr('hidden', true);
          } else if (jawabanantara === 'A') {
            jawaban0evDropdown.find('option[value!="90"][value!="100"]').attr('hidden', true);
          } else if (jawabanantara === 'BB') {
            jawaban0evDropdown.find('option[value!="80"][value!="90"][value!="100"]').attr('hidden', true);
          } else if (jawabanantara === 'B') {
            jawaban0evDropdown.find('option[value!="70"]').attr('hidden', true);
          } else if (jawabanantara === 'CC') {
            jawaban0evDropdown.find('option[value!="60"]').attr('hidden', true);
          } else if (jawabanantara === 'C') {
            jawaban0evDropdown.find('option[value!="50"]').attr('hidden', true);
          } else if (jawabanantara === 'D') {
            jawaban0evDropdown.find('option[value!="30"]').attr('hidden', true);
          } else if (jawabanantara === 'E') {
            jawaban0evDropdown.find('option[value!="0"]').attr('hidden', true);
          }

          // Menetapkan nilai jawaban akhir pertama sebagai nilai default
          jawaban0evDropdown.val(selectedJawaban0ev);
        });
        // Memanggil perubahan acara saat halaman dimuat
        $('#jawabanantara').trigger('change');
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      // Function untuk mengambil dan menampilkan data pada modal
      function showDataKonfirmasi(id_ev) {
        // Mengirim permintaan AJAX ke controller dengan parameter id_ev
        $.ajax({
          url: '<?php echo base_url("Datakonfirmasi/getData"); ?>',
          type: 'GET',
          data: { id_ev: id_ev }, // Menggunakan parameter id_ev
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_ev2').val(response.id_ev);
            // Tampilkan modal
            $('#EditKonfirmasi').modal('show');
          },
          error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
          }
        });
      }

      // Event click pada link dengan class "open-modal2"
      $('.open-modal2').click(function (e) {
        e.preventDefault();
        // Mengambil id dari atribut data-id_ev
        var id_ev = $(this).data('id_ev'); // Menggunakan data-id_ev sebagai sumber id_ev
        // Memanggil fungsi showDataKonfirmasi dengan parameter id_ev
        /*showDataKonfirmasi(id_ev);*/
      });

      // Function untuk melakukan refresh pada modal setelah session id_ev di-set
      function refreshModal() {
        var id_ev = '<?php echo $this->session->userdata("id_ev"); ?>';
        // Cek apakah session id_ev sudah di-set
        if (id_ev != "") {
          // Memanggil fungsi showDataKonfirmasi dengan parameter id_ev
          showDataKonfirmasi(id_ev);
          // Reset session id_ev menjadi kosong setelah modal ditampilkan
          '<?php $this->session->unset_userdata("id_ev"); ?>';
        }
      }

      // Memanggil fungsi refreshModal saat halaman selesai di-load
      refreshModal();
    });
  </script>



  <script>
    function setSessionIdEv(id_ev) {
      // Kirim data id_ev ke controller menggunakan AJAX
      $.ajax({
        url: '<?php echo base_url("ev/set_userdata_session"); ?>', // Ganti dengan URL endpoint untuk mengatur userdata session di server
        type: 'POST',
        data: { id_ev: id_ev }, // Data yang akan dikirim ke controller
        success: function (response) {
          // Berhasil mengatur userdata session, lakukan sesuatu jika diperlukan
          location.reload();
        },
        error: function () {
          // Terjadi kesalahan saat mengatur userdata session
          alert('Terjadi kesalahan saat mengatur session.');
        }
      });
    }
  </script>




  <script>
    $(document).ready(function () {
      // Function untuk mengambil dan menampilkan data pada modal
      function showDataKonfirmasi0(id_ev0) {
        // Mengirim permintaan AJAX ke controller dengan parameter id_ev
        $.ajax({
          url: '<?php echo base_url("Datakonfirmasi0/getData"); ?>',
          type: 'GET',
          data: { id_ev0: id_ev0 }, // Menggunakan parameter id_ev
          dataType: 'json',
          success: function (response) {
            // Mengisikan data ke dalam elemen-elemen pada modal
            $('#id_ev02').val(response.id_ev0);
            // Tampilkan modal
            $('#EditKonfirmasi0').modal('show');
          },
          error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
          }
        });
      }

      // Event click pada link dengan class "open-modal2"
      $('.open-modal02').click(function (e) {
        e.preventDefault();
        // Mengambil id dari atribut data-id_ev
        var id_ev0 = $(this).data('id_ev0'); // Menggunakan data-id_ev sebagai sumber id_ev
        // Memanggil fungsi showDataKonfirmasi dengan parameter id_ev
        /*showDataKonfirmasi(id_ev);*/
      });

      // Function untuk melakukan refresh pada modal setelah session id_ev di-set
      function refreshModal() {
        var id_ev0 = '<?php echo $this->session->userdata("id_ev0"); ?>';
        // Cek apakah session id_ev sudah di-set
        if (id_ev0 != "") {
          // Memanggil fungsi showDataKonfirmasi dengan parameter id_ev
          showDataKonfirmasi0(id_ev0);
          // Reset session id_ev menjadi kosong setelah modal ditampilkan
          '<?php $this->session->unset_userdata("id_ev0"); ?>';
        }
      }

      // Memanggil fungsi refreshModal saat halaman selesai di-load
      refreshModal();
    });
  </script>



  <script>
    function setSessionIdEv0(id_ev0) {
      // Kirim data id_ev ke controller menggunakan AJAX
      $.ajax({
        url: '<?php echo base_url("ev/set_userdata_session0"); ?>', // Ganti dengan URL endpoint untuk mengatur userdata session di server
        type: 'POST',
        data: { id_ev0: id_ev0 }, // Data yang akan dikirim ke controller
        success: function (response) {
          // Berhasil mengatur userdata session, lakukan sesuatu jika diperlukan
          location.reload();
        },
        error: function () {
          // Terjadi kesalahan saat mengatur userdata session
          alert('Terjadi kesalahan saat mengatur session.');
        }
      });
    }
  </script>




  <script>
    $(document).ready(function () {
      // Aktifkan datetimepicker pada input field dengan id "datetimepicker"
      $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss', // Format tanggal dan waktu yang diinginkan
        icons: {
          time: 'fa fa-clock',
          date: 'fa fa-calendar',
          up: 'fa fa-chevron-up',
          down: 'fa fa-chevron-down',
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-calendar-check-o',
          clear: 'fa fa-trash',
          close: 'fa fa-times'
        }
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      // Aktifkan datetimepicker pada input field dengan id "datetimepicker"
      $('#datetimepicker0').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss', // Format tanggal dan waktu yang diinginkan
        icons: {
          time: 'fa fa-clock',
          date: 'fa fa-calendar',
          up: 'fa fa-chevron-up',
          down: 'fa fa-chevron-down',
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-calendar-check-o',
          clear: 'fa fa-trash',
          close: 'fa fa-times'
        }
      });
    });
  </script>




  <!-- Modal Komentar -->
  <div class="modal fade" id="modalKomentar" tabindex="-1" role="dialog" aria-labelledby="modalKomentarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalKomentarLabel">Komentar Evaluasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="breadcrumb-komentar" class="mb-3 text-info small"
            style="border-bottom: 1px solid #dee2e6; padding-bottom: 5px;"></div>
          <div id="revision-notice-box" class="revision-notice">
            <i class="fas fa-exclamation-triangle"></i> Bagian ini perlu direvisi sesuai komentar evaluator
          </div>
          <div id="komentar-history" style="max-height: 400px; overflow-y: auto; padding: 10px; background: #f4f6f9;">
            <!-- History komentar akan dimuat di sini -->
          </div>
          <hr>
          <form id="formKomentar">
            <input type="hidden" name="komponen" id="kom_id">
            <input type="hidden" name="subkomponen" id="subkom_id">
            <input type="hidden" name="subkomponen_kode" id="subkom_kode">
            <input type="hidden" name="indikator" id="ind_id">
            <input type="hidden" name="target_user" id="target_user_id">
            <input type="hidden" name="section" id="section_name">
            <input type="hidden" name="label_lokasi" id="label_lokasi_val">
            <input type="hidden" name="parent_id" id="parent_id_val">

            <div class="form-group">
              <label for="isi_komentar">Tulis Komentar:</label>
              <textarea name="komentar" id="isi_komentar" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary float-right">Kirim Komentar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      // Saat tombol komentar diklik
      $('.btn-komentar').on('click', function () {
        const komponen = $(this).data('komponen');
        const subkomponen = $(this).data('subkomponen');
        const subkomKode = $(this).data('subkomponen-kode');
        const indikator = $(this).data('indikator');
        const section = $(this).data('section');
        const komName = $(this).data('komponen-name');
        const subkomName = $(this).data('subkomponen-name');
        const indName = $(this).data('indikator-name') || '';

        $('#kom_id').val(komponen);
        $('#subkom_id').val(subkomponen);
        $('#subkom_kode').val(subkomKode);
        $('#ind_id').val(indikator);
        $('#section_name').val(section);

        let breadcrumb = `Evaluasi Inspektorat > Pelaporan Kinerja > ${komName} > ${subkomName}`;
        if (indName) breadcrumb += ` > ${indName}`;

        $('#label_lokasi_val').val(breadcrumb);
        $('#parent_id_val').val(''); // Reset parent_id for new threads
        $('#breadcrumb-komentar').html(`<strong>Komentar pada:</strong> ${breadcrumb}`);
        $('#revision-notice-box').hide();

        const currentUserRole = '<?php echo $this->session->userdata("id_role"); ?>';
        const isSubkomponen = (currentUserRole == 1 || currentUserRole == 5);

        if (isSubkomponen) {
          // If subkomponen, target is the Evaluator (usually role 3/4/7)
          // For now, let's assume we target the evaluator who assigned this or has access.
          // A better way is to target the specific evaluator from the history, but as a fallback:
          $.ajax({
            url: '<?php echo base_url("auth2/get_evaluator_ajax"); ?>', // You might need to implement this
            type: 'GET',
            success: function (user) {
              if (user && user.id_user) $('#target_user_id').val(user.id_user);
            }
          });
        } else {
          // If evaluator, target is the Unit user
          const target_unit = '<?php echo $this->session->userdata("id_unit"); ?>';
          $.ajax({
            url: '<?php echo base_url("auth2/get_user_by_unit_ajax"); ?>',
            type: 'GET',
            data: { id_unit: target_unit },
            dataType: 'json',
            success: function (user) {
              if (user) {
                $('#target_user_id').val(user.id_user);
              }
            }
          });
        }

        loadKomentar(indikator, subkomponen);
        $('#modalKomentar').modal('show');
      });

      // Fungsi untuk memuat history komentar
      function loadKomentar(indikator_id, subkomponen_id = null) {
        $.ajax({
          url: '<?php echo base_url("ev/get_komentar"); ?>',
          type: 'GET',
          data: {
            indikator_id: indikator_id,
            subkomponen_id: subkomponen_id
          },
          dataType: 'json',
          success: function (data) {
            let html = '';
            if (data.length > 0) {
              // Set parent_id as the first comment in the thread
              $('#parent_id_val').val(data[0].id);

              const currentUserRole = '<?php echo $this->session->userdata("id_role"); ?>';
              const isSubkomponen = (currentUserRole == 1 || currentUserRole == 5);

              if (isSubkomponen) {
                // If subkomponen is replying, target is the evaluator who started the thread
                data.forEach(function (k) {
                  if (k.pengirim_role === 'evaluator') {
                    $('#target_user_id').val(k.evaluator_id);
                  }
                });
              }

              data.forEach(function (kom) {
                const isMe = kom.evaluator_id == '<?php echo $this->session->userdata("id_user"); ?>';

                // Get targetKomentarId from URL
                const urlParams = new URLSearchParams(window.location.search);
                const targetKomentarId = urlParams.get('comment_id') || urlParams.get('komentar');
                const isTargeted = targetKomentarId == kom.id;

                if (isTargeted) {
                  $('#breadcrumb-komentar').html(`<strong>Komentar pada:</strong> ${kom.label_lokasi || 'N/A'}`);
                  $('#revision-notice-box').show();
                }

                html += `
                            <div class="direct-chat-msg ${isMe ? 'right' : ''}" id="komentar-${kom.id}">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-${isMe ? 'right' : 'left'}" style="font-size: 0.85rem; color: #6c757d;">
                                      ${kom.sender_name || 'User'} 
                                      <small class="badge badge-light text-muted border">${kom.pengirim_role === 'evaluator' ? 'Evaluator' : 'Subkomponen'}</small>
                                    </span>
                                    <span class="direct-chat-timestamp float-${isMe ? 'left' : 'right'}" style="font-size: 0.75rem; color: #adb5bd;">${kom.created_at}</span>
                                </div>
                                <div class="direct-chat-text" style="background-color: ${isMe ? '#d2d6de' : '#f8f9fa'}; border: 1px solid ${isMe ? '#d2d6de' : '#d6d8db'}; color: #2E2E2E; ${isTargeted ? 'border: 2px solid #ffc107; background-color: #fff9e6;' : ''}">
                                    ${kom.isi_komentar}
                                </div>
                            </div>
                        `;
              });
            } else {
              html = '<p class="text-center text-muted">Belum ada komentar.</p>';
            }
            $('#komentar-history').html(html);
            $('#komentar-history').scrollTop($('#komentar-history')[0].scrollHeight);

            // Flash targeted comment if exists
            const urlParams = new URLSearchParams(window.location.search);
            const targetKomentarId = urlParams.get('comment_id') || urlParams.get('komentar');
            const hash = window.location.hash;
            const finalTargetId = targetKomentarId || (hash.startsWith('#komentar-') ? hash.replace('#komentar-', '') : null);

            if (finalTargetId) {
              const el = $(`#komentar-${finalTargetId}`);
              if (el.length) {
                setTimeout(() => {
                  el[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                  el.addClass('flash-soft');
                }, 300);
              }
            }
          }
        });
      }

      // Submit komentar
      $('#formKomentar').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
          url: '<?php echo base_url("ev/simpan_komentar"); ?>',
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              $('#isi_komentar').val('');
              loadKomentar($('#ind_id').val());
              toastr.success('Komentar berhasil dikirim');
            }
          }
        });
      });
    });
  </script>

  <script>
    (function focusToRedirection() {
      const focusSub = "<?php echo isset($focus_sub) ? $focus_sub : ''; ?>";
      const focusIndikator = "<?php echo isset($focus_indikator) ? $focus_indikator : ''; ?>";
      const urlParams = new URLSearchParams(window.location.search);
      const targetKomentarId = urlParams.get('comment_id') || urlParams.get('komentar');
      let attempt = 0;

      function tryScroll() {
        let targetRow;

        if (focusIndikator && focusIndikator !== '0') {
          targetRow = $('#indikator-' + focusIndikator);
        } else if (focusSub) {
          // Escape dots for jQuery selector
          const escapedSub = focusSub.replace(/\./g, '\\.');
          targetRow = $('#subkomponen-' + escapedSub);

          if (!targetRow || !targetRow.length) {
            targetRow = $('tr[data-kode="' + focusSub + '"]');
          }
        }

        if (targetRow && targetRow.length) {
          // 1. Auto expand parents
          const parentKomponenId = targetRow.data('komponen') || targetRow.closest('tr').prevAll('tr[id^="subkomponen-"]').first().data('komponen');
          if (parentKomponenId) {
            const parentKomponen = $(`tr[elementId="${parentKomponenId}"]`);
            if (parentKomponen.attr('aria-expanded') === 'false') {
              parentKomponen.trigger('click');
            }
          }

          if (focusIndikator && focusIndikator !== '0') {
            const parentSubkomponenElementId = targetRow.data('subkomponen');
            const parentSubkomponen = $(`tr[elementId="${parentSubkomponenElementId}"]`);
            if (parentSubkomponen.length && parentSubkomponen.attr('aria-expanded') === 'false') {
              parentSubkomponen.trigger('click');
            }
          }

          // 2. Scroll and Highlight
          setTimeout(() => {
            targetRow[0].scrollIntoView({
              behavior: 'smooth',
              block: 'center'
            });

            targetRow.addClass('blink-soft');

            // 3. Automatically open comment modal
            if (targetKomentarId || focusIndikator || focusSub) {
              const btnKomentar = targetRow.find('.btn-komentar');
              if (btnKomentar.length) {
                setTimeout(() => {
                  btnKomentar.trigger('click');
                }, 800);
              }
            }
          }, 600); // Wait for expansion animations
          return;
        }

        if (attempt < 15) {
          attempt++;
          setTimeout(tryScroll, 400);
        }
      }

      if (focusSub || focusIndikator || targetKomentarId) {
        tryScroll();
      }
    })();
  </script>

  <div id="komentar"></div>
</body>

</html>