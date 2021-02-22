<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2><?= $title ?></h2>

<div class="search-filter">
    <form action="<?= base_url('menu/searchDataPegawai') ?>" method="POST">
        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: search"></span>
                <input class="uk-input" type="text" name="keyword" id="keyword">
            </div>

            <button type="submit" class="uk-button btn-primary">Search</button>
            <a class="uk-button btn-secondary" data-bs-toggle="collapse" href="#collapse-filter" role="button" aria-expanded="false" aria-controls="collapse-filter">Filter</a>

            <div class="collapse m-4" id="collapse-filter">
                <div class="uk-card uk-card-default uk-padding uk-border-rounded">
                    <h4>Kolom</h4>
                    <div class="uk-flex" uk-grid>
                        <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="agama" name="agama">Agama</label>
                        <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="Tempat Lahir" name="ttl">Tanggal Lahir</label>
                    </div>
                    <h4>Filter</h4>
                    <div class="uk-flex" uk-grid>
                        <div class="satker-grid uk-flex uk-flex-column">
                            <div>Jabatan</div>
                            <?php foreach ($jabatan as $item) : ?>
                                <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="<?= $item['nama_jabatan'] ?>" name="<?= "filter-nama_jabatan-" . $item['nama_jabatan'] ?>"><?= $item['nama_jabatan'] ?></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="satker-grid uk-flex uk-flex-column">
                            <div>Golongan dan Pangkat</div>
                            <?php foreach ($pangkat_golongan as $item) : ?>
                                <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="<?= $item['id_golongan'] ?>" name="<?= "filter-s@id_golongan-" . $item['id_golongan'] ?>"><?= $item['id_golongan'] ?></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="satker-grid uk-flex uk-flex-column">
                            <div>Satuan Kerja</div>
                            <?php foreach ($satker as $item) : ?>
                                <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="<?= $item['nama_satker'] ?>" name="<?= "filter-nama_satker-" . $item['nama_satker'] ?>"><?= $item['nama_satker'] ?></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="satker-grid uk-flex uk-flex-column">
                            <div>Bagian</div>
                            <?php foreach ($bagian as $item) : ?>
                                <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="<?= $item['nama_bagian'] ?>" name="<?= "filter-nama_bagian-" . $item['nama_bagian'] ?>"><?= $item['nama_bagian'] ?></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="satker-grid uk-flex uk-flex-column">
                            <div>Golongan dan Pangkat</div>
                            <?php foreach ($subbag as $item) : ?>
                                <label><input class="uk-checkbox uk-margin-small-right" type="checkbox" value="<?= $item['nama_subbag'] ?>" name="<?= "filter-nama_subbag-" . $item['nama_subbag'] ?>"><?= $item['nama_subbag'] ?></label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div>

            </div>

        </div>
    </form>
</div>




<div>
    <table class="uk-table uk-table-hover uk-box-shadow-small">
        <thead class="uk-background-secondary">
            <tr>
                <th>No.</th>
                <th>Action</th>
                <?php foreach ($columns as $column => $field) : ?>
                    <th><?= $column ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($dataPegawai as $pegawai) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td>
                        <a href="<?= base_url('/detail_pegawai/' . $pegawai['nip']) ?>" class="uk-text-primary uk-margin-small-right" uk-icon="icon: file-text"></a>
                        <a href="<?= base_url('/menu/delete/' . $pegawai['nip'] . "/nip/pegawai") ?>" class="uk-text-danger" uk-icon="icon: trash"></a>
                    </td>
                    <?php foreach ($columns as $key => $col) : ?>
                        <td><?= strtoupper($pegawai[$col == 'p.nip' ? 'nip' :  $col]) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>



<?= $this->endSection(); ?>