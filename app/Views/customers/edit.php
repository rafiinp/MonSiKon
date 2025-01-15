<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update Customer | Teanology</title>
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
                            <li class="breadcrumb-item"><a href="#">Customer</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update Customer</h4>
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
                                <a href="<?= site_url('customersTabel') ?>" class="btn btn-success mb-2 me-1">
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
                                        <form action="<?= site_url('customers/update/' . $customers->id_customer) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <!--csrf disini kalau ditambahkan-->

                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input class="form-control" type="text" id="first_name_customer" name="first_name_customer" placeholder="First name" required="" value="<?= $customers->first_name_customer ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last Name</label>
                                                <input class="form-control" type="text" id="last_name_customer" name="last_name_customer" placeholder="Last name" required="" value="<?= $customers->last_name_customer ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="email_customer" name="email_customer" required="" placeholder="Email" value="<?= $customers->email_customer ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Telephone</label>
                                                <input type="text" class="form-control" data-toggle="input-mask" name="phone_customer" data-mask-format="00000-0000-0000" placeholder="Enter number" value="<?= $customers->phone_customer ?>">
                                                <span class="font-13 text-muted">e.g "6281x-xxxx-xxxx"</span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-date" class="form-label">Date</label>
                                                <input class="form-control" id="example-date" type="date" name="birthdate_customer" value="<?= $customers->birthdate_customer ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password_customer" class="form-control" name="password_customer" placeholder="Enter your password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Photo</label>
                                                <input type="file" id="example-fileinput" class="form-control" name="photo_customer">
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