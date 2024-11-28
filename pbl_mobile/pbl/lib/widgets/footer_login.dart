import 'package:flutter/material.dart';

class FooterLogin extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(top: 70.0),
      child: Text(
        'Copyright © 2024 Coding Koala - Politeknik Negeri Malang',
        style: TextStyle(fontSize: 12, color: Colors.grey),
        textAlign: TextAlign.center,
      ),
    );
  }
}
