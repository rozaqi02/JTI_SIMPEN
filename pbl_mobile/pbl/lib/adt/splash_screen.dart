import 'package:flutter/material.dart';
import 'login_page.dart'; // Pastikan path ini sesuai dengan lokasi file LoginPage Anda

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    // Delay sebelum berpindah ke halaman berikutnya
    Future.delayed(const Duration(seconds: 3), () {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => LoginPage()), // Navigasi ke halaman Login
      );
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white, // Latar belakang putih
      body: Center(
        child: Image.asset(
          'assets/logo.jpg', // Ganti dengan path logo Anda
          height: 150, // Ukuran logo (atur sesuai kebutuhan)
          width: 150,
          fit: BoxFit.contain,
        ),
      ),
    );
  }
}
