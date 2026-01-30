<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Semua Notifikasi</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url('notification/mark_all_read'); ?>" class="btn btn-secondary btn-sm">
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

            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 20%">Judul</th>
                                <th style="width: 40%">Pesan</th>
                                <th>Waktu</th>
                                <th style="width: 15%" class="text-center">Status</th>
                                <th style="width: 10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($notifications)): ?>
                                <?php $no = 1;
                                foreach ($notifications as $notif): ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++; ?>
                                        </td>
                                        <td>
                                            <strong>
                                                <?php echo htmlspecialchars($notif->judul); ?>
                                            </strong>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($notif->pesan); ?>
                                            <br />
                                            <small class="text-muted">
                                                By:
                                                <?php echo htmlspecialchars($notif->sender_name); ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php echo date('d M Y, H:i', strtotime($notif->created_at)); ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($notif->is_read): ?>
                                                <span class="badge badge-success">Terbaca</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Belum Terbaca</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('notification/buka_notifikasi/' . $notif->id); ?>"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-folder"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada notifikasi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>