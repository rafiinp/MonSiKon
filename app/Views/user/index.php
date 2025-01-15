<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data User | MonSiKon</title>
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
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('user/new') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add User
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!-- <button type="button" class="btn btn-primary mb-2 me-1 mdi mdi-download">Export</button>
                                    <button type="button" class="btn btn-light mb-2 mdi mdi-lock-off">Locked</button> -->
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
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Company</th>
                                                    <th>Role</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
    <?php foreach ($user as $key => $value) : ?>
        <?php 
        $currentRole = session()->get('role');
        $userRole = $value->role;
        if ($currentRole == 'super_admin' || ($currentRole == 'admin' && $userRole == 'surveyor')) :
        ?>
            <tr>
                <td>
                    <?php if (!empty($value->photo_user)) : ?>
                        <img style="height: 50px" src="<?= base_url('upload_user/' . $value->photo_user) ?>" alt="User Photo">
                    <?php endif; ?>
                </td>
                <td><?= $value->name_user ?></td>
                <td><?= $value->email_user ?></td>
                <td><?= $value->name_company ?></td>
                <td>
                    <span class="badge <?= $value->role == 'super_admin' ? 'bg-success' : ($value->role == 'admin' ? 'bg-info' : 'bg-danger') ?>">
                        <?= ucfirst(str_replace('_', ' ', $value->role)) ?>
                    </span>
                </td>
                <td><?= $value->updated_at ?></td>
                
                <td class="table-action">
                    <a href="<?= site_url('user/edit/' . $value->id_user) ?>" class="action-icon"> 
                        <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i>
                    </a>
                    <form action="<?= site_url('user/delete/' . $value->id_user) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                        <button class="action-icon" style="background: none; border: none;">
                            <i class="mdi mdi-delete btn btn-danger mb-2"></i>
                        </button>
                    </form>
                </td>
                
            </tr>
        <?php endif; ?>
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