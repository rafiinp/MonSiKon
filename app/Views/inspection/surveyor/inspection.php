<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Inspection Management | MonSiKon</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">MonSiKon</a></li>
                            <li class="breadcrumb-item active">Inspections</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inspection Management</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <?php if (session()->get('role') == 'super_admin' || session()->get('role') == 'admin') { ?>
                                    <a href="<?= site_url('inspection/schedule') ?>" class="btn btn-primary mb-2">
                                        <i class="mdi mdi-calendar-plus me-2"></i> Schedule New Inspection
                                    </a>
                                <?php } ?>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="inspection-datatable">
                                <thead>
                                    <tr>
                                        <th>Container Number</th>
                                        <th>Surveyor</th>
                                        <th>Scheduled Date</th>
                                        <th>Container Code</th>
                                        <th>Status</th>
                                        <th>Inspection Result</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($inspections as $inspection): ?>
    <tr>
        <td><?= $inspection->container_number ?? 'N/A' ?></td>
        <td><?= $inspection->surveyor_name ?? 'N/A' ?></td>
        <td><?= $inspection->scheduled_date ?? 'N/A' ?></td>
        <td>
            <?php if (!empty($inspection->container_code)): ?>
                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#containerCodeModal<?= $inspection->id_inspection ?>">
                    View Code
                </button>
            <?php else: ?>
                <span class="text-muted">No code scanned</span>
            <?php endif; ?>
        </td>
        <td>
            <?php 
            $statusClass = '';
            switch ($inspection->status) {
                case 'pending':
                    $statusClass = 'badge bg-warning';
                    break;
                case 'completed':
                    $statusClass = 'badge bg-success';
                    break;
                default:
                    $statusClass = '';
                    break;
            }
            ?>
            <span class="<?= $statusClass ?>">
                <?= ucfirst($inspection->status) ?>
            </span>
        </td>
        <td>
            <?php if (!empty($inspection->result)): ?>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#inspectionResultModal<?= $inspection->id_inspection ?>">
                    View Result
                </button>
            <?php else: ?>
                <span class="text-muted">No result</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($inspection->status == 'pending'): ?>
                <a href="<?= site_url('inspection/edit/'.$inspection->id_inspection) ?>" 
                   class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i> Edit
                </a>
            <?php endif; ?>
            <?php if (!empty($inspection->inspection_photo)): ?>
                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#inspectionPhotoModal<?= $inspection->id_inspection ?>">
                    <i class="mdi mdi-image"></i> View Photo
                </button>
            <?php endif; ?>
        </td>
    </tr>

<!-- Container Code Modal -->
<div class="modal fade" id="containerCodeModal<?= $inspection->id_inspection ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Container Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?= nl2br($inspection->container_code ?? 'No code scanned') ?>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal fade" id="inspectionResultModal<?= $inspection->id_inspection ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspection Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?= nl2br($inspection->result ?? 'No detailed result available') ?>
            </div>
        </div>
    </div>
</div>


    <!-- Photo Modal -->
    <div class="modal fade" id="inspectionPhotoModal<?= $inspection->id_inspection ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inspection Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('upload_result/'.$inspection->inspection_photo) ?>" 
                         alt="Inspection Photo" 
                         class="img-fluid">
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#inspection-datatable').DataTable({
            responsive: true,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
