<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit Company</title>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">
        <h3 class="mb-3">Edit Company</h3>

        <?php if (session()->get('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->get('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('company/update/' . $company['id_company']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="name_company" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="name_company" name="name_company" value="<?= old('name_company', $company['name_company']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
