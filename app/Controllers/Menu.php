<?php

namespace App\Controllers;

use App\Models\PoldaModel;
use App\Models\RwyPenempatanModel;
use App\Models\RwyGolonganModel;
use App\Models\RwyJabatanModel;
use CodeIgniter\Database\Query;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Menu extends BaseController
{
	protected $poldaModel;
	protected $rwyPenempatanModel;
	protected $rwyJabatanModel;
	protected $rwyGolonganModel;


	public function __construct()
	{
		$this->poldaModel = new PoldaModel();
		$this->rwyPenempatanModel = new RwyPenempatanModel();
		$this->rwyJabatanModel = new RwyJabatanModel();
		$this->rwyGolonganModel = new RwyGolonganModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Beranda'
		];

		return view('view/index', $data);
	}

	public function dataPegawai()
	{
		$columns = [
			'NIP' => 'p.nip', 'Nama Pegawai' => 'nama_pegawai', 'Golongan - Pangkat' => 'pangkat', 'Jabatan' => 'nama_jabatan', 'Satuan Kerja' => 'nama_satker', 'Bagian' => 'nama_bagian', 'Sub Bagian' => 'nama_subbag'
		];

		$pegawai = $this->poldaModel->getDataFromKey($columns);

		$data = [
			'title' => 'Data Pegawai',
			'columns' => $columns,
			'dataPegawai' => $pegawai,
			'jabatan' => $this->poldaModel->getAllData('jabatan'),
			'pangkat_golongan' => $this->poldaModel->getAllData('golongan_pangkat'),
			'satker' => $this->poldaModel->getAllData('satker'),
			'bagian' => $this->poldaModel->getAllData('bagian'),
			'subbag' => $this->poldaModel->getAllData('subbag')
		];

		return view('view/data_pegawai', $data);
	}

	public function searchDataPegawai()
	{
		$keyword = $this->request->getVar('keyword');
		$filterData = $this->request->getVar();
		$filterItem = array();

		$columns = [
			'NIP' => 'p.nip', 'Nama Pegawai' => 'nama_pegawai', 'Golongan - Pangkat' => 'pangkat', 'Jabatan' => 'nama_jabatan', 'Satuan Kerja' => 'nama_satker', 'Bagian' => 'nama_bagian', 'Sub Bagian' => 'nama_subbag'
		];

		foreach ($filterData as $name => $value) {
			if ($name != 'keyword') {
				if (!str_contains($name, 'filter')) {
					$columns[$value] = $name;
				} else {
					$name = explode("-", $name);
					$name = $name[1];
					$filterItem[$value] = $name;
				}
			}
		}

		$searchData = $this->poldaModel->searchData($keyword, $columns, $filterItem);
		$dataPegawai = $searchData[0];
		$searchQuery = $searchData[1];

		$data = [
			'title' => 'Data Pegawai',
			'columns' => $columns,
			'dataPegawai' => $dataPegawai,
			'jabatan' => $this->poldaModel->getAllData('jabatan'),
			'pangkat_golongan' => $this->poldaModel->getAllData('golongan_pangkat'),
			'satker' => $this->poldaModel->getAllData('satker'),
			'bagian' => $this->poldaModel->getAllData('bagian'),
			'subbag' => $this->poldaModel->getAllData('subbag'),
			'searchQuery' => $searchQuery
		];


		return view('view/search_pegawai', $data);
	}

	// ini buat testing
	public function testingPage()
	{
		$cities = array("France" => "Paris", "India" => "Mumbai", "UK" => "London", "USA" => "New York");

		d($cities);
		d(array_keys($cities));

		$data = [
			'title' => 'Testing page'
		];

		// return view('view/testing_page', $data);
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
			return redirect()->to(base_url('/data_pegawai'));
		} else {
			// return redirect()->to(base_url('/menu/test'));
			return redirect()->to(base_url("/data_master/" . $table));
		}
	}

	public function tambah_pegawai()
	{
		$data = [
			'title' => 'Tambah Data Pegawai',
			'jabatan' => $this->poldaModel->getAllData('jabatan'),
			'pangkat_golongan' => $this->poldaModel->getAllData('golongan_pangkat'),
			'satker' => $this->poldaModel->getAllData('satker'),
			'bagian' => $this->poldaModel->getAllData('bagian'),
			'subbag' => $this->poldaModel->getAllData('subbag')
		];

		return view('view/input_pegawai', $data);
	}

	public function tambahDataPegawai()
	{
		// field to be inputed by data specified by table
		$fieldPegawai = $this->poldaModel->getTableCollumn('pegawai');	// all field of table pegawai
		$fieldPenempatan = ['nip', 'id_satker', 'id_bagian', 'id_subbag', 'tanggal_mulai'];
		$fieldJabatan = ['nip', 'id_jabatan', 'tahun'];
		$fieldGolongan = ['nip', 'id_golongan', 'tahun'];

		$dataPegawai = array();
		$dataPenempatan = array();
		$dataJabatan = array();
		$dataGolongan = array();

		// format untuk tabel pegawai
		$tahunLahir = $this->request->getVar('tahun_lahir');
		$bulanLahir = $this->request->getVar('bulan_lahir');
		$tanggalLahir = $this->request->getVar('tanggal_lahir');
		$ttl = $tahunLahir . "-" . $bulanLahir . "-" . $tanggalLahir;
		$jabatan = explode(" ", $this->request->getVar('jabatan'));
		$golongan = explode(" ", $this->request->getVar('pangkat_gol'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($fieldPegawai as $field) {
			if ($field == 'ttl') {
				$dataPegawai[$field] = $ttl;
			} elseif ($field == 'jabatan') {
				$dataPegawai[$field] = $jabatan[0];
			} elseif ($field == 'id_satker') {
				$dataPegawai[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$dataPegawai[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$dataPegawai[$field] = $subbag[0];
			} else {
				$dataPegawai[$field] = $this->request->getVar($field);
			}
		}


		foreach ($fieldPenempatan as $field) {
			if ($field == 'id_satker') {
				$dataPenempatan[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$dataPenempatan[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$dataPenempatan[$field] = $subbag[0];
			} elseif ($field == 'tanggal_mulai') {
				$dataPenempatan[$field] = '1000/01/02';
			} else {
				$dataPenempatan[$field] = $this->request->getVar($field);
			}
		}

		foreach ($fieldJabatan as $field) {
			if ($field == 'id_jabatan') {
				$dataJabatan[$field] = $jabatan[0];
			} elseif ($field == 'tahun') {
				$dataJabatan[$field] = '1000';
			} else {
				$dataJabatan[$field] = $this->request->getVar($field);
			}
		}

		foreach ($fieldGolongan as $field) {
			if ($field == 'id_golongan') {
				$dataGolongan[$field] = $golongan[0];
			} elseif ($field == 'tahun') {
				$dataGolongan[$field] = '1000';
			} else {
				$dataGolongan[$field] = $this->request->getVar($field);
			}
		}

		try {
			if (
				$this->poldaModel->insertDataArray('pegawai', $dataPegawai) > 0 &&
				$this->poldaModel->insertDataArray('riwayat_penempatan', $dataPenempatan) > 0 &&
				$this->poldaModel->insertDataArray('riwayat_jabatan', $dataJabatan) > 0 &&
				$this->poldaModel->insertDataArray('riwayat_golongan', $dataGolongan) > 0
			) {
				session()->setFlashData('success', 'Tambah data berhasil!');
			} else {
				session()->setFlashData('error', 'Tambah data gagal!');
			}
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		return redirect()->to(base_url('/tambah_data_pegawai'));
	}

	public function lihatDetail($nip, $edit = null)
	{
		$dataUmum = $this->poldaModel->lihatDetailPegawai($nip);
		$fieldRwyPenempatan = [
			'sk' => 'no_sk', 'satker' => 'nama_satker', 'bagian' => 'nama_bagian', 'subbag' => 'nama_subbag', 'mulai' => 'tanggal_mulai', 'selesai' => 'tanggal_selesai'
		];

		$fieldRwyJabatan = [
			'sk' => 'no_sk', 'jabatan' => 'nama_jabatan', 'tahun' => 'tahun'
		];
		$fieldRwyGolongan = [
			'sk' => 'no_sk', 'golongan' => 'id_golongan', 'tahun' => 'tahun'
		];

		$fieldRwyPendidikan = [];

		$data = [
			'title' => 'Detail PNS',
			'umum' => $dataUmum[0],
			'edit' => $edit,
			'nip' => $nip,
			'jabatan' => $this->poldaModel->getAllData('jabatan'),
			'pangkat_golongan' => $this->poldaModel->getAllData('golongan_pangkat'),
			'satker' => $this->poldaModel->getAllData('satker'),
			'bagian' => $this->poldaModel->getAllData('bagian'),
			'subbag' => $this->poldaModel->getAllData('subbag'),
			'colRwyPenempatan' => $fieldRwyPenempatan,
			'colRwyJabatan' => $fieldRwyJabatan,
			'colRwyGolongan' => $fieldRwyGolongan,
			'riwayatPenempatan' => $this->rwyPenempatanModel->getRiwayat($dataUmum[0]['nip']),
			'riwayatJabatan' => $this->rwyJabatanModel->getRiwayat($dataUmum[0]['nip']),
			'riwayatGolongan' => $this->rwyGolonganModel->getRiwayat($dataUmum[0]['nip'])

		];


		return view('view/detail_pegawai', $data);
	}

	public function dataMaster($struktur)
	{
		$data = [
			'title' => 'Lihat Struktur Organisasi',
			'fields' => $this->poldaModel->getTableCollumn($struktur),
			'data' => $this->poldaModel->getAllData($struktur),
			'dropdownItem' => $struktur
		];

		return view('view/data_master', $data);
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
			if ($this->poldaModel->insertDataArray($table, $data) > 0) {
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
			return redirect()->to(base_url("/data_master/" . $table));
		}
	}

	public function exportQuery()
	{
		// dd('ini a pa ');
		$spreadsheet = new Spreadsheet();

		$query = $this->request->getVar('searchQuery');
		$data = $this->poldaModel->executeQuery($query);

		$column = array();

		$colAlpha = "A";
		foreach ($data[0] as $name => $value) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue($colAlpha++ . '1', $name);
			array_push($column, $name);
		}

		$colNum = 2;
		foreach ($data as $row) {
			$colAlpha = "A";
			foreach ($column as $col) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue($colAlpha++ . $colNum, $row[$col]);
			}
			$colNum++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'Data';


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function updateDetail()
	{
		// field to be inputed by data specified by table
		$fieldPegawai = $this->poldaModel->getTableCollumn('pegawai');	// all field of table pegawai
		$fieldPenempatan = ['id_riwayat_penempatan', 'nip', 'id_satker', 'id_bagian', 'id_subbag', 'tanggal_mulai'];
		$fieldJabatan = ['id_riwayat_jabatan', 'nip', 'id_jabatan', 'tahun'];
		$fieldGolongan = ['id_riwayat_golongan', 'nip', 'id_golongan', 'tahun'];

		$dataPegawai = array();
		$dataPenempatan = array();
		$dataJabatan = array();
		$dataGolongan = array();

		// format untuk tabel pegawai
		$tahunLahir = $this->request->getVar('tahun_lahir');
		$bulanLahir = $this->request->getVar('bulan_lahir');
		$tanggalLahir = $this->request->getVar('tanggal_lahir');
		$ttl = $tahunLahir . "-" . $bulanLahir . "-" . $tanggalLahir;
		$jabatan = explode(" ", $this->request->getVar('jabatan'));
		$golongan = explode(" ", $this->request->getVar('pangkat_gol'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($fieldPegawai as $field) {
			if ($field == 'ttl') {
				$dataPegawai[$field] = $ttl;
			} elseif ($field == 'jabatan') {
				$dataPegawai[$field] = $jabatan[0];
			} elseif ($field == 'id_satker') {
				$dataPegawai[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$dataPegawai[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$dataPegawai[$field] = $subbag[0];
			} else {
				$dataPegawai[$field] = $this->request->getVar($field);
			}
		}


		foreach ($fieldPenempatan as $field) {
			if ($field == 'id_satker') {
				$dataPenempatan[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$dataPenempatan[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$dataPenempatan[$field] = $subbag[0];
			} elseif ($field == 'tanggal_mulai') {
				$dataPenempatan[$field] = '1000/01/02';
			} else {
				$dataPenempatan[$field] = $this->request->getVar($field);
			}
		}

		foreach ($fieldJabatan as $field) {
			if ($field == 'id_jabatan') {
				$dataJabatan[$field] = $jabatan[0];
			} elseif ($field == 'tahun') {
				$dataJabatan[$field] = '1000';
			} else {
				$dataJabatan[$field] = $this->request->getVar($field);
			}
		}

		foreach ($fieldGolongan as $field) {
			if ($field == 'id_golongan') {
				$dataGolongan[$field] = $golongan[0];
			} elseif ($field == 'tahun') {
				$dataGolongan[$field] = '1000';
			} else {
				$dataGolongan[$field] = $this->request->getVar($field);
			}
		}

		// dd($dataPegawai);

		try {
			if (
				$this->poldaModel->updateDataArray('pegawai', $dataPegawai) > 0 &&
				$this->poldaModel->updateDataRiwayat('riwayat_penempatan', $dataPenempatan) > 0 &&
				$this->poldaModel->updateDataRiwayat('riwayat_jabatan', $dataJabatan) > 0 &&
				$this->poldaModel->updateDataRiwayat('riwayat_golongan', $dataGolongan) > 0
			) {
				session()->setFlashData('success', 'Update data berhasil!');
			} else {
				session()->setFlashData('error', 'Update data gagal!');
			}
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		return redirect()->to(base_url('detail_pegawai/' . $dataPegawai['nip']));
	}

	public function editItemRiwayat()
	{

		$table = $this->request->getVar('table');
		$tableCol = $this->poldaModel->getTableCollumn($table);

		$dataRiwayat = array();

		$jabatan = explode(" ", $this->request->getVar('id_jabatan'));
		$golongan = explode(" ", $this->request->getVar('id_golongan'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($tableCol as $field) {
			if ($field == 'id_satker') {
				$dataRiwayat[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$dataRiwayat[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$dataRiwayat[$field] = $subbag[0];
			} elseif ($field == 'id_jabatan') {
				$dataRiwayat[$field] = $jabatan[0];
			} elseif ($field == 'id_golongan') {
				$dataRiwayat[$field] = $golongan[0];
			} else {
				$dataRiwayat[$field] = $this->request->getVar($field);
			}
		}

		try {
			$this->poldaModel->updateItemRiwayatTable($table, $dataRiwayat);
			session()->setFlashData('success', 'Update data berhasil!');
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		return redirect()->to(base_url('detail_pegawai/' . $dataRiwayat['nip']));
	}

	public function addItemRiwayat()
	{
		$table = $this->request->getVar('table');
		$tableCol = $this->poldaModel->getTableCollumn($table);

		$dataRiwayat = array();

		$jabatan = explode(" ", $this->request->getVar('id_jabatan'));
		$golongan = explode(" ", $this->request->getVar('id_golongan'));
		$satker = explode(" ", $this->request->getVar('id_satker'));
		$bagian = explode(" ", $this->request->getVar('id_bagian'));
		$subbag = explode(" ", $this->request->getVar('id_subbag'));

		foreach ($tableCol as $field) {
			if ($field == 'id_satker') {
				$dataRiwayat[$field] = $satker[0];
			} elseif ($field === "id_bagian") {
				$dataRiwayat[$field] = $bagian[0];
			} elseif ($field == 'id_subbag') {
				$dataRiwayat[$field] = $subbag[0];
			} elseif ($field == 'id_jabatan') {
				$dataRiwayat[$field] = $jabatan[0];
			} elseif ($field == 'id_golongan') {
				$dataRiwayat[$field] = $golongan[0];
			} else {
				$dataRiwayat[$field] = $this->request->getVar($field);
			}
		}

		try {
			$this->poldaModel->insertDataArray($table, $dataRiwayat);
			session()->setFlashData('success', 'Update data berhasil!');
		} catch (\Exception $e) {
			session()->setFlashData('error', $e->getMessage());
		}

		return redirect()->to(base_url('detail_pegawai/' . $dataRiwayat['nip']));
	}

	public function test()
	{
		dd($this->request->getVar());
	}
}
