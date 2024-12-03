import 'package:flutter/material.dart';

import '../widgets/footer_login.dart'; // Import FooterLogin
import 'home_page.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final TextEditingController _usernameController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  String _errorMessage = '';
  bool _isPasswordVisible = false;

  final bool _isUsernameHovered = false;
  final bool _isPasswordHovered = false;
  bool _isLoginButtonHovered = false;

  void _login() {
    String username = _usernameController.text;
    String password = _passwordController.text;

    if (username == 'chandra' && password == '123456') {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => UtamaPage()),
      );
    } else {
      setState(() {
        _errorMessage = 'Username atau password salah!';
      });
    }
  }

  void _showHelpDialog() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              const Text(
                
                'Silahkan Hubungi Admin\nDi Ruang Admin JTI Lantai 6!',
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 16, // Ukuran font lebih kecil
                  fontWeight: FontWeight.bold,
                  color: Colors.black,
                ),
              ),
              const SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  Navigator.of(context).pop(); // Menutup pop-up saat tombol OK diklik
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.orange,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(15),
                  ),
                  padding: const EdgeInsets.symmetric(horizontal: 50, vertical: 10),
                ),
                child: const Text(
                  'OK',
                  style: TextStyle(color: Colors.white),
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false, // Tambahkan ini
      body: Center(
        child: SingleChildScrollView( // Bungkus dengan SingleChildScrollView
          padding: const EdgeInsets.all(16.0),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Container(
                width: 200, // Ukuran logo diperkecil
                height: 100,
                margin: const EdgeInsets.only(bottom: 20),
                child: Image.asset(
                  'assets/logo.jpg',
                  fit: BoxFit.cover,
                ),
              ),
              const Text(
                'Selamat Datang',
                style: TextStyle(
                  fontSize: 20, // Ukuran font lebih kecil
                  color: Colors.orange,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 5),
              const Text(
                'Silahkan login terlebih dahulu',
                style: TextStyle(
                  fontSize: 14, // Ukuran font lebih kecil
                  color: Colors.grey,
                ),
              ),
              const SizedBox(height: 20),
                Stack(
  children: [
    SizedBox(
      width: 250,
      child: TextField(
        controller: _usernameController,
        decoration: InputDecoration(
          hintText: 'USERNAME', // Placeholder teks
          hintStyle: const TextStyle(color: Colors.grey, fontSize: 12), // Gaya teks placeholder
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(20.0),
            borderSide: const BorderSide(
              color: Colors.orange,
              width: 2.0,
            ),
          ),
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10.0),
            borderSide: BorderSide(
              color: _isUsernameHovered ? Colors.orangeAccent : Colors.orange,
              width: 2.0,
            ),
          ),
          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10.0),
            borderSide: const BorderSide(
              color: Colors.orange,
              width: 2.0,
            ),
          ),
        ),
      ),
    ),
    const Positioned(
      right: 15,
      top: 15,
      child: Icon(
        Icons.person,
        color: Colors.grey,
      ),
    ),
  ],
),

              const SizedBox(height: 20),
              Stack(
  children: [
    SizedBox(
      width: 250,
      child: TextField(
        controller: _passwordController,
        decoration: InputDecoration(
          hintText: 'PASSWORD', // Placeholder teks
          hintStyle: const TextStyle(color: Colors.grey, fontSize: 12), // Gaya teks placeholder
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(20.0),
            borderSide: const BorderSide(
              color: Colors.orange,
              width: 2.0,
            ),
          ),
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10.0),
            borderSide: BorderSide(
              color: _isPasswordHovered ? Colors.orangeAccent : Colors.orange,
              width: 2.0,
            ),
          ),
          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10.0),
            borderSide: const BorderSide(
              color: Colors.orange,
              width: 2.0,
            ),
          ),
        ),
        obscureText: !_isPasswordVisible,
      ),
    ),
    Positioned(
      right: 5,
      top: 5,
      child: IconButton(
        icon: Icon(
          _isPasswordVisible ? Icons.visibility : Icons.visibility_off,
          color: Colors.grey,
        ),
        onPressed: () {
          setState(() {
            _isPasswordVisible = !_isPasswordVisible;
          });
        },
      ),
    ),
  ],
),

              const SizedBox(height: 20),
              MouseRegion(
                onEnter: (_) {
                  setState(() {
                    _isLoginButtonHovered = true;
                  });
                },
                onExit: (_) {
                  setState(() {
                    _isLoginButtonHovered = false;
                  });
                },
                child: ElevatedButton(
                  onPressed: _login,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: _isLoginButtonHovered ? const Color.fromARGB(255, 220, 82, 82) : Colors.orange,
                    padding: const EdgeInsets.symmetric(horizontal: 100, vertical: 15),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8.0),
                    ),
                  ),
                  child: const Text(
                    'Login',
                    style: TextStyle(color: Colors.white, fontSize: 14), // Ukuran font lebih kecil
                  ),
                ),
              ),
              if (_errorMessage.isNotEmpty)
                Padding(
                  padding: const EdgeInsets.only(top: 10.0),
                  child: Text(
                    _errorMessage,
                    style: const TextStyle(color: Colors.red, fontSize: 12), // Ukuran font lebih kecil
                  ),
                ),
              const SizedBox(height: 20),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    'Tidak bisa login?',
                    style: TextStyle(color: Colors.black, fontSize: 12), // Ukuran font lebih kecil
                  ),
                  const SizedBox(width: 5),
                  GestureDetector(
                    onTap: _showHelpDialog,
                    child: const Text(
                      'Bantuan',
                      style: TextStyle(color: Colors.orange, fontWeight: FontWeight.bold, fontSize: 12), // Ukuran font lebih kecil
                    ),
                  ),
                ],
              ),
              FooterLogin(),
            ],
          ),
        ),
      ),
    );
  }
}
