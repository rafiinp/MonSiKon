<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Category | Teanology</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Teanology</a></li>
                            <li class="breadcrumb-item"><a href="#">Menu</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Category</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('category/new') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add Category
                                </a>
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
                                                    <th>Photo</th>
                                                    <th>Category Name</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($category as $key =>  $value) : ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td>
                                                            <?php if (!empty($value->photo_category)) : ?>
                                                                <img style="height: 100px" src="<?= base_url('upload_category/' . $value->photo_category) ?>" alt="Category Photo">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $value->name_category ?></td>
                                                        <td><?= $value->description_category ?></td>
                                                        <td class="table-action">
                                                            <a href="<?= site_url('category/edit/' . $value->id_category) ?>" class="action-icon"> <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i></a>
                                                            <form action="<?= site_url('category/delete/' . $value->id_category) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
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
    </div> 
</section>
<?= $this->endSection(); ?>