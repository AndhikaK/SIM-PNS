<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\BagianModel;
use App\Models\JabatanModel;
use App\Models\PangkatModel;
use App\Models\PNSModel;
use App\Models\PoldaModel;
use App\Models\SatkerModel;
use App\Models\SubbagModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class Home extends BaseController
{
	protected $poldaModel;
	protected $pnsModel;
	protected $jabatanModel;
	protected $satkerModel;
	protected $bagianModel;
	protected $subbagModel;
	protected $pangkatModel;

	public function __construct()
	{
		$this->poldaModel = new PoldaModel();
		$this->pnsModel = new PNSModel();
		$this->jabatanModel = new JabatanModel();
		$this->satkerModel = new SatkerModel();
		$this->bagianModel = new BagianModel();
		$this->subbagModel = new SubbagModel();
		$this->pangkatModel = new PangkatModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Ini adalah judul'
		];

		return view('polda/index', $data);
	}

	public function lihatData()
	{
		$pegawai = $this->poldaModel->getTableCollumn('pegawai');
		for ($i = 0; $i < count($pegawai); $i++) {
			if (str_contains($pegawai[$i], 'id')) {
				$pegawai[$i] = str_replace('id', 'nama', $pegawai[$i]);
			}
		}

		$data = [
			'title' => 'Lihat Data PNS',
			'fields' => $pegawai,
			'pegawai' => $this->pnsModel->getPegawai()
		];


		return view('polda/lihat-data', $data);
	}


	public function lihatDataUK()
	{


		$pegawai = $this->poldaModel->lihatDataPegawai();

		$data = [
			'title' => 'Lihat Data PNS',
			'pegawai' => $pegawai
		];

		return view('polda/lihat-data-uk', $data);
	}

	public function inputData()
	{
		$data = [
			'title' => 'Input Data PNS',
			'jabatan' => $this->jabatanModel->getJabatan(),
			'satker' => $this->satkerModel->getSatker(),
			'bagian' => $this->bagianModel->getBagian(),
			'subbag' => $this->subbagModel->getSubbag(),
			'pangkat_golongan' => $this->pangkatModel->getPangkat()
		];

		return view('polda/input-data', $data);
	}

	public function lihatStruktur($struktur)
	{
		$data = [
			'title' => 'Lihat Struktur Organisasi',
			'fields' => $this->poldaModel->getTableCollumn($struktur),
			'data' => $this->poldaModel->getTableData($struktur),
			'dropdownItem' => $struktur
		];

		return view('polda/lihat-struktur', $data);
	}

	public function test()
	{
		$data = [
			'title' => 'ini Testing'
		];

		return view('polda/testing', $data);
	}


	public function tambahData($struktur)
	{
		$fields = $this->poldaModel->getTableCollumn($struktur);
		$data = array();

		// format untuk tabel pegawai
		$tahunLahir = $this->request->getVar('tahun_lahir');
		$bulanLahir = $this->request->getVar('bulan_lahir');
		$tanggalLahir = $this->request->getVar('tanggal_lahir');
		$ttl = $tahunLahir . "-" . $bulanLahir . "-" . $tanggalLahir;
		$jabatan = explode(" ", $this->request->getVar('jabatan'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($fields as $field) {
			if ($field == 'ttl') {
				$data[$field] = $ttl;
			} elseif ($field == 'jabatan') {
				$data[$field] = $jabatan[0];
			} elseif ($field == 'id_satker') {
				$data[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$data[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$data[$field] = $subbag[0];
			} else {
				$data[$field] = $this->request->getVar($field);
			}
		}

		$rowsAffected = 0;
		switch ($struktur) {
			case $struktur == 'satker':
				$this->satkerModel->save($data);
				break;
			case $struktur == 'bagian':
				$this->bagianModel->save($data);
				break;
			case $struktur == 'subbag':
				$this->subbagModel->save($data);
				break;
			case $struktur == 'jabatan':
				$this->jabatanModel->save($data);
				$rowsAffected = $this->jabatanModel->getRows();
				break;
			case $struktur == 'golongan':
				$this->pangkatModel->save($data);
				break;
			case $struktur == 'pegawai':
				$this->pnsModel->save($data);
				break;
		}


		if ($struktur == 'pegawai') {
			return redirect()->to(base_url('/menu/input-data'));
		} else {
			return redirect()->to(base_url("/menu/lihat-struktur/" . $struktur))->with('success', 'Tambah data berhasil, result ' . $result);
		}
	}

	public function tambahDataDua($table)
	{
		$fieldPegawai = $this->poldaModel->getTableCollumn($table);
		$data = array();

		// format untuk tabel pegawai
		$tahunLahir = $this->request->getVar('tahun_lahir');
		$bulanLahir = $this->request->getVar('bulan_lahir');
		$tanggalLahir = $this->request->getVar('tanggal_lahir');
		$ttl = $tahunLahir . "-" . $bulanLahir . "-" . $tanggalLahir;
		$jabatan = explode(" ", $this->request->getVar('jabatan'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($fieldPegawai as $field) {
			if ($field == 'ttl') {
				$data[$field] = $ttl;
			} elseif ($field == 'jabatan') {
				$data[$field] = $jabatan[0];
			} elseif ($field == 'id_satker') {
				$data[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$data[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$data[$field] = $subbag[0];
			} else {
				$data[$field] = $this->request->getVar($field);
			}
		}

		try {
			if ($this->poldaModel->insertData($table, $data) > 0) {
				session()->setFlashData('success', 'Tambah data berhasil!');
			} else {
				session()->setFlashData('error', 'Tambah data gagal!');
			}
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		if ($table == 'pegawai') {
			return redirect()->to(base_url('/menu/input-data'));
		} else {
			return redirect()->to(base_url("/menu/lihat-struktur/" . $table));
		}
	}

	public function tambahDataTiga($table)
	{
		$fieldPegawai = $this->poldaModel->getTableCollumn($table);
		$fieldPekerjaan = $this->poldaModel->getTableCollumn('riwayat_pekerjaan');
		$data = array();

		// format untuk tabel pegawai
		$tahunLahir = $this->request->getVar('tahun_lahir');
		$bulanLahir = $this->request->getVar('bulan_lahir');
		$tanggalLahir = $this->request->getVar('tanggal_lahir');
		$ttl = $tahunLahir . "-" . $bulanLahir . "-" . $tanggalLahir;
		$jabatan = explode(" ", $this->request->getVar('jabatan'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($fieldPegawai as $field) {
			if ($field == 'ttl') {
				$data[$field] = $ttl;
			} elseif ($field == 'jabatan') {
				$data[$field] = $jabatan[0];
			} elseif ($field == 'id_satker') {
				$data[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$data[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$data[$field] = $subbag[0];
			} else {
				$data[$field] = $this->request->getVar($field);
			}
		}

		$riwayatPekerjaan = array();
		foreach ($fieldPekerjaan as $field) {
			if ($field == 'ttl') {
				$riwayatPekerjaan[$field] = $ttl;
			} elseif ($field == 'jabatan') {
				$riwayatPekerjaan[$field] = $jabatan[0];
			} elseif ($field == 'id_satker') {
				$riwayatPekerjaan[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$riwayatPekerjaan[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$riwayatPekerjaan[$field] = $subbag[0];
			} elseif ($field == 'tanggal_mulai') {
				$riwayatPekerjaan[$field] = '1000-01-01';
			} else {
				$riwayatPekerjaan[$field] = $this->request->getVar($field);
			}
		}

		try {
			if ($this->poldaModel->insertData($table, $data) > 0) {
				session()->setFlashData('success', 'Tambah data berhasil!');
			} else {
				session()->setFlashData('error', 'Tambah data gagal!');
			}
			$this->poldaModel->insertData('riwayat_pekerjaan', $riwayatPekerjaan);
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		if ($table == 'pegawai') {
			return redirect()->to(base_url('/menu/input-data'));
		} else {
			return redirect()->to(base_url("/menu/lihat-struktur/" . $table));
		}
	}



	public function download()
	{
		$spreadsheet = new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Nama');

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A2', 'Andhika kurniawan');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Data';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function delete($id, $field, $table)
	{
		try {
			if ($this->poldaModel->deleteData($id, $field, $table) > 0) {
				session()->setFlashData('success', 'Hapus data berhasil');
			} else {
				session()->setFlashData('error', 'Hapus data gagal!');
			}
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		if ($table == 'pegawai') {
			return redirect()->to(base_url('/menu/lihat-data-uk'));
		} else {
			// return redirect()->to(base_url('/menu/test'));
			return redirect()->to(base_url("/menu/lihat-struktur/" . $table));
		}
	}

	public function lihatDetail($nip)
	{
		$dataUmum = $this->poldaModel->getDetailData('pegawai', 'nip', $nip);

		$data = [
			'title' => 'Detail PNS',
			'umum' => $dataUmum[0]
		];

		return view('polda/detail-pegawai', $data);
	}
}
