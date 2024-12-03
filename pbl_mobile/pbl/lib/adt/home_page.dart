import 'package:flutter/material.dart';
import 'profile_page.dart'; // Pastikan path ini sesuai dengan lokasi file ProfilePage Anda
import 'tugasku_page.dart'; // Pastikan path ini sesuai dengan lokasi file TugaskuPage Anda
import 'notification_page.dart'; // Tambahkan import untuk NotificationsPage
import 'kamera_page.dart'; // Tambahkan import untuk KameraPage (buat halaman KameraPage jika belum ada)

class UtamaPage extends StatefulWidget {
  const UtamaPage({super.key});

  @override
  _UtamaPageState createState() => _UtamaPageState();
}

class _UtamaPageState extends State<UtamaPage> {
  int _currentIndex = 0;

  void _onTabTapped(int index) {
    if (index == 1) { // Indeks untuk tab "Tugasku"
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => TugaskuPage()), // Navigasi ke TugaskuPage
      );
    } else if (index == 2) { // Indeks untuk tab "Akun"
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => ProfilePage()), // Navigasi ke ProfilePage
      );
    } else {
      setState(() {
        _currentIndex = index;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Row(
          children: [
            Image.asset(
              'assets/logo.jpg', // replace with your logo path
              height: 65,
              width: 130,
            ),
          ],
        ),
        backgroundColor: Colors.white,
        elevation: 0,
        iconTheme: const IconThemeData(color: Colors.black),
        actions: [
          IconButton(
            icon: const Icon(Icons.qr_code_scanner, color: Colors.black), // Ikon kamera scanner
            onPressed: () {
              // Navigasi ke KameraPage
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => KameraPage()), // Halaman kamera scanner
              );
            },
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Stack(
              children: [
                Image.asset(
                  'assets/background.jpg', // replace with your background image
                  width: double.infinity,
                  height: 180,
                  fit: BoxFit.cover,
                ),
                const Positioned(
                  left: 16,
                  bottom: 20,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Selamat datang,\nAde Ismail',
                        style: TextStyle(
                          fontSize: 24,
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        '2241760079',
                        style: TextStyle(color: Colors.white, fontSize: 16),
                      ),
                    ],
                  ),
                ),
              ],
            ),
            Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                children: [
                  // Attendance Card
                  Card(
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(15),
                    ),
                    elevation: 4,
                    child: Padding(
                      padding: const EdgeInsets.symmetric(vertical: 16.0, horizontal: 20.0),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        children: [
                          _buildAttendanceColumn(Icons.history, 'Tugasku', '4', Colors.orange),
                          _buildAttendanceColumn(Icons.hourglass_empty, 'Progress', '12', Colors.orange), // Ganti icon dan jumlah
                          _buildAttendanceColumn(Icons.check, 'Selesai', '8', Colors.orange), // Sesuaikan jumlah
                        ],
                      ),
                    ),
                  ),
                  const SizedBox(height: 20),
                  // Notifications Section
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      const Text(
                        'Notifikasi Teratas :',
                        style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                      ),
                      TextButton(
                        onPressed: () {
                          // Action for "Lihat Semua"
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => NotificationsPage()),
                          );
                        },
                        child: const Text(
                          'Lihat Semua >>',
                          style: TextStyle(color: Colors.blue),
                        ),
                      ),
                    ],
                  ),
                  _buildNotificationCard(
                    'Tugas Bersih.... perlu ditinjau',
                    'Tugas 01 telah diselesaikan oleh mahasiswa. Silahkan ditinjau dan beri persetujuan.',
                    '20 Jam',
                    'assets/notif.jpg', // replace with the path to notification image
                  ),
                  _buildNotificationCard(
                    'Tugas Bers.... sedang dikerjakan',
                    'Tugas 02 telah diambil oleh mahasiswa Rafli Rasya. Tunggu proses pengerjaan.',
                    '20 Jam',
                    'assets/notif.jpg',
                  ),
                  _buildNotificationCard(
                    'Tugas Bersih.... disetujui Kaprodi',
                    'Tugas 03 yang anda input telah disetujui oleh Kaprodi. Tugas anda telah dipublis.',
                    '20 Jam',
                    'assets/notif.jpg',
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _currentIndex,
        onTap: _onTabTapped,
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
    );
  }

  Widget _buildAttendanceColumn(IconData icon, String label, String count, Color color) {
    return Column(
      children: [
        Icon(icon, color: color, size: 30),
        const SizedBox(height: 5),
        Text(
          count,
          style: TextStyle(
            fontSize: 24,
            fontWeight: FontWeight.bold,
            color: color,
          ),
        ),
        Text(label, style: const TextStyle(color: Colors.grey)),
      ],
    );
  }

  Widget _buildNotificationCard(String title, String description, String time, String imagePath) {
    return Card(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(15),
      ),
      elevation: 3,
      child: ListTile(
        leading: ClipRRect(
          borderRadius: BorderRadius.circular(8.0),
          child: Image.asset(
            imagePath,
            width: 50,
            height: 50,
            fit: BoxFit.cover,
          ),
        ),
        title: Text(
          title,
          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
          overflow: TextOverflow.ellipsis,
        ),
        subtitle: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(description, maxLines: 2, overflow: TextOverflow.ellipsis),
            const SizedBox(height: 5),
            Text(
              time,
              style: const TextStyle(color: Colors.grey, fontSize: 12),
            ),
          ],
        ),
      ),
    );
  }
}
