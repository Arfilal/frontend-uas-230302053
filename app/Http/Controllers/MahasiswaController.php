<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8080/']);
    }

    public function index()
    {
        try {
            $response = $this->client->get('mahasiswa');
            $mahasiswa = json_decode($response->getBody()->getContents(), true);
            return view('mahasiswa.index', compact('mahasiswa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $kelasResponse = $this->client->get('kelas');
            $prodiResponse = $this->client->get('prodi');
            $kelas = json_decode($kelasResponse->getBody()->getContents(), true);
            $prodi = json_decode($prodiResponse->getBody()->getContents(), true);
            return view('mahasiswa.create', compact('kelas', 'prodi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data kelas atau prodi: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required|string|max:30|unique:mahasiswa,npm',
            'nama_mahasiswa' => 'required|string|max:50',
            'id_kelas' => 'required|integer',
            'kode_prodi' => 'required|string|max:8',
        ]);

        try {
            $response = $this->client->post('mahasiswa', ['form_params' => $data]);
            if ($response->getStatusCode() == 201) {
                return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan mahasiswa.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan mahasiswa: ' . $e->getMessage());
        }
    }

    public function edit($npm)
    {
        try {
            $mahasiswaResponse = $this->client->get("mahasiswa/{$npm}");
            $kelasResponse = $this->client->get('kelas');
            $prodiResponse = $this->client->get('prodi');
            $mahasiswa = json_decode($mahasiswaResponse->getBody()->getContents(), true);
            $kelas = json_decode($kelasResponse->getBody()->getContents(), true);
            $prodi = json_decode($prodiResponse->getBody()->getContents(), true);

            if (is_array($mahasiswa) && isset($mahasiswa['npm'])) {
                return view('mahasiswa.edit', compact('mahasiswa', 'kelas', 'prodi'));
            } else {
                return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $npm)
    {
        $data = $request->validate([
            'nama_mahasiswa' => 'required|string|max:50',
            'id_kelas' => 'required|integer',
            'kode_prodi' => 'required|string|max:8',
        ]);

        try {
            $response = $this->client->put("mahasiswa/{$npm}", ['form_params' => $data]);
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('mahasiswa.index')->with('success', $responseData['message'] ?? 'Mahasiswa berhasil diperbarui.');
            } else {
                $errorMessage = $responseData['error'] ?? 'Gagal memperbarui mahasiswa.';
                return redirect()->route('mahasiswa.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal memperbarui mahasiswa: ' . $e->getMessage());
        }
    }

    public function destroy($npm)
    {
        try {
            $response = $this->client->delete("mahasiswa/{$npm}");
            if ($response->getStatusCode() == 200) {
                return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus mahasiswa.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus mahasiswa: ' . $e->getMessage());
        }
    }
}