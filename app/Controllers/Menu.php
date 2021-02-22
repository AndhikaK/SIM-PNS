<?php

namespace App\Controllers;

use App\Models\PoldaModel;

class Menu extends BaseController
{
	protected $poldaModel;

	public function __construct()
	{
		$this->poldaModel = new PoldaModel();
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

		$dataPegawai = $this->poldaModel->searchData($keyword, $columns, $filterItem);

		$data = [
			'title' => 'Data Pegawai',
			'columns' => $columns,
			'dataPegawai' => $dataPegawai,
			'jabatan' => $this->poldaModel->getAllData('jabatan'),
			'pangkat_golongan' => $this->poldaModel->getAllData('golongan_pangkat'),
			'satker' => $this->poldaModel->getAllData('satker'),
			'bagian' => $this->poldaModel->getAllData('bagian'),
			'subbag' => $this->poldaModel->getAllData('subbag')
		];

		return view('view/search_pegawai', $data);
	}

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
			return redirect()->to(base_url("/menu/lihat-struktur/" . $table));
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

	public function lihatDetail($nip)
	{
		$dataUmum = $this->poldaModel->lihatDetailPegawai($nip);

		$data = [
			'title' => 'Detail PNS',
			'umum' => $dataUmum[0]
		];

		return view('view/detail_pegawai', $data);
	}
}
