<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Companies | MonSiKon</title>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">MonSiKon</a></li>
                            <li class="breadcrumb-item active">Companies</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Companies Management</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('company/create') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add New Company
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!-- Additional buttons can go here -->
                                </div>
                            </div>
                        </div>

                        <?php if (session()->get('success')): ?>
                            <div class="alert alert-success alert-dismissible show data">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">x</button>
                                    <b>Success !</b>
                                    <?= session()->get('success') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($companies as $company): ?>
                                        <tr>
                                            <td><?= esc($company['name_company']) ?></td>
                                            <td><?= esc($company['created_at']) ?></td>
                                            <td class="table-action">
                                                <a href="<?= site_url('company/edit/' . $company['id_company']) ?>" class="action-icon"> 
                                                    <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i>
                                                </a>
                                                <a href="<?= site_url('company/delete/' . $company['id_company']) ?>" class="action-icon" onclick="return confirm('Are you sure you want to delete this company?')">
                                                    <i class="mdi mdi-delete btn btn-danger mb-2"></i>
                                                </a>
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
</section>
<?= $this->endSection() ?>
