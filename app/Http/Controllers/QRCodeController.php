<?php
namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QRCodeModel;
use Illuminate\Support\Str;

class QRCodeController extends Controller
{

public function generateQRCode($idTugas, $idMahasiswa)
{
    $qrCodeId = Str::uuid(); // ID unik untuk QRCode
    $path = 'qrcodes/' . $qrCodeId . '.png'; // Lokasi penyimpanan gambar

    // Generate QR Code
    QrCode::size(300)->generate(url('/tugas/' . $idTugas), public_path($path));

    // Simpan data QR Code di database
    $qrCode = QRCodeModel::create([
        'id_QRCode' => $qrCodeId,
        'id_tugas' => $idTugas,
        'id_mahasiswa' => $idMahasiswa,
        'image_qrcode' => $path
    ]);

    return $qrCode;
}
}