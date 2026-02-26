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
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard/index">Home</a></li>
            <li class="breadcrumb-item active">Manajemen User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('success'); ?>
      </div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('error'); ?>
      </div>
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
                  <input type="text" name="username" class="form-control" placeholder="Contoh: UK1 atau evaluator2" required>
                  <small class="text-muted">Boleh mengandung huruf, angka, titik, underscore, atau dash.</small>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                </div>
                <div class="form-group">
                  <label>Role</label>
                  <select name="id_role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="13">Tim Evaluator</option>
                    <option value="14">Unit Kerja</option>
                  </select>
                </div>
                <div class="form-group" id="unit_group">
                  <label>Unit Kerja <span class="text-muted">(diperlukan untuk Unit Kerja)</span></label>
                  <select name="id_unit" class="form-control select2" id="select_unit" style="width:100%">
                    <option value="">-- Pilih Unit Kerja --</option>
                    <?php foreach($unit_list as $u): ?>
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
                    <?php foreach($evaluator_list as $ev): ?>
                    <option value="<?php echo $ev['id_user'] ?>"><?php echo htmlspecialchars($ev['nm_user'].' ('.$ev['username'].')') ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Unit Kerja yang Ditugaskan</label>
                  <select name="id_unit" class="form-control select2" style="width:100%" required>
                    <option value="">-- Pilih Unit Kerja --</option>
                    <?php foreach($unit_list as $u): ?>
                    <option value="<?php echo $u['id_unit'] ?>"><?php echo htmlspecialchars($u['nm_unit']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="number" name="tahun" class="form-control" value="<?php echo $this->session->userdata('tahun') ?>" required>
                </div>
                <button type="submit" class="btn btn-info btn-block">
                  <i class="fas fa-link mr-1"></i> Assign Evaluator
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
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $role_map = [
                    9  => '<span class="badge badge-danger">Admin</span>',
                    10 => '<span class="badge badge-warning">Ketua Tim</span>',
                    11 => '<span class="badge badge-warning">P. Teknis</span>',
                    12 => '<span class="badge badge-warning">P. Mutu</span>',
                    13 => '<span class="badge badge-info">Tim Evaluator</span>',
                    14 => '<span class="badge badge-success">Unit Kerja</span>',
                  ];
                  $no = 1;
                  foreach($user_list as $u):
                    $role_badge = isset($role_map[$u['id_role']]) ? $role_map[$u['id_role']] : '<span class="badge badge-secondary">Role '.$u['id_role'].'</span>';
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo htmlspecialchars($u['nm_user']) ?></td>
                    <td><code><?php echo htmlspecialchars($u['username']) ?></code></td>
                    <td><?php echo $role_badge ?></td>
                    <td><?php echo htmlspecialchars($u['nm_unit'] ?? '-') ?></td>
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
                  </tr>
                </thead>
                <tbody>
                  <?php $no2 = 1; foreach($assignment_list as $a): ?>
                  <tr>
                    <td><?php echo $no2++ ?></td>
                    <td><?php echo htmlspecialchars($a['nm_user'] ?? '-') ?></td>
                    <td><?php echo htmlspecialchars($a['nm_unit'] ?? '-') ?></td>
                    <td><?php echo $a['tahun'] ?></td>
                    <td><?php echo htmlspecialchars($a['created_by'] ?? '-') ?></td>
                  </tr>
                  <?php endforeach; ?>
                  <?php if(empty($assignment_list)): ?>
                  <tr><td colspan="5" class="text-center text-muted">Belum ada penugasan</td></tr>
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

<script>
$(document).ready(function(){
  // Init select2
  $('.select2').select2();

  // Tampilkan/sembunyikan pilihan unit berdasarkan role yang dipilih
  $('select[name="id_role"]').on('change', function(){
    if($(this).val() == '14'){
      $('#unit_group').show();
      $('#select_unit').prop('required', true);
    } else {
      $('#unit_group').hide();
      $('#select_unit').prop('required', false);
    }
  }).trigger('change');
});
</script>
