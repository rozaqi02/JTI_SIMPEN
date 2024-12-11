    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button" id="notificationButton">
                    <i class="fas fa-bell"></i>
                    <!-- Display the number of notifications -->
                    <span class="badge badge-warning" id="notificationCount">4</span>
                </a>
            </li>

            <!-- User Info (Display Username and Avatar) -->
            <li class="nav-item">
                <a class="nav-link">
                    <img src="{{ asset(auth()->user()->foto) }}" class="img-circle" alt="User Image" style="width: 30px; height: 30px;">
                    <span class="ml-2">{{ auth()->user()->username }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Floating Notification Window -->
    <div id="notificationWindow" class="notification-window" style="display: none;">
        <div class="notification-header">
            <h5>Notifications</h5>
            <button id="closeNotification" class="close-btn">×</button>
        </div>
        <div class="notification-body">
            <ul>
                <li><i class="fas fa-envelope"></i> 4 new messages</li>
                
            </ul>
        </div>
    </div>

    <style>
/* Navbar Styling */
.navbar {
    background-color: #ffffff; /* Putih bersih untuk tampilan modern */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Memberikan efek bayangan */
    padding: 0 20px; /* Padding kiri dan kanan */
}

/* User Avatar */
.navbar .img-circle {
    border: 2px solid #e87817; /* Tambahkan border oranye untuk menonjolkan */
    object-fit: cover; /* Agar gambar tetap proporsional */
}

/* Username Styling */
.navbar .nav-link span {
    font-size: 14px;
    font-weight: bold;
    color: #333;
}

/* Bell Icon */
.navbar .nav-link .fas.fa-bell {
    color: #e87817; /* Warna oranye untuk ikon lonceng */
}

/* Badge Styling */
.badge {
    background-color: #e87817;
    color: white;
    border-radius: 50%;
    padding: 5px 8px;
    font-size: 12px;
    margin-left: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Notification Window */
.notification-window {
    position: fixed;
    top: 70px; /* Di bawah navbar */
    right: 20px;
    width: 350px;
    background-color: white;
    border: 1px solid #e3e3e3;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Shadow lebih besar untuk tampilan profesional */
    border-radius: 10px;
    z-index: 9999;
    padding: 15px;
    display: none;
    transition: all 0.3s ease-in-out; /* Animasi smooth saat muncul */
}

/* Header Notification */
.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 16px;
    font-weight: bold;
    color: #333;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

/* Close Button */
.notification-header .close-btn {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #999;
    transition: color 0.2s;
}

.notification-header .close-btn:hover {
    color: #e87817; /* Warna hover */
}

/* Body Notification */
.notification-body {
    margin-top: 10px;
    max-height: 250px; /* Maksimal tinggi untuk body */
    overflow-y: auto;
    padding-right: 10px;
}

.notification-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.notification-body li {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    border-bottom: 1px solid #f1f1f1;
    cursor: pointer;
    transition: background-color 0.2s;
}

.notification-body li:hover {
    background-color: #f9f9f9;
}

/* Notification Icon Styling */
.notification-body li i {
    color: #e87817;
    margin-right: 10px;
    font-size: 18px;
}

    </style>

    <script>
 // Toggle notification window visibility
document.getElementById("notificationButton").onclick = function () {
    var notificationWindow = document.getElementById("notificationWindow");
    notificationWindow.style.display =
        notificationWindow.style.display === "block" ? "none" : "block";
};

// Close notification window
document.getElementById("closeNotification").onclick = function () {
    document.getElementById("notificationWindow").style.display = "none";
};

    </script>
