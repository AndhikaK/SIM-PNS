<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="this-alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="this-alert">
        <?= session()->getFlashData('error') ?>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>