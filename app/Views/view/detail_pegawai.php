<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>


<div class="uk-container container-detail-data">
    <h1>Data Pegawai</h1>

    <form action="<?= base_url('/menu/updatedetail') ?>" method="POST">

        <?php if ($edit == 'edit-bio') : ?>
            <button type="submit" class="uk-button uk-button-small btn-warning">simpan</button>
            <a href="<?= base_url('/detail_pegawai/' . $umum['nip']) ?>" class="uk-button uk-button-small btn-danger text-white">batal</a>
        <?php else : ?>
            <a href="<?= base_url('/menu/lihatdetail/' . $umum['nip'] . '/edit-bio') ?>" class="uk-button uk-button-small btn-primary text-white">Edit</a>
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
                            <td><input type="text" name="nip" value="<?= $nip ?>" autocomplete="off" <?= $edit == 'edit-bio' ? 'readonly' : 'disabled' ?>></td>
                        </tr>
                        <tr>
                            <th>Nama Pegawai</th>
                            <td><input type="text" name="nama_pegawai" value="<?= $umum['nama_pegawai'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                        </tr>
                        <tr class="ttl">
                            <th>Tempat, Tanggal Lahir</th>
                            <?php
                            $ttl = date('d M Y', strtotime($umum['ttl']));
                            $ttlExplode = explode("-", $umum['ttl']);
                            ?>

                            <?php if ($edit == null) : ?>
                                <td>
                                    <input type="text" name="tempat_lahir" value="<?= $umum['tempat_lahir'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">
                                    <input class="ttl2" type="text" name="ttl" value="<?= $ttl ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">
                                </td>
                            <?php else : ?>
                                <td>
                                    <input type="text" name="tempat_lahir" value="<?= $umum['tempat_lahir'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">
                                    <div>
                                        <input class="ttl2" type="text" list="listTanggalOption" name="tanggal_lahir" value="<?= $ttlExplode[2] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">
                                        <datalist id="listTanggalOption">
                                            <?php for ($j = 1; $j < 32; $j++) : ?>
                                                <option value="<?= $j; ?>"></option>
                                            <?php endfor ?>
                                        </datalist>
                                    </div>
                                    <input class="ttl2" type="text" list="listBulanOption" name="bulan_lahir" value="<?= $ttlExplode[1] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">
                                    <input class="ttl2" type="text" list="listTahunOption" name="tahun_lahir" value="<?= $ttlExplode[0] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">

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
                            <td><input type="text" name="alamat" value="<?= $umum['alamat'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><input type="text" list="listGenderOption" name="jenis_kelamin" value="<?= $umum['jenis_kelamin'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                            <datalist id="listGenderOption">
                                <option value="LAKI-LAKI"></option>
                                <option value="PEREMPUAN"></option>
                            </datalist>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td><input type="text" list="listAgamaOption" name="agama" value="<?= $umum['agama'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                            <datalist id="listAgamaOption">
                                <option value="ISLAM"></option>
                                <option value="PROTESTAN"></option>
                                <option value="KATOLIK"></option>
                                <option value="HINDU"></option>
                                <option value="BUDHA"></option>
                                <option value="KONG HU CHU"></option>
                            </datalist>
                        </tr>
                    </table>
                </div>

                <div>
                    <table class="uk-table">
                        <tr>
                            <th>NIK</th>
                            <td><input type="text" name="nik" value="<?= $umum['nik'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                        </tr>
                        <tr>
                            <th>Golongan dan Pangkat</th>
                            <td class="">
                                <input type="text" list="listGolonganOption" class="golongan" name="pangkat_gol" value="<?= $umum['id_golongan'] . " - " . $umum['pangkat'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off">
                                <!-- <input class="ttl2" class="nama_pangkat" type="text" name="pangkat" value="<?= $umum['pangkat'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"> -->
                            </td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><input type="text" name="jabatan" list="listJabatanOption" value="<?= ($edit == "edit-bio" ? "" : $umum['id_jabatan'] . " - ") . $umum['nama_jabatan'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>

                        </tr>
                        <tr>
                            <th>Satuan Kerja</th>
                            <td><input type="text" name="id_satker" list="listSatkerOption" value="<?= ($edit == "edit-bio" ? "" : $umum['id_satker'] . " - ") . $umum['nama_satker'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                            <datalist id="listSatkerOption">
                                <?php foreach ($satker as $row) : ?>

                                    <option value="<?= $row['id_satker'] . " - " . $row['nama_satker'] ?>"> </option>

                                <?php endforeach; ?>
                            </datalist>

                        </tr>
                        <tr>
                            <th>Bagian</th>
                            <td><input type="text" name="id_bagian" list="listBagianOption" value="<?= ($edit == "edit-bio" ? "" : $umum['id_bagian'] . " - ") . $umum['nama_bagian'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>

                        </tr>
                        <tr>
                            <th>Sub Bagian</th>
                            <td><input type="text" name="id_subbag" list="listSubbagOption" value="<?= ($edit == "edit-bio" ? "" : $umum['id_subbag'] . " - ") . $umum['nama_subbag'] ?>" <?= $edit == 'edit-bio' ? "" : "disabled" ?> autocomplete="off"></td>
                        </tr>


                        <datalist id="listBagianOption">
                            <?php foreach ($bagian as $row) : ?>

                                <option value="<?= $row['id_bagian'] . " - " . $row['nama_bagian'] ?>"> </option>

                            <?php endforeach; ?>
                        </datalist>

                        <datalist id="listGolonganOption">
                            <?php foreach ($pangkat_golongan as $row) : ?>

                                <option value="<?= $row['id_golongan'] . " - " . $row['pangkat'] ?>"> </option>

                            <?php endforeach; ?>
                        </datalist>

                        <datalist id="listJabatanOption">
                            <?php foreach ($jabatan as $row) : ?>

                                <option value="<?= $row['id_jabatan'] . " - " . $row['nama_jabatan'] ?>"> </option>

                            <?php endforeach; ?>
                        </datalist>

                        <datalist id="listSubbagOption">
                            <?php foreach ($subbag as $row) : ?>

                                <option value="<?= $row['id_subbag'] . " - " . $row['nama_subbag'] ?>"> </option>

                            <?php endforeach; ?>
                        </datalist>

                    </table>
                </div>
            </div>
        </div>
    </form>


    <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
    <hr class="uk-divider-icon">

    <?php $switcher = '' ?>
    <?php if (str_contains($edit, "rwy")) {
        $switcherState = explode("-", $edit);
        $switcher = $switcherState[2];
    } ?>


    <div class="uk-padding-large-bottom riwayat-container">
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
            <li class="<?= $switcher == "jbt" ? "uk-active" : "" ?>"><a href="#">Riwayat Jabatan</a></li>
            <li class="<?= $switcher == "pnm" ? "uk-active" : "" ?>"><a href="#">Riwayat Penempatan</a></li>
            <li class="<?= $switcher == "gol" ? "uk-active" : "" ?>"><a href="#">Riwayat Golongan dan Pangkat</a></li>
            <li class="<?= $switcher == "pdd" ? "uk-active" : "" ?>"><a href="#">Riwayat Pendidikan</a></li>
        </ul>

        <ul class="uk-switcher uk-margin uk-margin-large-bottom detail-riwayat">
            <!-- ///////////////////////////////////ini jabatan ///////////////////////////////////////////////// -->
            <li>
                <table class="uk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>action</th>
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
                                <td>
                                    <?php if ($edit != 'edit-rwy-jbt-' . $item['id_riwayat_jabatan']) : ?>
                                        <a href="<?= base_url('/menu/lihatdetail/' . $umum['nip'] . '/edit-rwy-jbt-' . $item['id_riwayat_jabatan']) ?>" class="uk-icon-link uk-margin-small-right text-primary" uk-icon="file-edit"></a>
                                        <a href="#" class="uk-icon-link text-danger" uk-icon="trash"></a>
                                    <?php elseif ($edit) : ?>
                                        <form action="<?= base_url('/menu/editItemRiwayat') ?>" method="POST">
                                            <button type="submit">nice!</button>
                                        <?php endif; ?>
                                </td>

                                <?php foreach ($colRwyJabatan as $name => $col) : ?>
                                    <td>
                                        <?php if ($name == "jabatan") : ?>
                                            <input type="text" list="<?= 'list' . ucwords($name) . 'Option' ?>" name="<?= 'id_' . $name ?>" value="<?= $item['id_' . $name] . " - " . $item['nama_' . $name] ?>" <?= $edit == 'edit-rwy-jbt-' . $item['id_riwayat_jabatan'] ? "" : "disabled"  ?> autocomplete="off">
                                        <?php else : ?>
                                            <input type="text" name="<?= $col ?>" value="<?= strtoupper($item[$col]) ?>" <?= $edit == 'edit-rwy-jbt-' . $item['id_riwayat_jabatan'] ? "" : "disabled"  ?>>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <input type="text" name="nip" value="<?= $nip ?>" hidden>
                                <input type="text" value="<?= $item['id_riwayat_jabatan'] ?>" name="id_riwayat_jabatan" hidden>
                                <input type="text" value="riwayat_jabatan" name="table" hidden>
                            </tr>
                            </form>
                        <?php endforeach; ?>

                        <?php if ($edit == 'add-rwy-jbt') : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <form action="<?= base_url('/menu/addItemRiwayat') ?>" method="POST">
                                        <button type="submit">nice!</button>
                                </td>

                                <?php foreach ($colRwyJabatan as $name => $col) : ?>
                                    <td class="d-inline">
                                        <?php if ($name == "jabatan") : ?>
                                            <input type="text" list="<?= 'list' . ucwords($name) . 'Option' ?>" name="<?= 'id_' . $name ?>" autocomplete="off">
                                        <?php else : ?>
                                            <input type="text" name="<?= $col ?>">
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <input type="text" name="nip" value="<?= $nip ?>" hidden>
                                <input type="text" value="riwayat_jabatan" name="table" hidden>
                            </tr>
                            </form>
                        <?php endif ?>
                    </tbody>
                </table>
                <a href="<?= base_url('/menu/lihatdetail/' . $nip . '/add-rwy-jbt') ?>" class="uk-button ">Tambah data baru</a>
            </li>

            <!-- ///////////////////////////////////ini penempatan ///////////////////////////////////////////////// -->

            <li>
                <table class="uk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>action</th>
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
                                <td class="inline">
                                    <?php if ($edit != 'edit-rwy-pnm-' . $item['id_riwayat_penempatan']) : ?>
                                        <a href="<?= base_url('/menu/lihatdetail/' . $umum['nip'] . '/edit-rwy-pnm-' . $item['id_riwayat_penempatan']) ?>" class="uk-icon-link text-primary" uk-icon="file-edit"></a>
                                        <a href="#" class="uk-icon-link text-danger" uk-icon="trash"></a>
                                    <?php else : ?>
                                        <form action="<?= base_url('/menu/editItemRiwayat') ?>" method="POST">
                                            <button type="submit">nice!</button>
                                        <?php endif; ?>
                                </td>

                                <?php foreach ($colRwyPenempatan as $name => $col) : ?>
                                    <td class="">
                                        <?php if ($name == "satker" || $name == "bagian" || $name == "subbag") : ?>
                                            <input type="text" list="<?= 'list' . ucwords($name) . 'Option' ?>" name="<?= 'id_' . $name ?>" value="<?= $item['id_' . $name] . " - " . $item['nama_' . $name] ?>" <?= $edit == 'edit-rwy-pnm-' . $item['id_riwayat_penempatan'] ? "" : "disabled"  ?> autocomplete="off">
                                        <?php else : ?>
                                            <input type="text" name="<?= $col ?>" value="<?= strtoupper($item[$col]) ?>" <?= $edit == 'edit-rwy-pnm-' . $item['id_riwayat_penempatan'] ? "" : "disabled"  ?>>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <input type="text" name="nip" value="<?= $nip ?>" hidden>
                                <input type="text" value="<?= $item['id_riwayat_penempatan'] ?>" name="id_riwayat_penempatan" hidden>
                                <input type="text" value="riwayat_penempatan" name="table" hidden>
                            </tr>
                            </form>
                        <?php endforeach; ?>

                        <?php if ($edit == 'add-rwy-pnm') : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <form action="<?= base_url('/menu/addItemRiwayat') ?>" method="POST">
                                        <button type="submit">nice!</button>
                                </td>

                                <?php foreach ($colRwyPenempatan as $name => $col) : ?>
                                    <td>
                                        <?php if ($name == "satker" || $name == "bagian" || $name == "subbag") : ?>
                                            <input type="text" list="<?= 'list' . ucwords($name) . 'Option' ?>" name="<?= 'id_' . $name ?>" autocomplete="off">
                                        <?php else : ?>
                                            <input type="text" name="<?= $col ?>">
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <input type="text" name="nip" value="<?= $nip ?>" hidden>
                                <input type="text" value="riwayat_penempatan" name="table" hidden>
                            </tr>
                            </form>
                        <?php endif ?>

                    </tbody>
                </table>
                <a href="<?= base_url('/menu/lihatdetail/' . $nip . '/add-rwy-pnm') ?>" class="uk-button ">Tambah data baru</a>
            </li>

            <!-- ///////////////////////////////////ini golongan ///////////////////////////////////////////////// -->


            <li>
                <table class="uk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>action</th>
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
                                <td class="inline">
                                    <?php if ($edit != 'edit-rwy-gol-' . $item['id_riwayat_golongan']) : ?>
                                        <a href="<?= base_url('/menu/lihatdetail/' . $umum['nip'] . '/edit-rwy-gol-' . $item['id_riwayat_golongan']) ?>" class="uk-icon-link text-primary" uk-icon="file-edit"></a>
                                        <a href="#" class="uk-icon-link text-danger" uk-icon="trash"></a>
                                    <?php else : ?>
                                        <form action="<?= base_url('/menu/editItemRiwayat') ?>" method="POST">
                                            <button type="submit">nice!</button>
                                        <?php endif; ?>
                                </td>

                                <?php foreach ($colRwyGolongan as $name => $col) : ?>
                                    <td class="">
                                        <?php if ($name == "golongan") : ?>
                                            <input type="text" list="<?= 'list' . ucwords($name) . 'Option' ?>" name="<?= 'id_' . $name ?>" value="<?= $item['id_' . $name] . " - " . $item['pangkat'] ?>" <?= $edit == 'edit-rwy-gol-' . $item['id_riwayat_golongan'] ? "" : "disabled"  ?> autocomplete="off">
                                        <?php else : ?>
                                            <input type="text" name="<?= $col ?>" value="<?= strtoupper($item[$col]) ?>" <?= $edit == 'edit-rwy-gol-' . $item['id_riwayat_golongan'] ? "" : "disabled"  ?>>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <input type="text" name="nip" value="<?= $nip ?>" hidden>
                                <input type="text" value="<?= $item['id_riwayat_golongan'] ?>" name="id_riwayat_golongan" hidden>
                                <input type="text" value="riwayat_golongan" name="table" hidden>
                            </tr>
                            </form>
                        <?php endforeach; ?>

                        <?php if ($edit == 'add-rwy-gol') : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <form action="<?= base_url('/menu/addItemRiwayat') ?>" method="POST">
                                        <button type="submit">nice!</button>
                                </td>

                                <?php foreach ($colRwyGolongan as $name => $col) : ?>
                                    <td>
                                        <?php if ($name == "golongan") : ?>
                                            <input type="text" list="<?= 'list' . ucwords($name) . 'Option' ?>" name="<?= 'id_' . $name ?>" autocomplete="off">
                                        <?php else : ?>
                                            <input type="text" name="<?= $col ?>">
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <input type="text" name="nip" value="<?= $nip ?>" hidden>
                                <input type="text" value="riwayat_golongan" name="table" hidden>
                            </tr>
                            </form>
                        <?php endif ?>


                    </tbody>
                </table>
                <a href="<?= base_url('/menu/lihatdetail/' . $nip . '/add-rwy-gol') ?>" class="uk-button ">Tambah data baru</a>
            </li>
            <li>Bazinga!</li>
        </ul>


    </div>
</div>
<?= $this->endSection(); ?>