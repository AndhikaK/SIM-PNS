<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<form action="<?= base_url('/menu/download') ?>" method="post">
    <button class="btn btn-primary">Download</button>
</form>

<?= $this->endSection(); ?>