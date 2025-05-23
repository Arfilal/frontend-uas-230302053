<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8080/']);
    }

    public function index()
    {
        try {
            $response = $this->client->get('prodi');
            $prodi = json_decode($response->getBody()->getContents(), true);
            return view('prodi.index', compact('prodi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_prodi' => 'required|string|max:8|unique:prodi,kode_prodi',
            'nama_prodi' => 'required|string|max:100',
        ]);

        try {
            $response = $this->client->post('prodi', ['form_params' => $data]);
            if ($response->getStatusCode() == 201) {
                return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan prodi.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan prodi: ' . $e->getMessage());
        }
    }

    public function edit($kode_prodi)
    {
        try {
            $response = $this->client->get("prodi/{$kode_prodi}");
            $prodi = json_decode($response->getBody()->getContents(), true);

            if (is_array($prodi) && isset($prodi['kode_prodi'])) {
                return view('prodi.edit', compact('prodi'));
            } else {
                return redirect()->route('prodi.index')->with('error', 'Data prodi tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $kode_prodi)
    {
        $data = $request->validate([
            'nama_prodi' => 'required|string|max:100',
        ]);

        try {
            $response = $this->client->put("prodi/{$kode_prodi}", ['form_params' => $data]);
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('prodi.index')->with('success', $responseData['message'] ?? 'Prodi berhasil diperbarui.');
            } else {
                $errorMessage = $responseData['error'] ?? 'Gagal memperbarui prodi.';
                return redirect()->route('prodi.index')->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')->with('error', 'Gagal memperbarui prodi: ' . $e->getMessage());
        }
    }

    public function destroy($kode_prodi)
    {
        try {
            $response = $this->client->delete("prodi/{$kode_prodi}");
            if ($response->getStatusCode() == 200) {
                return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus prodi.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus prodi: ' . $e->getMessage());
        }
    }
}