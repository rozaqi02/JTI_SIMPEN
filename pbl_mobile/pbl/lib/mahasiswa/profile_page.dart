import 'package:flutter/material.dart';
import 'home_page.dart'; // Pastikan path ini sesuai dengan lokasi file HomePage Anda
import 'login_page.dart'; // Tambahkan import untuk LoginPage
import 'tugasku_page.dart'; // Tambahkan import untuk TugaskuPage

class ProfilePage extends StatelessWidget {
  const ProfilePage({super.key});

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2, // Jumlah tab
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false, // Menghapus tombol kembali
          backgroundColor: Colors.white, // Background putih untuk AppBar
          elevation: 0, // Hilangkan bayangan
          title: Row(
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: Colors.white, // Background logo putih
                  borderRadius: BorderRadius.circular(8), // Radius untuk logo
                ),
                child: Image.asset(
                  'assets/logo.jpg', // Ganti dengan path logo Anda
                  height: 65,
                  width: 130,
                ),
              ),
              const SizedBox(width: 8),
            ],
          ),
          bottom: PreferredSize(
            preferredSize: const Size.fromHeight(50), // Tinggi TabBar
            child: Container(
              color: Colors.deepOrange, // Warna latar TabBar
              child: const TabBar(
                indicatorColor: Colors.white, // Warna garis bawah aktif
                labelColor: Colors.white, // Warna teks tab aktif
                unselectedLabelColor: Colors.black, // Warna teks tab tidak aktif
                indicatorWeight: 4, // Ketebalan garis bawah
                tabs: [
                  Tab(
                    child: Text(
                      'Akun',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                  Tab(
                    child: Text(
                      'About Us',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
        body: TabBarView(
          children: [
            // Konten untuk tab "Akun"
            _buildAkunContent(context),
            // Konten untuk tab "About Us"
            _buildAboutUsContent(),
          ],
        ),
        bottomNavigationBar: BottomNavigationBar(
          currentIndex: 2, // Indeks untuk tab "Akun"
          onTap: (index) {
            if (index == 0) {
              // Navigasi ke HomePage ketika "Beranda" diklik
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => UtamaPage()),
              );
            } else if (index == 1) {
              // Navigasi ke TugaskuPage ketika "Tugasku" diklik
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => TugaskuPage()),
              );
            }
            // Tidak perlu logika untuk indeks 2 karena ini adalah halaman aktif
          },
          items: const [
            BottomNavigationBarItem(
              icon: Icon(Icons.home),
              label: 'Beranda',
            ),
            BottomNavigationBarItem(
              icon: Icon(Icons.assignment),
              label: 'Tugasku',
            ),
            BottomNavigationBarItem(
              icon: Icon(Icons.person),
              label: 'Akun',
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildAkunContent(BuildContext context) {
    return SingleChildScrollView(
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: Column(
                children: [
                  CircleAvatar(
                    radius: 50,
                    backgroundColor: Colors.grey[200],
                    child: const Icon(
                      Icons.person,
                      size: 50,
                      color: Colors.grey,
                    ),
                  ),
                  const SizedBox(height: 16),
                  const Text(
                    'Akun Pengguna',
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
            ),
            const SizedBox(height: 32),
            _buildProfileRow(
              icon: Icons.person,
              title: 'Username',
              value: 'chandra123',
            ),
            _buildProfileRow(
              icon: Icons.person,
              title: 'Nama',
              value: 'Chandra Bagus Sulaksono',
            ),
            _buildProfileRow(
              icon: Icons.lock,
              title: 'Password',
              value: '******',
            ),
            _buildProfileRow(
              icon: Icons.code,
              title: 'NIM',
              value: '2241760079',
            ),
            _buildProfileRow(
              icon: Icons.email,
              title: 'Email',
              value: 'chandrabgs@gmail.com',
            ),
            const SizedBox(height: 32),
            Center(
              child: ElevatedButton(
                onPressed: () {
                  // Navigasi ke halaman Login
                  Navigator.pushReplacement(
                    context,
                    MaterialPageRoute(builder: (context) => LoginPage()),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.red, // Warna tombol logout
                  foregroundColor: Colors.white, // Warna teks tombol
                  padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 12),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                ),
                child: Text(
                  'Logout',
                  style: TextStyle(fontSize: 16),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildAboutUsContent() {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            const Text(
              'About System',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 10),
            Image.asset(
              'assets/logo.jpg', // Ganti dengan path logo Anda
              height: 75,
              width: 150,
            ),
            const SizedBox(height: 10),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _buildAboutRow(
                  title: 'Nama Aplikasi:',
                  content: 'JTI Simpen (Sistem Kompensasi)',
                ),
                _buildAboutRow(
                  title: 'Tujuan:',
                  content:
                      'Sistem ini dibuat untuk memfasilitasi pengelolaan kompensasi secara efisien.',
                ),
                _buildAboutRow(
                  title: 'Keamanan System:',
                  content: 'Kami menjamin keamanan data pribadi anda.',
                ),
                _buildAboutRow(
                  title: 'Tim Pengembang:',
                  content: 'Coding Koala',
                ),
                _buildAboutRow(
                  title: 'Dukungan:',
                  content: 'Jurusan Teknologi Informasi, Politeknik Negeri Malang',
                ),
                _buildAboutRow(
                  title: 'Versi:',
                  content: 'V 1.0.0',
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildAboutRow({required String title, required String content}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            title,
            style: const TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            content,
            style: const TextStyle(fontSize: 16),
          ),
        ],
      ),
    );
  }

  Widget _buildProfileRow({required IconData icon, required String title, required String value}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: Row(
        children: [
          Icon(icon, size: 24, color: Colors.deepOrange),
          const SizedBox(width: 16),
          Expanded(
            flex: 3,
            child: Text(
              title,
              style: const TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          Expanded(
            flex: 5,
            child: Text(
              value,
              style: const TextStyle(
                fontSize: 16,
              ),
              overflow: TextOverflow.ellipsis,
            ),
          ),
        ],
      ),
    );
  }
}
