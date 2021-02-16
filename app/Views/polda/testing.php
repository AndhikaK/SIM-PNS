<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="">
    UIkit.notification({
        message: 'Danger message...',
        status: 'danger'
    })
</script>

<?= $this->endSection(); ?>