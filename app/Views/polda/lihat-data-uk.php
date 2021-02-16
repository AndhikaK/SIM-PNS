<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container uk-padding-small">


    <h1>Lihat Data Pegawai</h1>
    <table class="uk-table uk-table-hover uk-box-shadow-small">
        <thead class="uk-background-secondary">
            <tr>
                <th>No.</th>
                <th>Action</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Satuan Kerja</th>
                <th>Bagian</th>
                <th>Subbag</th>
            </tr>
        </thead>

        <tbody class="uk-text-small">
            <?php $i = 1 ?>
            <?php foreach ($pegawai as $p) : ?>
                <tr>
                    <td> <?= $i++ ?> </td>
                    <td>
                        <a href="<?= base_url('/menu/detail-pegawai/' . $p['nip']) ?>" class="uk-text-primary uk-margin-small-right" uk-icon="icon: file-text"></a>
                        <a href="<?= base_url('/home/delete/' . $p['nip'] . "/nip/pegawai") ?>" class="uk-text-danger" uk-icon="icon: trash"></a>
                    </td>
                    <td> <?= $p['nip'] ?> </td>
                    <td> <?= $p['nama_pegawai'] ?> </td>
                    <td> <?= $p['jabatan'] ?> </td>
                    <td> <?= $p['nama_satker'] ?> </td>
                    <td> <?= $p['nama_bagian'] ?> </td>
                    <td> <?= $p['nama_subbag'] ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="nana">

</div>

<?= $this->endSection(); ?>