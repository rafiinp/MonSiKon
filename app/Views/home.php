<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Dashboard | MonSiKon</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">
        <!-- Start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <!-- Welcome message -->
                    <?php 
                        $role = session()->get('role');
                        $roleName = ($role == 'super_admin') ? 'Super Admin' : (($role == 'admin') ? 'Admin' : 'User');
                    ?>
                    <h4 class="page-title">Welcome to Dashboard, <?= $roleName ?> :)</h4>
                </div>
            </div>
        </div>
        <!-- End page title -->

        <div class="row">
            <!-- Super Admin Stats -->
            <?php if ($role == 'super_admin'): ?>
            <div class="col-xl-6 col-lg-12">
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-circle widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0">Total Users</h5>
                                <h3 class="mt-3 mb-3">1</h3>
                                <p class="mb-0 text-muted">Total registered users in the system.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Companies -->
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-building widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0">Total Companies</h5>
                                <h3 class="mt-3 mb-3">1</h3>
                                <p class="mb-0 text-muted">Total companies managed by Super Admin.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
            <?php endif; ?>

            <!-- Admin Stats -->
            <?php if ($role == 'admin'): ?>
            <div class="col-xl-6 col-lg-12">
                <div class="row">
                    <!-- Total Containers -->
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-server widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0">Total Containers</h5>
                                <h3 class="mt-3 mb-3">1</h3>
                                <p class="mb-0 text-muted">Total containers managed by the admin.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Inspections -->
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-file-document-box widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0">Total Inspections</h5>
                                <h3 class="mt-3 mb-3">1</h3>
                                <p class="mb-0 text-muted">Total inspections performed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
            <?php endif; ?>
        </div> <!-- end row -->

        <!-- Start Data table for super_admin/admin -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">User Management</h4>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample user data -->
                                    <tr>
                                        <td>Admin</td>
                                        <td>admin@cotecna.com</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rafi</td>
                                        <td>rafi@cotecna.com</td>
                                        <td><span class="badge bg-warning">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</section>
<?= $this->endSection(); ?>

<!-- Sidebar navigation -->
<li class="side-nav-title side-nav-item">Navigation</li>

<?php if (session()->get('role') == 'super_admin'){ ?>
<li class="side-nav-item">
    <a href="<?= site_url('home') ?>" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span> Dashboard </span>
    </a>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('company') ?>" class="side-nav-link">
        <i class="uil-building"></i>
        <span> Companies </span>
    </a>
</li>

<?php } ?>

<?php if (session()->get('role') == 'admin') { ?>
<li class="side-nav-item">
    <a href="<?= site_url('home') ?>" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span> Dashboard </span>
    </a>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('container') ?>" class="side-nav-link">
        <i class="uil-server-alt"></i>
        <span> Containers </span>
    </a>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('inspection') ?>" class="side-nav-link">
        <i class="uil-file-info-alt"></i>
        <span> Inspections </span>
    </a>
</li>
<?php } ?>

<?php if (session()->get('role') == 'super_admin' || session()->get('role') == 'admin') { ?>
<li class="side-nav-title side-nav-item">USERS</li>

<li class="side-nav-item">
    <a href="<?= site_url('user') ?>" class="side-nav-link">
        <i class="uil-user"></i>
        <span> User Management </span>
    </a>
</li>
<?php } ?>
