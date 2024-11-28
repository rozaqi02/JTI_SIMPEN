import 'package:flutter/material.dart';

class KameraPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Scanner Kamera'),
        backgroundColor: Colors.deepOrange,
      ),
      body: Center(
        child: Text(
          'Halaman Scanner masih progress.',
          style: TextStyle(fontSize: 18),
        ),
      ),
    );
  }
}
