import 'package:flutter/material.dart';

class NotificationsPage extends StatelessWidget {
  const NotificationsPage({super.key});

  @override
  Widget build(BuildContext context) {
    final notifications = [
      {
        'title': 'Tugas Bersih.... perlu ditinjau',
        'description': 'Tugas 01 telah diselesaikan oleh mahasiswa. Silahkan ditinjau dan beri persetujuan.',
        'time': '20 Jam',
        'date': '22 Agt',
        'image': 'assets/notif.jpg',
      },
      {
        'title': 'Tugas Bersih.... sedang dikerjakan',
        'description': 'Tugas 02 telah diambil oleh mahasiswa Rafli Rasya. Tunggu proses pengerjaan.',
        'time': '20 Jam',
        'date': '22 Agt',
        'image': 'assets/notif.jpg',
      },
      {
        'title': 'Tugas Bersih.... disetujui Kaprodi',
        'description': 'Tugas 03 yang anda input telah disetujui oleh Kaprodi. Tugas anda telah dipublis.',
        'time': '20 Jam',
        'date': '22 Agt',
        'image': 'assets/notif.jpg',
      },
      // Tambahkan notifikasi lain jika diperlukan
    ];

    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.deepOrange,
        title: const Text(
          'Notifikasi',
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () {
            Navigator.pop(context); // Kembali ke halaman sebelumnya
          },
        ),
      ),
      body: ListView.builder(
        padding: const EdgeInsets.all(16),
        itemCount: notifications.length,
        itemBuilder: (context, index) {
          final notification = notifications[index];
          return Card(
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(15),
            ),
            elevation: 3,
            margin: const EdgeInsets.symmetric(vertical: 8),
            child: ListTile(
              leading: ClipRRect(
                borderRadius: BorderRadius.circular(8.0),
                child: Image.asset(
                  notification['image']!,
                  width: 50,
                  height: 50,
                  fit: BoxFit.cover,
                  errorBuilder: (context, error, stackTrace) {
                    return const Icon(Icons.image_not_supported, size: 50, color: Colors.grey);
                  },
                ),
              ),
              title: Text(
                notification['title']!,
                style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                overflow: TextOverflow.ellipsis,
              ),
              subtitle: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(notification['description']!, maxLines: 2, overflow: TextOverflow.ellipsis),
                  const SizedBox(height: 5),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text(
                        notification['time']!,
                        style: const TextStyle(color: Colors.grey, fontSize: 12),
                      ),
                      Text(
                        notification['date']!,
                        style: const TextStyle(color: Colors.grey, fontSize: 12),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}
