<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create Company</title>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">
        <h3 class="mb-3">Add New Company</h3>

        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->get('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('company/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="name_company" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="name_company" name="name_company" value="<?= old('name_company') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
