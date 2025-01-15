<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update User | MonSiKon</title>
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
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update Admin</h4>
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
        <!-- Form Start -->
<form action="<?= site_url('user/update/' . $user->id_user) ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name_user" class="form-label">Name</label>
        <input type="text" class="form-control" id="name_user" name="name_user" value="<?= esc($user->name_user) ?>" required>
    </div>

    <div class="mb-3">
        <label for="email_user" class="form-label">Email</label>
        <input type="email" class="form-control" id="email_user" name="email_user" value="<?= esc($user->email_user) ?>" required>
    </div>

    <div class="mb-3">
        <label for="photo_user" class="form-label">Photo</label>
        <input type="file" class="form-control" id="photo_user" name="photo_user">
    </div>

    <!-- Role (Disabled or Enabled based on role) -->
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" >
            <option value="surveyor" <?= ($user->role == 'surveyor') ? 'selected' : '' ?>>Surveyor</option>
            <option value="admin" <?= ($user->role == 'admin') ? 'selected' : '' ?>>Admin</option>
        </select>
    </div>

    <!-- Company (Disabled or Enabled based on role) -->
    <div class="mb-3">
        <label for="company_id" class="form-label">Company</label>
        <select class="form-select" id="company_id" name="company_id" <?= ($user->role != 'super_admin') ? 'disabled' : '' ?>>
            <option value="">Select Company</option>
            <?php foreach ($companies as $company) : ?>
                <option value="<?= $company['id_company'] ?>" <?= $user->id_company == $company['id_company'] ? 'selected' : '' ?>>
                    <?= $company['name_company'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
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
