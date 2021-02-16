<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container container-detail-data">
    <h1>Data Pegawai</h1>
    <div class="  uk-padding-small" uk-grid>
        <div class="uk-width-auto@m uk-margin-top">
            <div class="uk-background-primary">
                <img width="150" height="225" alt="" uk-img="data-src:" uk-svg>
            </div>
        </div>

        <div class="detail uk-width-auto@m" uk-grid>
            <div>
                <table class="uk-table uk-margin-small-left uk-table-striped">
                    <tr>
                        <th>NIP</th>
                        <td><?= $umum['nip'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pegawai</th>
                        <td><?= $umum['nama_pegawai'] ?></td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <?php
                        $ttl = date('d M Y', strtotime($umum['ttl']))
                        ?>
                        <td><?= ucwords(strtolower($umum['tempat_lahir'])) . ', ' . $ttl ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td> <?= strtoupper($umum['alamat']) ?> </td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= strtoupper($umum['jenis_kelamin']) ?></td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td><?= $umum['agama'] ?></td>
                    </tr>
                </table>
            </div>

            <div>

                <table class="uk-table">
                    <tr>
                        <th>NIK</th>
                        <td><?= $umum['nik'] ?></td>
                    </tr>
                    <tr>
                        <th>Golongan dan Pangkat</th>
                        <td><?= $umum['nik'] ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td><?= $umum['nik'] ?></td>
                    </tr>
                    <tr>
                        <th>Satuan Kerja</th>
                        <td><?= $umum['nama_satker'] ?></td>
                    </tr>
                    <tr>
                        <th>Bagian</th>
                        <td><?= $umum['nama_bagian'] ?></td>
                    </tr>
                    <tr>
                        <th>Sub Bagian</th>
                        <td><?= $umum['nama_subbag'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <hr class="uk-divider-icon">
    <div class="uk-padding-large-bottom">
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
            <li><a href="#">Riwayat Jabatan</a></li>
            <li><a href="#">Riwayat Penempatan</a></li>
            <li><a href="#">Riwayat Golongan dan Pangkat</a></li>
            <li><a href="#">Riwayat Pendidikan</a></li>
        </ul>

        <ul class="uk-switcher uk-margin">
            <li>
                <ul>
                    <li></li>
                </ul>
            </li>
            <li>Hello!</li>
            <li>Bazinga!</li>
            <li>Bazinga!</li>
        </ul>
    </div>
</div>

<?= $this->endSection(); ?>