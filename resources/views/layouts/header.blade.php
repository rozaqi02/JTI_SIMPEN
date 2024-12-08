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
    /* Style for the notification window */
    .notification-window {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 300px;
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        z-index: 9999;
        padding: 10px;
        display: none;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .notification-body {
        margin-top: 10px;
        max-height: 300px;
        overflow-y: auto;
    }

    .notification-body ul {
        list-style-type: none;
        padding-left: 0;
    }

    .notification-body li {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }

    .notification-body li:hover {
        background-color: #f4f4f4;
    }

    .badge {
        background-color: #e87817;
        color: white;
        border-radius: 50%;
        padding: 3px 8px;
        font-size: 12px;
        margin-left: 5px;
    }
</style>

<script>
    // Toggle notification window visibility
    document.getElementById("notificationButton").onclick = function() {
        var notificationWindow = document.getElementById("notificationWindow");
        notificationWindow.style.display = (notificationWindow.style.display === "none" || notificationWindow.style.display === "") ? "block" : "none";
    }

    // Close notification window
    document.getElementById("closeNotification").onclick = function() {
        document.getElementById("notificationWindow").style.display = "none";
    }
</script>
