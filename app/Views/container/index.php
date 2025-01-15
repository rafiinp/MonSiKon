<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Container Management | MonSiKon</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>">MonSiKon</a></li>
                            <li class="breadcrumb-item active">Containers</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Container Management</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('container/new') ?>" class="btn btn-success mb-2">
                                    <i class="mdi mdi-plus-circle me-2"></i> Add Container
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!-- Optional additional actions can go here -->
                                </div>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible show data">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">x</button>
                                    <b>Success !</b> <?= session()->getFlashdata('success') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($containers) && is_array($containers)): ?>
                            <div class="table-responsive">
                                <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Container Number</th>
                                            <th>Type</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($containers as $container): ?>
                                            <tr>
                                                <td><?= esc($container['container_number']) ?></td>
                                                <td><?= esc($container['type']) ?></td>
                                                <td><?= esc($container['capacity']) ?></td>
                                                <td>
                                                    <span class="badge bg-<?= $container['status'] == 'available' ? 'success' : 
                                                        ($container['status'] == 'inspected' ? 'warning' : 'danger') ?>">
                                                        <?= ucfirst(esc($container['status'])) ?>
                                                    </span>
                                                </td>
                                                <td class="table-action">
                                                    <a href="<?= site_url('container/edit/' . $container['id_container']) ?>" class="action-icon">
                                                        <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i>
                                                    </a>
                                                    
                                                    <form action="<?= site_url('container/delete/' . $container['id_container']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this container?')">
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
                            <!-- Pagination has been removed -->
                        <?php else: ?>
                            <div class="alert alert-info">No containers found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
