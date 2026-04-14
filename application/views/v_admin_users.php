<?php
/* Halaman Manajemen User untuk Admin (role 9) */
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manajemen User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard/index">Home</a></li>
            <li class="breadcrumb-item active">Manajemen User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <?php if ($this->session->flashdata('success')): ?>
        <script>window._flashSuccess = <?php echo json_encode($this->session->flashdata('success')); ?>;</script>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
        <script>window._flashError = <?php echo json_encode($this->session->flashdata('error')); ?>;</script>
      <?php endif; ?>

      <div class="row">
        <!-- Form Buat User Baru -->
        <div class="col-md-4">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-user-plus mr-1"></i> Buat User Baru</h3>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('users/create_user') ?>" method="post">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" name="nm_user" class="form-control" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Contoh: UK1 atau evaluator2"
                    required>
                  <small class="text-muted">Boleh mengandung huruf, angka, titik, underscore, atau dash.</small>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required
                    minlength="6">
                </div>
                <div class="form-group">
                  <label>Role</label>
                  <select name="id_role" id="create_role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="13">Tim Evaluator</option>
                    <option value="14">Unit Kerja</option>
                  </select>
                </div>
                <div class="form-group" id="unit_group" style="display:none">
                  <label>Unit Kerja <span class="text-muted">(wajib untuk Unit Kerja)</span></label>
                  <select name="id_unit" class="form-control select2" id="select_unit" style="width:100%">
                    <option value="">-- Pilih Unit Kerja --</option>
                    <?php foreach ($unit_list as $u): ?>
                      <option value="<?php echo $u['id_unit'] ?>"><?php echo htmlspecialchars($u['nm_unit']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  <i class="fas fa-save mr-1"></i> Simpan User
                </button>
              </form>
            </div>
          </div>

          <!-- Form Assign Evaluator ke Unit Kerja -->
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-link mr-1"></i> Assign Evaluator ke Unit Kerja</h3>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('users/assign_evaluator') ?>" method="post">
                <div class="form-group">
                  <label>Tim Evaluator</label>
                  <select name="id_user" class="form-control select2" style="width:100%" required>
                    <option value="">-- Pilih Evaluator --</option>
                    <?php foreach ($evaluator_list as $ev): ?>
                      <option value="<?php echo $ev['id_user'] ?>">
                        <?php echo htmlspecialchars($ev['nm_user'] . ' (' . $ev['username'] . ')') ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Unit Kerja yang Ditugaskan</label>
                  <select name="id_unit" class="form-control select2" style="width:100%" required>
                    <option value="">-- Pilih Unit Kerja --</option>
                    <?php foreach ($unit_list as $u): ?>
                      <option value="<?php echo $u['id_unit'] ?>"><?php echo htmlspecialchars($u['nm_unit']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="number" name="tahun" class="form-control"
                    value="<?php echo $this->session->userdata('tahun') ?>" required>
                </div>
                <button type="submit" class="btn btn-info btn-block">
                  <i class="fas fa-link mr-1"></i> Assign Evaluator
                </button>
              </form>
            </div>
          </div>

          <!-- Form Reset Data PM -->
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-trash-restore mr-1"></i> Reset Data PM Khusus</h3>
            </div>
            <div class="card-body">
              <form id="formResetPM" action="<?php echo base_url('dokumen/reset_data') ?>" method="post">
                <div class="form-group">
                  <label>Unit Kerja</label>
                  <select name="id_unit" class="form-control select2" style="width:100%" required>
                    <option value="">-- Pilih Unit Kerja --</option>
                    <?php foreach ($unit_list as $u): ?>
                      <option value="<?php echo $u['id_unit'] ?>"><?php echo htmlspecialchars($u['nm_unit']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Acuan</label>
                  <input type="number" name="tahun" class="form-control"
                    value="<?php echo $this->session->userdata('tahun') ?>" required>
                </div>
                <div class="alert alert-warning p-2 text-sm mt-2 mb-3">
                  Akan menghapus <b>ta_pm, ta_pm0, ta_dokumen</b> unit ini sehingga lembar PM dikosongkan.
                </div>
                <button type="button" id="btnResetPM" class="btn btn-danger btn-block">
                  <i class="fas fa-exclamation-triangle mr-1"></i> Eksekusi Reset PM
                </button>
              </form>
            </div>
          </div>

          <!-- Form Reset Data EV -->
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-trash-restore mr-1"></i> Reset Data EV Khusus</h3>
            </div>
            <div class="card-body">
              <form id="formResetEV" action="<?php echo base_url('ev/reset_data_ev') ?>" method="post">
                <div class="form-group">
                  <label>Unit Kerja</label>
                  <select name="id_unit" class="form-control select2" style="width:100%" required>
                    <option value="">-- Pilih Unit Kerja --</option>
                    <?php foreach ($unit_list as $u): ?>
                      <option value="<?php echo $u['id_unit'] ?>"><?php echo htmlspecialchars($u['nm_unit']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Acuan</label>
                  <input type="number" name="tahun" class="form-control"
                    value="<?php echo $this->session->userdata('tahun') ?>" required>
                </div>
                <div class="alert alert-warning p-2 text-sm mt-2 mb-3">
                  Akan menghapus <b>ta_ev, ta_ev0, ta_dok_ev</b> unit ini sehingga lembar EV dikosongkan.
                </div>
                <button type="button" id="btnResetEV" class="btn btn-danger btn-block">
                  <i class="fas fa-exclamation-triangle mr-1"></i> Eksekusi Reset EV
                </button>
              </form>
            </div>
          </div>

        </div>

        <!-- Tabel Daftar User -->
        <div class="col-md-8">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-users mr-1"></i> Daftar User</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-bordered table-striped table-sm">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Unit Kerja</th>
                    <th style="width:110px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $role_map = [
                    1 => '<span class="badge badge-secondary">Unit Kerja (Role Lama)</span>',
                    2 => '<span class="badge badge-secondary">Pembina (Role Lama)</span>',
                    3 => '<span class="badge badge-secondary">Evaluator (Role Lama)</span>',
                    4 => '<span class="badge badge-secondary">Admin (Role Lama)</span>',
                    5 => '<span class="badge badge-secondary">Admin Unit Kerja (Role Lama)</span>',
                    6 => '<span class="badge badge-secondary">Admin Pembina (Role Lama)</span>',
                    7 => '<span class="badge badge-secondary">Admin Evaluator (Role Lama)</span>',
                    8 => '<span class="badge badge-secondary">No Role (Role Lama)</span>',
                    9 => '<span class="badge badge-danger">Admin</span>',
                    10 => '<span class="badge badge-warning">Ketua Tim</span>',
                    11 => '<span class="badge badge-warning">P. Teknis</span>',
                    12 => '<span class="badge badge-warning">P. Mutu</span>',
                    13 => '<span class="badge badge-info">Tim Evaluator</span>',
                    14 => '<span class="badge badge-success">Unit Kerja</span>',
                  ];
                  $no = 1;
                  foreach ($user_list as $u):
                    $role_badge = isset($role_map[$u['id_role']]) ? $role_map[$u['id_role']] : '<span class="badge badge-secondary">Role ' . $u['id_role'] . '</span>';
                    $can_edit = in_array((int) $u['id_role'], [13, 14]);
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo htmlspecialchars($u['nm_user']) ?></td>
                      <td><code><?php echo htmlspecialchars($u['username']) ?></code></td>
                      <td><?php echo $role_badge ?></td>
                      <td><?php echo htmlspecialchars($u['nm_unit'] ?? '-') ?></td>
                      <td>
                        <?php if ($can_edit): ?>
                          <button type="button" class="btn btn-xs btn-warning btn-edit-user"
                            data-id="<?php echo $u['id_user'] ?>"
                            data-nama="<?php echo htmlspecialchars($u['nm_user'], ENT_QUOTES) ?>"
                            data-username="<?php echo htmlspecialchars($u['username'], ENT_QUOTES) ?>" title="Edit">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button type="button" class="btn btn-xs btn-danger btn-delete-user"
                            data-id="<?php echo $u['id_user'] ?>"
                            data-username="<?php echo htmlspecialchars($u['username'], ENT_QUOTES) ?>"
                            title="Hapus / Nonaktifkan">
                            <i class="fas fa-trash"></i>
                          </button>
                        <?php else: ?>
                          <span class="text-muted small">—</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Tabel Penugasan Evaluator -->
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-list mr-1"></i> Penugasan Evaluator ke Unit Kerja</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-bordered table-sm">
                <thead class="bg-info text-white">
                  <tr>
                    <th>#</th>
                    <th>Evaluator</th>
                    <th>Unit Kerja</th>
                    <th>Tahun</th>
                    <th>Dibuat oleh</th>
                    <th style="width:70px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no2 = 1;
                  foreach ($assignment_list as $a): ?>
                    <tr>
                      <td><?php echo $no2++ ?></td>
                      <td><?php echo htmlspecialchars($a['nm_user'] ?? '-') ?></td>
                      <td><?php echo htmlspecialchars($a['nm_unit'] ?? '-') ?></td>
                      <td><?php echo $a['tahun'] ?></td>
                      <td><?php echo htmlspecialchars($a['created_by'] ?? '-') ?></td>
                      <td>
                        <button type="button" class="btn btn-xs btn-danger btn-remove-assign"
                          data-id="<?php echo $a['id'] ?>"
                          data-info="<?php echo htmlspecialchars(($a['nm_user'] ?? '-') . ' → ' . ($a['nm_unit'] ?? '-'), ENT_QUOTES) ?>"
                          title="Cabut Penugasan">
                          <i class="fas fa-unlink"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php if (empty($assignment_list)): ?>
                    <tr>
                      <td colspan="6" class="text-center text-muted">Belum ada penugasan</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!-- ===== Modal Edit User ===== -->
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel">
  <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('users/edit_user') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="modalEditUserLabel"><i class="fas fa-edit mr-1"></i> Edit User</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_user" id="edit_id_user">
          <div class="form-group">
            <label>Username</label>
            <input type="text" id="edit_username_display" class="form-control" disabled>
            <small class="text-muted">Username tidak dapat diubah.</small>
          </div>
          <div class="form-group">
            <label>Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nm_user" id="edit_nm_user" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password Baru <span class="text-muted">(kosongkan jika tidak ingin mengubah)</span></label>
            <input type="password" name="password" id="edit_password" class="form-control" minlength="6"
              placeholder="Min. 6 karakter">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- ===== Form Hapus User (hidden) ===== -->
<form id="formDeleteUser" action="<?php echo base_url('users/delete_user') ?>" method="post" style="display:none">
  <input type="hidden" name="id_user" id="delete_id_user">
</form>

<!-- ===== Form Cabut Penugasan (hidden) ===== -->
<form id="formRemoveAssign" action="<?php echo base_url('users/remove_assignment') ?>" method="post"
  style="display:none">
  <input type="hidden" name="id_assignment" id="remove_id_assignment">
</form>

<script>
  // Semua JS dijalankan setelah window.load agar jQuery & Bootstrap sudah pasti tersedia
  window.addEventListener('load', function () {

    // === Tampilkan Toastr dari flashdata PHP ===
    if (window._flashSuccess) toastr.success(window._flashSuccess);
    if (window._flashError) toastr.error(window._flashError);

    // === Init Select2 ===
    if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
      $('.select2').select2();
    }

    // === Tombol Edit User — isi modal lalu tampilkan ===
    document.querySelectorAll('.btn-edit-user').forEach(function (btn) {
      btn.addEventListener('click', function () {
        document.getElementById('edit_id_user').value = this.dataset.id;
        document.getElementById('edit_nm_user').value = this.dataset.nama;
        document.getElementById('edit_username_display').value = this.dataset.username;
        document.getElementById('edit_password').value = '';
        if (typeof $ !== 'undefined') {
          $('#modalEditUser').modal('show');
        }
      });
    });

    // === Tombol Hapus User — SweetAlert2 konfirmasi ===
    document.querySelectorAll('.btn-delete-user').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = this.dataset.id;
        var uname = this.dataset.username;
        Swal.fire({
          title: 'Hapus User?',
          html: 'User <b>' + uname + '</b> akan dihapus permanen.<br>Tindakan ini tidak dapat dibatalkan.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e3342f',
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then(function (result) {
          if (result.isConfirmed) {
            document.getElementById('delete_id_user').value = id;
            document.getElementById('formDeleteUser').submit();
          }
        });
      });
    });

    // === Tombol Cabut Penugasan — SweetAlert2 konfirmasi ===
    document.querySelectorAll('.btn-remove-assign').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = this.dataset.id;
        var info = this.dataset.info;
        Swal.fire({
          title: 'Cabut Penugasan?',
          html: 'Penugasan berikut akan dihapus:<br><b>' + info + '</b>',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#e3342f',
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="fas fa-unlink"></i> Ya, Cabut!',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then(function (result) {
          if (result.isConfirmed) {
            document.getElementById('remove_id_assignment').value = id;
            document.getElementById('formRemoveAssign').submit();
          }
        });
      });
    });

    // === Role select → tampilkan/sembunyikan pilihan unit (form Buat User) ===
    var createRole = document.getElementById('create_role');
    var unitGroup = document.getElementById('unit_group');
    var selectUnit = document.getElementById('select_unit');
    if (createRole && unitGroup) {
      createRole.addEventListener('change', function () {
        if (this.value === '14') {
          unitGroup.style.display = 'block';
          if (selectUnit) selectUnit.required = true;
        } else {
          unitGroup.style.display = 'none';
          if (selectUnit) selectUnit.required = false;
        }
      });
    }

    // === Tombol Reset PM — SweetAlert2 konfirmasi ===
    var btnResetPM = document.getElementById('btnResetPM');
    if (btnResetPM) {
      btnResetPM.addEventListener('click', function () {
        var form = document.getElementById('formResetPM');
        var unit = form.querySelector('[name="id_unit"]');
        var tahun = form.querySelector('[name="tahun"]');
        if (!unit.value || !tahun.value) {
          Swal.fire('Perhatian', 'Pilih Unit Kerja dan isi Tahun terlebih dahulu.', 'warning');
          return;
        }
        var unitText = unit.options[unit.selectedIndex].text;
        Swal.fire({
          title: '⚠️ Reset Data PM?',
          html: 'Anda akan mereset data <b>Penilaian Mandiri</b> untuk:<br><br>' +
                '<b>Unit:</b> ' + unitText + '<br><b>Tahun:</b> ' + tahun.value +
                '<br><br><span class="text-danger">Seluruh isian akan dihapus permanen dan tidak bisa dikembalikan!</span>',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e3342f',
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="fas fa-trash"></i> Ya, Reset PM!',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then(function (result) {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    }

    // === Tombol Reset EV — SweetAlert2 konfirmasi ===
    var btnResetEV = document.getElementById('btnResetEV');
    if (btnResetEV) {
      btnResetEV.addEventListener('click', function () {
        var form = document.getElementById('formResetEV');
        var unit = form.querySelector('[name="id_unit"]');
        var tahun = form.querySelector('[name="tahun"]');
        if (!unit.value || !tahun.value) {
          Swal.fire('Perhatian', 'Pilih Unit Kerja dan isi Tahun terlebih dahulu.', 'warning');
          return;
        }
        var unitText = unit.options[unit.selectedIndex].text;
        Swal.fire({
          title: '⚠️ Reset Data EV?',
          html: 'Anda akan mereset data <b>Evaluasi Inspektorat</b> untuk:<br><br>' +
                '<b>Unit:</b> ' + unitText + '<br><b>Tahun:</b> ' + tahun.value +
                '<br><br><span class="text-danger">Seluruh jawaban evaluator akan dihapus permanen dan tidak bisa dikembalikan!</span>',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e3342f',
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="fas fa-trash"></i> Ya, Reset EV!',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then(function (result) {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    }

  });
</script>