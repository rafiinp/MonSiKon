<li class="side-nav-title side-nav-item">Navigation</li>

<?php if (session()->get('role') == 'surveyor'){ ?>
<li class="side-nav-item">
    <a href="<?= site_url('surveyor/dashboard') ?>" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span> Dashboard </span>
    </a>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('inspections') ?>" class="side-nav-link">
        <i class="uil-file-info-alt"></i>
        <span> Inspection List </span>
    </a>
</li>

<?php } ?>

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
<!-- <li class="side-nav-item">
    <a href="" class="side-nav-link">
        <i class="uil-analysis"></i>
        <span> Analytics </span>
    </a>
</li> -->

<li class="side-nav-item">
    <a href="<?= site_url('container') ?>" class="side-nav-link">
        <i class="uil-server-alt"></i>
        <span> Container </span>
    </a>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('inspectionTabel') ?>" class="side-nav-link">
        <i class="uil-file-info-alt"></i>
        <span> Inspection </span>
    </a>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('pdf') ?>" class="side-nav-link">
        <i class="uil-file-info-alt"></i>
        <span> Export PDF </span>
    </a>
</li>
<?php } ?>
<!-- <li class="side-nav-item">
    <a href="<?= site_url('laporanTabel') ?>" class="side-nav-link">
        <i class="uil-books"></i>
        <span> Report </span>
    </a>
</li> -->

<!-- <li class="side-nav-title side-nav-item">MENU</li>
<li class="side-nav-item">
    <a href="<?= site_url('categoryTabel') ?>" class="side-nav-link">
        <i class="uil-notebooks"></i>
        <span> Category </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="<?= site_url('DetailTransaction') ?>" class="side-nav-link">
        <i class="uil-ticket"></i>
        <span> Transaction </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="<?= site_url('productsTabel') ?>" class="side-nav-link">
        <i class="uil-cube"></i>
        <span> Products </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="<?= site_url('cartTabel') ?>" class="side-nav-link">
        <i class="uil-shopping-cart-alt"></i>
        <span> Cart </span>
    </a>
</li> -->


<?php if (session()->get('role') == 'super_admin' || session()->get('role') == 'admin') { ?>
    <li class="side-nav-title side-nav-item">USERS</li>

    <li class="side-nav-item">
        <a href="<?= site_url('user') ?>" class="side-nav-link">
            <i class="uil-user"></i>
            <span> User Management </span>
        </a>
    </li>
<?php } ?>

<!-- <li class="side-nav-title side-nav-item">Log</li>
<li class="side-nav-item">
    <a href="logUser" class="side-nav-link">
        <i class="uil-history-alt"></i>
        <span> Log User </span>
    </a>
</li> -->


<!-- <li class="side-nav-title side-nav-item">TESTING</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarTesting" aria-expanded="false" aria-controls="sidebarTesting" class="side-nav-link">
        <i class="uil-book-alt"></i>
        <span> Sample </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarTesting">
        <ul class="side-nav-second-level">
            <li>
                <a href="#">Chart</a>
            </li>
            <li>
                <a href="#">Transaksi</a>
            </li>
            <li>
                <a href="#">List Product</a>
            </li>
            <li>
                <a href="#">Whistlist</a>
            </li>
        </ul>
    </div>
</li> -->

<!-- <li class="side-nav-item">
    <a href="" class="side-nav-link">
        <i class="uil-info-circle"></i>
        <span> Report </span>
    </a>
</li> -->