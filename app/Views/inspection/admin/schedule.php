<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Schedule Inspection | MonSiKon</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">MonSiKon</a></li>
                            <li class="breadcrumb-item active">Schedule Inspection</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Schedule New Inspection</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <p><?= $error ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('inspection/create-schedule') ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Container</label>
                                        <select name="container_id" class="form-control" required>
                                            <option value="">Select Container</option>
                                            <?php foreach ($containers as $container): ?>
                                                <option value="<?=$container['id_container']?>">
    <?=$container['container_number']?> (<?=$container['type']?>)
</option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Surveyor</label>
                                        <select name="surveyor_id" class="form-control" required>
                                            <option value="">Select Surveyor</option>
                                            <?php foreach ($user as $surveyor): ?>
                                                <option value="<?= $surveyor->id_user ?>">
                                                    <?= $surveyor->name_user ?> (<?= $surveyor->name_user ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Scheduled Date</label>
                                        <input type="date" name="scheduled_date" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Schedule Inspection</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>