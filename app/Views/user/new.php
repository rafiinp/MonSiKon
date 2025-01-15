<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Add User | MonSiKon</title>
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
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add User</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('user') ?>" class="btn btn-success mb-2 me-1">
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
                                        <form action="<?= site_url('user/create') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <!--csrf disini kalau ditambahkan-->
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Name </label>
                                                <input type="text" id="simpleinput" class="form-control" name="name_user" placeholder="Name" required="">
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email</label>
                                                <input class="form-control" type="email" id="email_user" name="email_user" required="" placeholder="Email">
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Role</label>
                                                <select class="form-select" id="example-select" name="role" required>
                                                    <?php if (session()->get('role') == 'super_admin' ) { ?>
                                                    <option value="super_admin">Super Admin</option>
                                                    <option value="admin">Admin</option>
                                                    <?php } ?>
                                                    <option value="surveyor">Surveyor</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
    <label for="company_id" class="form-label">Company</label>
    <select class="form-select" id="company_id" name="company_id" required>
        <option value="">Select Company</option>
        <?php foreach ($companies as $company) : ?>
            <option value="<?= $company['id_company'] ?>"><?= $company['name_company'] ?></option>
        <?php endforeach; ?>
    </select>
</div>


                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password_user" class="form-control" name="password_user" placeholder="Enter your password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="photo_user" class="form-label">Photo</label>
                                                <input type="file" id="photo_user" class="form-control" name="photo_user" accept="image/*" required>
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