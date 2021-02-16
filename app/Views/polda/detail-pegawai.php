<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>


<div class="container">
    <div class="uk-padding" uk-grid>
        <div class="uk-width-auto@m">
            <div class="uk-background-primary">
                <img width="150" height="225" alt="" uk-img="data-src:" uk-svg>
            </div>
        </div>
        <div class="uk-width-auto@m  detail" uk-grid>
            <table class="uk-table uk-margin-small-left">
                <tr>
                    <th>NIP</th>
                    <td><?= $umum['nip'] ?></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td><?= $umum['nik'] ?></td>
                </tr>
                <tr>
                    <th>Nama Pegawai</th>
                    <td><?= $umum['nama_pegawai'] ?></td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td><?= $umum['nip'] ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>