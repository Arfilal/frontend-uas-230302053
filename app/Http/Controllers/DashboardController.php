<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class DashboardController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8080/']);
    }

    public function index()
    {
        try {
            $kelasResponse = $this->client->get('kelas');
            $matkulResponse = $this->client->get('matkul');
            $prodiResponse = $this->client->get('prodi');
            $mahasiswaResponse = $this->client->get('mahasiswa');

            $kelas = json_decode($kelasResponse->getBody()->getContents(), true);
            $matkul = json_decode($matkulResponse->getBody()->getContents(), true);
            $prodi = json_decode($prodiResponse->getBody()->getContents(), true);
            $mahasiswa = json_decode($mahasiswaResponse->getBody()->getContents(), true);

            return view('dashboard.index', compact('kelas', 'matkul', 'prodi', 'mahasiswa'));
        } catch (\Exception $e) {
            return view('dashboard.index', ['kelas' => [], 'matkul' => [], 'prodi' => [], 'mahasiswa' => []])
                ->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }
}