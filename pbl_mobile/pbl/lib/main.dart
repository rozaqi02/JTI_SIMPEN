import 'package:flutter/material.dart';
import 'adt/home_page.dart';  // Import file home_page.dart
import 'adt/login_page.dart'; // Import file login_page.dart
import 'adt/about_page.dart'; // Import file about_page.dart
import 'adt/profile_page.dart'; // Import file profile_page.dart
import 'adt/tugasku_page.dart'; // Import file tugasku_page.dart
import 'adt/splash_screen.dart'; // Import file splash_screen.dart

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false, // Menghilangkan banner debug
      initialRoute: '/tugasku', 
      routes: {
        '/splash': (context) => SplashScreen(), // SplashScreen sebagai layar pertama
        '/login': (context) => LoginPage(),
        '/home': (context) => UtamaPage(),
        '/tugasku': (context) => TugaskuPage(),
        '/about': (context) => AboutPage(),
        '/profile': (context) => ProfilePage(),
      },
      theme: ThemeData(
        primarySwatch: Colors.orange, // Menentukan tema warna
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
    );
  }
}