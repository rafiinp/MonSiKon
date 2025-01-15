<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Cart | Teanology</title>
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
                            <li class="breadcrumb-item active">Cart</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Cart</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('cartTabel') ?>" class="btn btn-light mb-2 me-1">
                                    <i class="mdi mdi-lock-off me-2"></i>
                                    Add Cart
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
                                                    <th>#</th>
                                                    <th>Customer Name</th>
                                                    <th>Product Name</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Created At</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cart as $key =>  $value) : ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $value->first_name_customer ?></td>
                                                        <td><?= $value->name_product ?></td>
                                                        <td><?= $value->jumlah ?></td>
                                                        <td><?= $value->harga ?></td>
                                                        <td><?= $value->created_at ?></td>

                                                        <!-- <td class="table-action"> -->
                                                            <!-- <a href="<?= site_url('cart/edit/' . $value->id_cart) ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a> -->
                                                            <!-- <form action="<?= site_url('cart/delete/' . $value->id_cart) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')"> -->
                                                                <!--csrf disini kalau ditambahkan-->
                                                                <!-- <button class="action-icon" style="background: none; border: none;">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button> -->
                                                            <!-- </form> -->
                                                            <!-- <button class="action-icon" style="background: none; border: none;">
                                                                <i class="mdi mdi-check"></i> -->
                                                            <!-- </button> -->

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