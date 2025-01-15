<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Surveyor Dashboard | MonSiKon</title>
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
                            <li class="breadcrumb-item active">Surveyor Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">My Scheduled Inspections</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (empty($inspections)): ?>
                            <div class="alert alert-info">
                                No inspections scheduled at the moment.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Container Number</th>
                                            <th>Scheduled Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($inspections as $inspection): ?>
    <tr>
        <td><?= $inspection->container_number ?></td>
        <td><?= $inspection->scheduled_date ?></td>
        <td>
            <span class="badge bg-<?= $inspection->status == 'pending' ? 'warning' : 'success' ?>">
                <?= ucfirst($inspection->status) ?>
            </span>
        </td>
        <td>
            <a href="<?= site_url('surveyor/perform/'.$inspection->id_inspection) ?>" 
               class="btn btn-primary btn-sm">
                Perform Inspection
            </a>
        </td>
    </tr>
<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>