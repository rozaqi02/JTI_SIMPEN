import 'package:flutter/material.dart';

class AboutPage extends StatelessWidget {
  const AboutPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('About'),
        backgroundColor: Colors.deepPurple,
      ),
      body: const Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,  // Pusatkan secara vertikal
          crossAxisAlignment: CrossAxisAlignment.center, // Pusatkan secara horizontal
          children: <Widget>[
            Text(
              'Sejarah Marketplace:',
              textAlign: TextAlign.center, // Buat teks rata tengah
              style: TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(height: 16),
            Text(
              'Marketplace Chandra didirikan pada tahun 2024 dengan tujuan untuk '
              'menyediakan kebutuhan pokok seperti gula dan garam kepada pelanggan '
              'dengan harga yang terjangkau. Marketplace ini dibangun oleh Chandra Bagus Sulaksono '
              'dan terus berkembang untuk menawarkan lebih banyak produk di masa mendatang.',
              textAlign: TextAlign.center, // Buat teks rata tengah
              style: TextStyle(fontSize: 16, height: 1.5),
            ),
            SizedBox(height: 16),
            Text(
              'Visi dan Misi:',
              textAlign: TextAlign.center, // Buat teks rata tengah
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(height: 8),
            Text(
              'Visi: Menjadi marketplace terdepan dalam menyediakan kebutuhan pokok masyarakat dengan harga yang terjangkau.\n'
              'Misi: Menyediakan produk berkualitas tinggi dengan pelayanan terbaik kepada pelanggan .',
              textAlign: TextAlign.center, // Buat teks rata tengah
              style: TextStyle(fontSize: 16, height: 1.5),
            ),
          ],
        ),
      ),
    );
  }
}
