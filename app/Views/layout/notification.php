<script>
    UIkit.notification({
        message: '<?= session()->getFlashData('success'); ?>',
        status: 'primary',
        pos: 'top-right',
        timeout: 3000
    });

    UIkit.notification({
        message: 'Danger message...',
        status: 'danger'
    })

    console.log('sdfsadf')


    <?php if (session()->getFlashData('success')) : ?>
        UIkit.notification({
            message: '<?= session()->getFlashData('success'); ?>',
            status: 'primary',
            pos: 'top-right',
            timeout: 3000
        });
    <?php endif; ?>

    <?php if (session()->getFlashData('error')) : ?>
        UIkit.notification({
            message: '<?= session()->getFlashData('error'); ?>',
            status: 'danger',
            pos: 'top-right',
            timeout: 3000
        });
    <?php endif; ?>
</script>