<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>


<div class="uk-container container-detail-data">
    <h1>Data Pegawai</h1>
    <div class="  uk-padding-small uk-child-width-1-3@s" uk-grid>
        <div class="uk-width-auto@m uk-margin-top">
            <div class="uk-background-primary">
                <img width="100" height="150" alt="" uk-img="data-src:" uk-svg>
            </div>
        </div>

        <div class="detail uk-width-auto@m" uk-grid>
            <div>
                <table class="uk-table uk-margin-small-left uk-table-striped">
                    <tr>
                        <th>NIP</th>
                        <td><input type="text" name="nip" value="<?= $umum['nip'] ?>" disabled></td>
                    </tr>
                    <tr>
                        <th>Nama Pegawai</th>
                        <td><input type="text" name="nama_pegawai" value="<?= $umum['nama_pegawai'] ?>" disabled></td>
                    </tr>
                    <tr class="ttl">
                        <th>Tempat, Tanggal Lahir</th>
                        <?php
                        $ttl = date('d M Y', strtotime($umum['ttl']))
                        ?>
                        <td>
                            <input type="text" name="tempat_lahir" value="<?= $umum['tempat_lahir'] ?>" disabled>
                            <input class="ttl2" type="text" name="ttl" value="<?= $ttl ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><input type="text" name="alamat" value="<?= $umum['alamat'] ?>" disabled></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><input type="text" name="jenis_kelamin" value="<?= $umum['jenis_kelamin'] ?>" disabled></td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td><input type="text" name="agama" value="<?= $umum['agama'] ?>" disabled></td>
                    </tr>
                </table>
            </div>

            <div>

                <table class="uk-table">
                    <tr>
                        <th>NIK</th>
                        <td><input type="text" name="nik" value="<?= $umum['nik'] ?>" disabled></td>
                    </tr>
                    <tr>
                        <th>Golongan dan Pangkat</th>
                        <td class="pangkat">
                            <input type="text" class="golongan" name="id_golongan" value="<?= $umum['id_golongan'] ?>" disabled>
                            <input class="ttl2" class="nama_pangkat" type="text" name="pangkat" value="<?= $umum['pangkat'] ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td><input type="text" name="nama_jabatan" value="<?= $umum['nama_jabatan'] ?>" disabled></td>

                    </tr>
                    <tr>
                        <th>Satuan Kerja</th>
                        <td><input type="text" name="nama_satker" value="<?= $umum['nama_satker'] ?>" disabled></td>

                    </tr>
                    <tr>
                        <th>Bagian</th>
                        <td><input type="text" name="nama_bagian" value="<?= $umum['nama_bagian'] ?>" disabled></td>

                    </tr>
                    <tr>
                        <th>Sub Bagian</th>
                        <td><input type="text" name="nama_subbag" value="<?= $umum['nama_subbag'] ?>" disabled></td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
    <hr class="uk-divider-icon">
    <div class="uk-padding-large-bottom riwayat-container">
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
            <li><a href="#">Riwayat Jabatan</a></li>
            <li><a href="#">Riwayat Penempatan</a></li>
            <li><a href="#">Riwayat Golongan dan Pangkat</a></li>
            <li><a href="#">Riwayat Pendidikan</a></li>
        </ul>

        <ul class="uk-switcher uk-margin uk-margin-large-bottom detail-riwayat">
            <li>
                <table class="uk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <?php foreach ($colRwyJabatan as $name => $value) : ?>
                                <th><?= $name ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($riwayatJabatan as $item) : ?>
                            <tr>
                                <td><?= $i++; ?></td>

                                <?php foreach ($colRwyJabatan as $col) : ?>
                                    <td><?= strtoupper($item[$col]) ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </li>
            <li>
                <table class="uk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <?php foreach ($colRwyPenempatan as $name => $value) : ?>
                                <th><?= $name ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($riwayatPenempatan as $item) : ?>
                            <tr>
                                <td><?= $i++; ?></td>

                                <?php foreach ($colRwyPenempatan as $col) : ?>
                                    <td><?= strtoupper($item[$col]) ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </li>
            <li>
                <table class="uk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <?php foreach ($colRwyGolongan as $name => $value) : ?>
                                <th><?= $name ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($riwayatGolongan as $item) : ?>
                            <tr>
                                <td><?= $i++; ?></td>

                                <?php foreach ($colRwyGolongan as $col) : ?>
                                    <td><?= strtoupper($item[$col]) ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </li>
            <li>Bazinga!</li>
        </ul>
    </div>
</div>

<?= $this->endSection(); ?>