<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Customer | Teanology</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">MonSiKon</a></li>
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item active">Surveyor</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Surveyor</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('customers/new') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add Surveyor
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-light mb-2 me-1 mdi mdi-lock-off">Locked</button>
                                    <button type="button" class="btn btn-light mb-2 mdi mdi-lock-off">Locked</button>
                                </div>
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
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Photo</th>
                                                    <th>Id Customer</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($customers as $key =>  $value) : ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td>
                                                            <?php if (!empty($value->photo_customer)) : ?>
                                                                <img style="height: 100px" src="<?= base_url('upload_customer/' . $value->photo_customer) ?>" alt="Customer Photo">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $value->id_customer ?></td>
                                                        <td><?= $value->first_name_customer ?></td>
                                                        <td><?= $value->last_name_customer ?></td>
                                                        <td><?= $value->email_customer ?></td>
                                                        <td><?= $value->phone_customer ?></td>
                                                        <td><?= $value->updated_at ?></td>
                                                        <td class="table-action">
                                                            <a href="<?= site_url('customers/edit/' . $value->id_customer) ?>" class="action-icon"> <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i></a>
                                                            <form action="<?= site_url('customers/delete/' . $value->id_customer) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                                                <!--csrf disini kalau ditambahkan-->
                                                                <button class="action-icon" style="background: none; border: none;">
                                                                    <i class="mdi mdi-delete btn btn-danger mb-2"></i>
                                                                </button>
                                                            </form>
                                                        </td>
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