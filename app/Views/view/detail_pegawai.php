<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>


<?= d($umum) ?>

<div class="uk-container container-detail-data">
    <h1>Data Pegawai</h1>

    <form action="<?= base_url('/menu/updatedetail') ?>" method="POST">
        <?php if ($edit == null) : ?>
            <a href="<?= base_url('/menu/lihatdetail/' . $umum['nip'] . '/edit') ?>" class="uk-button uk-button-small btn-primary text-white">Edit</a>
        <?php else : ?>
            <!-- <a href="<?= base_url('/menu/lihatdetail/' . $umum['nip'] . '/edit') ?>" class="uk-button uk-button-small btn-warning   ">simpan</a> -->
            <button type="submit" class="uk-button uk-button-small btn-warning">simpan</button>
            <a href="<?= base_url('/detail_pegawai/' . $umum['nip']) ?>" class="uk-button uk-button-small btn-danger text-white">batal</a>
        <?php endif; ?>
        <div class="uk-padding-small uk-child-width-1-3@s" uk-grid>

            <input type="text" value="<?= $umum['id_riwayat_golongan'] ?>" name="id_riwayat_golongan" hidden>
            <input type="text" value="<?= $umum['id_riwayat_penempatan'] ?>" name="id_riwayat_penempatan" hidden>
            <input type="text" value="<?= $umum['id_riwayat_jabatan'] ?>" name="id_riwayat_jabatan" hidden>


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
                            <td><input type="text" name="nip" value="<?= $umum['nip'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>
                        </tr>
                        <tr>
                            <th>Nama Pegawai</th>
                            <td><input type="text" name="nama_pegawai" value="<?= $umum['nama_pegawai'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>
                        </tr>
                        <tr class="ttl">
                            <th>Tempat, Tanggal Lahir</th>
                            <?php
                            $ttl = date('d M Y', strtotime($umum['ttl']));
                            $ttlExplode = explode("-", $umum['ttl']);
                            ?>

                            <?php if ($edit == null) : ?>
                                <td>
                                    <input type="text" name="tempat_lahir" value="<?= $umum['tempat_lahir'] ?>" <?= $edit == null ? "disabled" : "" ?>>
                                    <input class="ttl2" type="text" name="ttl" value="<?= $ttl ?>" <?= $edit == null ? "disabled" : "" ?>>
                                </td>
                            <?php else : ?>
                                <td>
                                    <input type="text" name="tempat_lahir" value="<?= $umum['tempat_lahir'] ?>" <?= $edit == null ? "disabled" : "" ?>>
                                    <input class="ttl2" type="text" list="listTanggalOption" name="tanggal_lahir" value="<?= $ttlExplode[2] ?>" <?= $edit == null ? "disabled" : "" ?>>
                                    <input class="ttl2" type="text" list="listBulanOption" name="bulan_lahir" value="<?= $ttlExplode[1] ?>" <?= $edit == null ? "disabled" : "" ?>>
                                    <input class="ttl2" type="text" list="listTahunOption" name="tahun_lahir" value="<?= $ttlExplode[0] ?>" <?= $edit == null ? "disabled" : "" ?>>

                                    <datalist id="listTanggalOption">
                                        <?php for ($j = 1; $j < 32; $j++) : ?>
                                            <option value="<?= $j; ?>"></option>
                                        <?php endfor ?>
                                    </datalist>
                                    <datalist id="listBulanOption">
                                        <?php for ($j = 1; $j < 13; $j++) : ?>
                                            <option value="<?= $j; ?>"></option>
                                        <?php endfor ?>
                                    </datalist>
                                    <datalist id="listTahunOption">
                                        <?php for ($j = (int) date("Y"); $j >= 1921; $j--) : ?>
                                            <option value="<?= $j; ?>"></option>
                                        <?php endfor ?>
                                    </datalist>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><input type="text" name="alamat" value="<?= $umum['alamat'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><input type="text" name="jenis_kelamin" value="<?= $umum['jenis_kelamin'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td><input type="text" name="agama" value="<?= $umum['agama'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>
                        </tr>
                    </table>
                </div>

                <div>
                    <table class="uk-table">
                        <tr>
                            <th>NIK</th>
                            <td><input type="text" name="nik" value="<?= $umum['nik'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>
                        </tr>
                        <tr>
                            <th>Golongan dan Pangkat</th>
                            <td class="">
                                <input type="text" class="golongan" name="pangkat_gol" value="<?= $umum['id_golongan'] . " - " . $umum['pangkat'] ?>" <?= $edit == null ? "disabled" : "" ?>>
                                <!-- <input class="ttl2" class="nama_pangkat" type="text" name="pangkat" value="<?= $umum['pangkat'] ?>" <?= $edit == null ? "disabled" : "" ?>> -->
                            </td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><input type="text" name="jabatan" value="<?= (!$edit ? "" : $umum['id_jabatan'] . " - ") . $umum['nama_jabatan'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>

                        </tr>
                        <tr>
                            <th>Satuan Kerja</th>
                            <td><input type="text" name="id_satker" value="<?= (!$edit ? "" : $umum['id_satker'] . " - ") . $umum['nama_satker'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>

                        </tr>
                        <tr>
                            <th>Bagian</th>
                            <td><input type="text" name="id_bagian" value="<?= (!$edit ? "" : $umum['id_bagian'] . " - ") . $umum['nama_bagian'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>

                        </tr>
                        <tr>
                            <th>Sub Bagian</th>
                            <td><input type="text" name="id_subbag" value="<?= (!$edit ? "" : $umum['id_subbag'] . " - ") . $umum['nama_subbag'] ?>" <?= $edit == null ? "disabled" : "" ?>></td>

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
    </form>
</div>
</div>

<?= $this->endSection(); ?>