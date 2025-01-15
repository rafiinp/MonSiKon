<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Log Admin | Teanology</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">MonSiKon</a></li>
                            <li class="breadcrumb-item"><a href="#">Log</a></li>
                            <li class="breadcrumb-item active">Log Users</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Log Users</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <!-- <a href="#" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add Category
                                </a> -->
                            </div>

                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!-- <a href="" class="btn btn-primary mb-2 me-1">
                                        <i class="mdi mdi-download"></i>
                                        Export
                                    </a> -->
                                </div>
                            </div>

                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success alert-dismissible show data">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">x</button>
                                        <b>Success !</b>
                                        <?= session()->getFlashdata('success') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap">
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name User</th>
                                                    <th>Action Log</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($loguser as $key =>  $value) : ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $value->name_user ?></td>
                                                        <td><?= $value->action ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        
</section>
<?= $this->endSection(); ?>