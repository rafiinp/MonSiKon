<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Management | MonSiKon</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <!-- Include additional styles if necessary -->
</head>
<body>

<?= $this->extend('layout/default') ?>

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
                    <h4 class="page-title">PDF Management</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <!-- <div class="col-sm-4">
                            <a href="<?= site_url('pdf/downloadPdf') ?>" class="btn btn-primary mb-2">
                                    Download All PDF
                                </a>
                            </div> -->
                            

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
                                        <th>No</th>
                                        <th>Container Number</th>
                                        <th>Inspection Date</th>
                                        <th>Status</th>
                                        <th>Surveyor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inspections as $index => $inspection): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $inspection->container_number ?></td>
                                        <td><?= $inspection->inspection_date ?></td>
                                        <td>
    <?php if ($inspection->status == 'completed'): ?>
        <span class="badge bg-success">
            <?= ucfirst($inspection->status) ?>
        </span>
    <?php endif; ?>
</td>
:
                                          
                                        <td><?= $inspection->surveyor_name ?></td>
                                        <td>
                                            <a href="<?= site_url('pdf/downloadPdf/'.$inspection->id_inspection) ?>" class="btn btn-sm btn-success">
                                                Download PDF
                                            </a>

                                            
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

</body>
</html>
