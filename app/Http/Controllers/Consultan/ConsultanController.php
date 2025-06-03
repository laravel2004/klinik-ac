<?php

namespace App\Http\Controllers\Consultan;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ConsultanController extends Controller
{
    public function diagnosaAc(Request $request)
    {
        try {

            $validated = $request->validate([
                'keluhan' => 'required|string|max:1000',
            ]);

            $services = Service::with('serviceUnit')->get();
            if ($services ->isEmpty()) {
                return response()->json([
                    'error' => 'Tidak ada layanan yang tersedia',
                ], 404);
            }

            $data = $services->map(function ($service) {
                return [
                    'service' => $service->name,
                    'satuan' => $service->serviceUnit->name,
                    'harga' => $service->price,
                ];
            })->toArray();

            $services = [
                ["service" => "Cek AC", "satuan" => "unit", "harga" => 50000],
                ["service" => "Cuci/Steam 1/2, 3/4, 1 PK", "satuan" => "unit", "harga" => 75000],
                ["service" => "Cuci/Steam 1 1/2, 2 PK", "satuan" => "unit", "harga" => 100000],
                ["service" => "Cuci/Steam AC Cassette", "satuan" => "Harga/PK", "harga" => 125000],
                ["service" => "Service besar indoor", "satuan" => "unit", "harga" => 225000],
                ["service" => "Bongkar Pasang AC + Cuci 1/2, 3/4, 1 PK", "satuan" => "unit", "harga" => 400000],
                ["service" => "Bongkar AC", "satuan" => "unit", "harga" => 150000],
                ["service" => "Relokasi outdoor/indoor", "satuan" => "unit", "harga" => 150000],
                ["service" => "Penambahan Freon R22 (1/2, 3/4, 1 PK)", "satuan" => "isi full freon", "harga" => 200000],
                ["service" => "Penambahan Freon R32 (1/2, 3/4, 1 PK)", "satuan" => "isi full freon", "harga" => 225000],
                ["service" => "Penambahan Freon R410A (1/2, 3/4, 1 PK)", "satuan" => "isi full freon", "harga" => 225000],
                ["service" => "Penambahan Freon R22 (1 1/2, 2 PK)", "satuan" => "isi full freon", "harga" => 250000],
                ["service" => "Penambahan Freon R32 (1 1/2, 2 PK)", "satuan" => "isi full freon", "harga" => 250000],
                ["service" => "Penambahan Freon R410A (1 1/2, 2 PK)", "satuan" => "isi full freon", "harga" => 250000],
                ["service" => "Pemasangan pipa AC 1/2, 3/4, 1 PK (pipa + kabel + duck + pipa fleksibel)", "satuan" => "harga/meter", "harga" => 125000],
                ["service" => "Pemasangan pipa AC 1 1/2, 2 PK (pipa + kabel + duck + pipa fleksibel)", "satuan" => "harga/meter", "harga" => 145000],
                ["service" => "Ganti kapasitor 35 s/d 30 Mf", "satuan" => "unit", "harga" => 275000],
                ["service" => "Ganti kapasitor 35 s/d 40 Mf", "satuan" => "unit", "harga" => 325000],
                ["service" => "Ganti overload 1 s/d 2 Hp", "satuan" => "unit", "harga" => 325000],
                ["service" => "Ganti bearing indoor (1 pcs)", "satuan" => "pcs", "harga" => 125000],
                ["service" => "Ganti bearing indoor (2 pcs)", "satuan" => "pcs", "harga" => 200000],
                ["service" => "Perbaikan sensor (matakucing)", "satuan" => "unit", "harga" => 275000],
            ];

            $systemMessage = "Anda adalah asisten Anugrah Teknik Klinik AC yang membantu mendiagnosa masalah AC dan merekomendasikan layanan yang sesuai dari daftar berikut. Balas dengan format JSON dengan dua properti: 'deskripsi' (penjelasan masalah diagnosa yang kamu dapat) dan 'rekomendasi' (array layanan terkait dengan harga).\nLayanan:\n" . json_encode($data);

            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $validated['keluhan']],
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            $content = $response->choices[0]->message->content;

            $parsed = json_decode($content, true);

            if (!$parsed) {
                return response()->json([
                    'error' => 'Gagal mengurai respon OpenAI',
                    'raw_response' => $content,
                ], 500);
            }

            return response()->json([
                'status' => 'sukses',
                'data' => $parsed
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
