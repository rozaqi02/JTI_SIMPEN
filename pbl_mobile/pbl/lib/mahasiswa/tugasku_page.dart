import 'package:flutter/material.dart';
import 'profile_page.dart'; // Pastikan path ini sesuai dengan lokasi file ProfilePage Anda
import 'home_page.dart'; // Pastikan path ini sesuai dengan lokasi file HomePage Anda
class TugaskuPage extends StatefulWidget {
  const TugaskuPage({super.key});

  @override
  _TugaskuPageState createState() => _TugaskuPageState();
}

class _TugaskuPageState extends State<TugaskuPage> with SingleTickerProviderStateMixin {
  late TabController _tabController;
  final int _bottomNavIndex = 1;

  @override
  void initState() {
    super.initState();
    _tabController = TabController(length: 3, vsync: this);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: PreferredSize(
        preferredSize: const Size.fromHeight(120),
        child: Column(
          children: [
            Container(
              color: Colors.white,
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              child: Row(
                children: [
                  Image.asset(
                    'assets/logo.jpg',
                    height: 60,
                    width: 130,
                    errorBuilder: (context, error, stackTrace) {
                      return const Icon(Icons.broken_image, size: 40, color: Colors.grey);
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
                tabs: const [
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

  Widget _buildTaskList() {
    final tasks = [
      {
        'title': 'Membersihkan Ruang Baca',
        'author': 'Usman Nurhasan, S.Kom., M.T.',
        'points': '20 Jam',
        'quota': '10 Mahasiswa',
        'image': 'assets/task_image.jpg',
      },
      {
        'title': 'Membersihkan Perpustakaan',
        'author': 'Usman Nurhasan, S.Kom., M.T.',
        'points': '20 Jam',
        'quota': '10 Mahasiswa',
        'image': 'assets/task_image.jpg',
      },
    ];

    return ListView.builder(
      padding: const EdgeInsets.all(10),
      itemCount: tasks.length,
      itemBuilder: (context, index) {
        final task = tasks[index];
        return Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
          elevation: 3,
          margin: const EdgeInsets.symmetric(vertical: 8),
          child: Column(
            children: [
              ClipRRect(
                borderRadius: const BorderRadius.vertical(top: Radius.circular(10)),
                child: Image.asset(
                  task['image']!,
                  height: 150,
                  width: double.infinity,
                  fit: BoxFit.cover,
                  errorBuilder: (context, error, stackTrace) {
                    return const Icon(Icons.broken_image, size: 150, color: Colors.grey);
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
                      style: const TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                      ),
                    ),
                    const SizedBox(height: 5),
                    Text(
                      task['author']!,
                      style: TextStyle(color: Colors.grey[600]),
                    ),
                    const SizedBox(height: 5),
                    Text(
                      'Poin Jam: ${task['points']}',
                      style: const TextStyle(fontSize: 12, color: Colors.grey),
                    ),
                    Text(
                      'Kuota Mahasiswa: ${task['quota']}',
                      style: const TextStyle(fontSize: 12, color: Colors.grey),
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
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.deepOrange,
                        foregroundColor: Colors.white,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(8),
                        ),
                      ),
                      child: Text('Ambil'),
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
        'title': 'Membersihkan Ruang Baca',
        'description': 'Rapikan dan bersihkan ruangan, dan pastikan tidak ada sampah tertinggal',
        'progress': '20%',
        'image': 'assets/task_image.jpg',
      },
      {
        'title': 'Membersihkan Perpustakaan',
        'description': 'Rapikan dan bersihkan ruangan, dan pastikan tidak ada sampah tertinggal',
        'progress': '40%',
        'image': 'assets/task_image.jpg',
      },
    ];

    return ListView.builder(
      padding: const EdgeInsets.all(10),
      itemCount: progressTasks.length,
      itemBuilder: (context, index) {
        final task = progressTasks[index];
        return Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
          elevation: 3,
          margin: const EdgeInsets.symmetric(vertical: 8),
          child: ListTile(
            leading: ClipRRect(
              borderRadius: BorderRadius.circular(8),
              child: Image.asset(
                task['image']!,
                width: 50,
                height: 50,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) {
                  return const Icon(Icons.broken_image, size: 50, color: Colors.grey);
                },
              ),
            ),
            title: Text(
              task['title']!,
              style: const TextStyle(fontWeight: FontWeight.bold),
            ),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(task['description']!),
                const SizedBox(height: 5),
                Text(
                  'Progress: ${task['progress']}',
                  style: const TextStyle(color: Colors.blue),
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
      padding: const EdgeInsets.all(10),
      itemCount: completedTasks.length,
      itemBuilder: (context, index) {
        final task = completedTasks[index];
        return Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
          elevation: 3,
          margin: const EdgeInsets.symmetric(vertical: 8),
          child: ListTile(
            leading: ClipRRect(
              borderRadius: BorderRadius.circular(8),
              child: Image.asset(
                task['image']!,
                width: 50,
                height: 50,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) {
                  return const Icon(Icons.broken_image, size: 50, color: Colors.grey);
                },
              ),
            ),
            title: Text(
              task['title']!,
              style: const TextStyle(fontWeight: FontWeight.bold),
            ),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(task['description']!),
                const SizedBox(height: 5),
                Text(
                  'Poin: ${task['time']}',
                  style: const TextStyle(fontSize: 12, color: Colors.grey),
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

  const TaskDetailPage({super.key, 
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
        title: const Text('Detail Tugas'),
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
            const SizedBox(height: 20),
            Text(
              title,
              style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 20),
            ),
            const SizedBox(height: 10),
            Text(author),
            const SizedBox(height: 10),
            Text('Poin Jam: $points'),
            Text('Kuota Mahasiswa: $quota'),
            const SizedBox(height: 20),
            ElevatedButton(
              onPressed: () {
                // Fungsi ambil tugas
              },
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.deepOrange,
                foregroundColor: Colors.white,
              ),
              child: Text('Ambil Tugas'),
            ),
          ],
        ),
      ),
    );
  }
}