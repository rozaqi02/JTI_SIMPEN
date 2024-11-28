import 'package:flutter/material.dart';
import 'profile_page.dart'; // Pastikan path ini sesuai dengan lokasi file ProfilePage Anda
import 'home_page.dart'; // Pastikan path ini sesuai dengan lokasi file HomePage Anda

class TugaskuPage extends StatefulWidget {
  @override
  _TugaskuPageState createState() => _TugaskuPageState();
}

class _TugaskuPageState extends State<TugaskuPage> with SingleTickerProviderStateMixin {
  late TabController _tabController;
  int _bottomNavIndex = 1;

  @override
  void initState() {
    super.initState();
    _tabController = TabController(length: 3, vsync: this);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: PreferredSize(
        preferredSize: Size.fromHeight(120),
        child: Column(
          children: [
            Container(
              color: Colors.white,
              padding: EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              child: Row(
                children: [
                  Image.asset(
                    'assets/logo.jpg',
                    height: 60,
                    width: 130,
                    errorBuilder: (context, error, stackTrace) {
                      return Icon(Icons.broken_image, size: 40, color: Colors.grey);
                    },
                  ),
                ],
              ),
            ),
            Container(
              color: Colors.deepOrange,
              child: TabBar(
                controller: _tabController,
                indicatorColor: Colors.white,
                indicatorWeight: 4,
                labelColor: Colors.white,
                unselectedLabelColor: Colors.black,
                tabs: [
                  Tab(
                    child: Text(
                      'Daftar Tugas',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                  Tab(
                    child: Text(
                      'Progress Tugas',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                  Tab(
                    child: Text(
                      'Tugas Selesai',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      body: Container(
        color: Colors.white,
        child: TabBarView(
          controller: _tabController,
          children: [
            _buildTaskList(),
            _buildProgressList(),
            _buildCompletedTaskList(),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _bottomNavIndex,
        onTap: (index) {
          if (index == 0) {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => UtamaPage()),
            );
          } else if (index == 2) {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => ProfilePage()),
            );
          }
        },
        items: [
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

  Widget _buildTaskList() {
    final tasks = [
      {
        'title': 'Membersihkan Ruang Baca',
        'author': 'Ade Ismail, S.Kom, M.TI.',
        'points': '20 Jam',
        'quota': '2 Mahasiswa',
        'image': 'assets/task_image.jpg',
      },
      {
        'title': 'Membersihkan Perpustakaan',
        'author': 'Ade Ismail, S.Kom, M.TI.',
        'points': '20 Jam',
        'quota': '2 Mahasiswa',
        'image': 'assets/task_image.jpg',
      },
    ];

    return ListView.builder(
      padding: EdgeInsets.all(10),
      itemCount: tasks.length,
      itemBuilder: (context, index) {
        final task = tasks[index];
        return Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
          elevation: 3,
          margin: EdgeInsets.symmetric(vertical: 8),
          child: Column(
            children: [
              ClipRRect(
                borderRadius: BorderRadius.vertical(top: Radius.circular(10)),
                child: Image.asset(
                  task['image']!,
                  height: 150,
                  width: double.infinity,
                  fit: BoxFit.cover,
                  errorBuilder: (context, error, stackTrace) {
                    return Icon(Icons.broken_image, size: 150, color: Colors.grey);
                  },
                ),
              ),
              Padding(
                padding: const EdgeInsets.all(10.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      task['title']!,
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                      ),
                    ),
                    SizedBox(height: 5),
                    Text(
                      task['author']!,
                      style: TextStyle(color: Colors.grey[600]),
                    ),
                    SizedBox(height: 5),
                    Text(
                      'Poin Jam: ${task['points']}',
                      style: TextStyle(fontSize: 12, color: Colors.grey),
                    ),
                    Text(
                      'Kuota Mahasiswa: ${task['quota']}',
                      style: TextStyle(fontSize: 12, color: Colors.grey),
                    ),
                  ],
                ),
              ),
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16.0, vertical: 8),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    ElevatedButton(
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) => TaskDetailPage(
                              title: task['title']!,
                              author: task['author']!,
                              points: task['points']!,
                              quota: task['quota']!,
                              image: task['image']!,
                            ),
                          ),
                        );
                      },
                      child: Text('Lihat'),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.deepOrange,
                        foregroundColor: Colors.white,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(8),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  Widget _buildProgressList() {
    final progressTasks = [
      {
        'title': 'Membersihkan Ruang Baca\nChandra Bagus Sulaksono',
        'description': 'Rapikan dan bersihkan ruangan, dan pastikan tidak ada sampah tertinggal',
        'progress': '20%',
        'image': 'assets/task_image.jpg',
      },
      {
        'title': 'Membersihkan Perpustakaan\nAhmad Rozaki',
        'description': 'Rapikan dan bersihkan ruangan, dan pastikan tidak ada sampah tertinggal',
        'progress': '40%',
        'image': 'assets/task_image.jpg',
      },
    ];

    return ListView.builder(
      padding: EdgeInsets.all(10),
      itemCount: progressTasks.length,
      itemBuilder: (context, index) {
        final task = progressTasks[index];
        return Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
          elevation: 3,
          margin: EdgeInsets.symmetric(vertical: 8),
          child: ListTile(
            leading: ClipRRect(
              borderRadius: BorderRadius.circular(8),
              child: Image.asset(
                task['image']!,
                width: 50,
                height: 50,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) {
                  return Icon(Icons.broken_image, size: 50, color: Colors.grey);
                },
              ),
            ),
            title: Text(
              task['title']!,
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(task['description']!),
                SizedBox(height: 5),
                Text(
                  'Progress: ${task['progress']}',
                  style: TextStyle(color: Colors.blue),
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  Widget _buildCompletedTaskList() {
    final completedTasks = [
      {
        'title': 'Membersihkan Ruang Baca',
        'description': 'Rapikan dan bersihkan ruangan, dan pastikan tidak ada sampah tertinggal',
        'time': '20 Jam',
        'image': 'assets/task_image.jpg',
      },
      {
        'title': 'Membersihkan Perpustakaan',
        'description': 'Rapikan dan bersihkan ruangan, dan pastikan tidak ada sampah tertinggal',
        'time': '15 Jam',
        'image': 'assets/task_image.jpg',
      },
    ];

    return ListView.builder(
      padding: EdgeInsets.all(10),
      itemCount: completedTasks.length,
      itemBuilder: (context, index) {
        final task = completedTasks[index];
        return Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
          elevation: 3,
          margin: EdgeInsets.symmetric(vertical: 8),
          child: ListTile(
            leading: ClipRRect(
              borderRadius: BorderRadius.circular(8),
              child: Image.asset(
                task['image']!,
                width: 50,
                height: 50,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) {
                  return Icon(Icons.broken_image, size: 50, color: Colors.grey);
                },
              ),
            ),
            title: Text(
              task['title']!,
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(task['description']!),
                SizedBox(height: 5),
                Text(
                  'Poin: ${task['time']}',
                  style: TextStyle(fontSize: 12, color: Colors.grey),
                ),
              ],
            ),
          ),
        );
      },
    );
  }
}

class TaskDetailPage extends StatelessWidget {
  final String title;
  final String author;
  final String points;
  final String quota;
  final String image;

  TaskDetailPage({
    required this.title,
    required this.author,
    required this.points,
    required this.quota,
    required this.image,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Detail Tugas'),
        backgroundColor: Colors.deepOrange,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            ClipRRect(
              borderRadius: BorderRadius.circular(8),
              child: Image.asset(
                image,
                height: 200,
                width: double.infinity,
                fit: BoxFit.cover,
              ),
            ),
            SizedBox(height: 20),
            Text(
              title,
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20),
            ),
            SizedBox(height: 10),
            Text(author),
            SizedBox(height: 10),
            Text('Poin Jam: $points'),
            Text('Kuota Mahasiswa: $quota'),
            Text('List Mahasiswa: 1. Chandra Bagus Sulaksono\n                             2. Ahmad Rozaki'),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: () {
                _showHelpDialog(context); // Call the dialog function here
              },
              child: Text('Edit Tugas'),
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.deepOrange,
                foregroundColor: Colors.white,
                alignment: Alignment.center, // Menempatkan teks di tengah tombol
              ),
            ),
          ],
        ),
      ),
    );
  }

  // Menambahkan fungsi untuk menampilkan dialog
  void _showHelpDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Text(
                'Silahkan kunjungi website kami\nhttp://jti.simpen.com',
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 16, // Ukuran font lebih kecil
                  fontWeight: FontWeight.bold,
                  color: Colors.black,
                ),
              ),
              SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  Navigator.of(context).pop(); // Menutup dialog saat OK ditekan
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.orange, // Warna latar belakang
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(15),
                  ),
                  padding: EdgeInsets.symmetric(horizontal: 50, vertical: 10),
                ),
                child: Text(
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
}
