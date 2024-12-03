import 'package:flutter/material.dart';

class KameraPage extends StatelessWidget {
  const KameraPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Scanner Kamera'),
        backgroundColor: Colors.deepOrange,
      ),
      body: const Center(
        child: Text(
          'Halaman Scanner masih progress.',
          style: TextStyle(fontSize: 18),
        ),
      ),
    );
  }
}
