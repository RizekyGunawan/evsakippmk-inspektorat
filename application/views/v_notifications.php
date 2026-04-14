<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Semua Notifikasi</h1>
                    <?php if (!empty($unread_count)): ?>
                        <span class="badge badge-warning"><?php echo $unread_count; ?> belum dibaca</span>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url('notification/mark_all_read'); ?>"
                       class="btn btn-secondary btn-sm"
                       onclick="return confirm('Tandai semua sebagai terbaca?')">
                        <i class="fas fa-check-double"></i> Tandai Semua Terbaca
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bell mr-1"></i>
                        Total: <?php echo $total; ?> notifikasi
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 20%">Judul</th>
                                <th style="width: 40%">Pesan</th>
                                <th>Waktu</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($notifications)): ?>
                                <?php
                                // Hitung nomor urut berdasarkan halaman saat ini
                                $start_no = ($current_page - 1) * $per_page + 1;
                                foreach ($notifications as $notif):
                                ?>
                                    <tr id="row-notif-<?php echo $notif->id; ?>"
                                        class="<?php echo !$notif->is_read ? 'table-warning' : ''; ?>">
                                        <td><?php echo $start_no++; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($notif->judul); ?></strong>
                                            <?php if (!$notif->is_read): ?>
                                                <span class="badge badge-warning ml-1">Baru</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($notif->pesan); ?>
                                            <?php if (!empty($notif->sender_name)): ?>
                                                <br />
                                                <small class="text-muted">
                                                    <i class="fas fa-user mr-1"></i>
                                                    <?php echo htmlspecialchars($notif->sender_name); ?>
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo date('d M Y, H:i', strtotime($notif->created_at)); ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($notif->is_read): ?>
                                                <span class="badge badge-success">Terbaca</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Belum Dibaca</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('notification/buka_notifikasi/' . $notif->id); ?>"
                                               class="btn btn-primary btn-sm mr-1"
                                               title="Lihat detail">
                                                <i class="fas fa-folder-open"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm btn-hapus-notif"
                                                    data-id="<?php echo $notif->id; ?>"
                                                    title="Hapus notifikasi ini">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-bell-slash fa-2x text-muted mb-2 d-block"></i>
                                        Belum ada notifikasi.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($pagination)): ?>
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            <?php echo $pagination; ?>
                        </div>
                        <small class="text-muted">
                            Halaman <?php echo $current_page; ?> —
                            menampilkan <?php echo count($notifications); ?> dari <?php echo $total; ?> notifikasi
                        </small>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
</div>

<script>
// Hapus notifikasi via AJAX tanpa reload halaman
document.querySelectorAll('.btn-hapus-notif').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var notifId = this.getAttribute('data-id');
        var row     = document.getElementById('row-notif-' + notifId);

        if (!confirm('Hapus notifikasi ini?')) return;

        var btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        fetch('<?php echo base_url('notification/delete/'); ?>' + notifId, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.status === 'success') {
                // Animasi hapus baris
                row.style.transition = 'opacity 0.3s';
                row.style.opacity    = '0';
                setTimeout(function () { row.remove(); }, 300);

                // Update badge unread jika ada
                var badge = document.getElementById('notif-count');
                if (badge) {
                    badge.textContent = data.unread_count;
                    badge.style.display = data.unread_count > 0 ? 'inline' : 'none';
                }
            } else {
                alert('Gagal menghapus notifikasi.');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-trash"></i>';
            }
        })
        .catch(function () {
            alert('Terjadi kesalahan. Coba lagi.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-trash"></i>';
        });
    });
});
</script>