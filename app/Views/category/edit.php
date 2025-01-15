<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update Category | Teanology</title>
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
                            <li class="breadcrumb-item"><a href="#">Menu</a></li>
                            <li class="breadcrumb-item"><a href="#">Category</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update Category</h4>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('categoryTabel') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-arrow-left"></i>
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <form action="<?= site_url('category/update/' . $category->id_category) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <!--csrf disini kalau ditambahkan-->
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Name</label>
                                                <input type="text" id="simpleinput" class="form-control" name="name_category" value="<?= $category->name_category ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-textarea" class="form-label">Description</label>
                                                <textarea class="form-control" id="example-textarea" rows="5" name="description_category" required><?= $category->description_category ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Photo</label>
                                                <input type="file" id="example-fileinput" class="form-control" name="photo_category">
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>Save</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </form>
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