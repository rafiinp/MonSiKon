<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Add Container | MonSiKon</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>">MonSiKon</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('container') ?>">Containers</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Container</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('container') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                        <form action="<?= site_url('container/create') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <!-- CSRF Token -->
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="container_number" class="form-label">Container Number</label>
                                    <input type="text" id="container_number" class="form-control" name="container_number" placeholder="Enter Container Number" required>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <input type="text" id="type" class="form-control" name="type" placeholder="Enter Container Type" required>
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity (TEU)</label>
                                    <input type="number" id="capacity" class="form-control" name="capacity" placeholder="Enter Capacity" required>
                                </div>

                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Status</label>
                                        <select class="form-select" id="example-select" name="status" required>
                                          <option value="available">Available</option>
                                          <option value="inspected">Inspected</option>
                                          <option value="Damaged">Damaged</option>
                                        </select>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="mdi mdi-send"></i> Save
                                    </button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div> <!-- end table-responsive-->
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container -->
</section>
<?= $this->endSection(); ?>
