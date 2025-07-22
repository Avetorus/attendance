<?php 
    // session_start();
    //     if (!isset($_SESSION['Admin-name'])) {
    //     header("location: ".BASEURL."/login");
    //     exit();
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data["title"]; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
     <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const sidebarCollapse = document.getElementById('sidebarCollapse');
        const overlay = document.querySelector('.overlay');
        const pageTitle = document.getElementById('pageTitle');
        const contentTitle = document.getElementById('content-title');
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        // Fungsi untuk menutup sidebar mobile
        const dismissSidebar = () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        };

        // Event listener untuk tombol toggle utama
        sidebarCollapse.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });

        // Event listener untuk overlay
        overlay.addEventListener('click', dismissSidebar);
        
        // Event listener untuk tombol Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                dismissSidebar();
            }
        });

        // Event listener untuk link di sidebar
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Hapus kelas active dari semua link
                sidebarLinks.forEach(l => l.parentElement.classList.remove('active'));

                // Tambah kelas active ke parent dari link yang diklik (li)
                this.parentElement.classList.add('active');

                // Ubah judul halaman
                const linkText = this.querySelector('.link-text')?.textContent.trim() || this.textContent.trim();
                pageTitle.textContent = linkText;
                contentTitle.textContent = `Konten ${linkText}`;

                // Tutup sidebar jika dalam mode mobile setelah klik
                if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
                    dismissSidebar();
                }
            });
        });
    });
    </script>
    <style>
        /* CSS Kustom untuk Sidebar dan Animasi */
        body {
            font-family: 'Inter', sans-serif;
            background-color: whitesmoke;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* --- Gaya Sidebar --- */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            height: 100vh;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            position: relative;
            z-index: 1000; /* Pastikan di atas overlay */
        }

        #sidebar.collapsed {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #495057;
        }

        #sidebar.collapsed .sidebar-header h3 {
            display: none;
        }
        
        #sidebar.collapsed .sidebar-header::after {
            content: "A";
            font-size: 1.5rem;
            font-weight: bold;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 15px 20px;
            font-size: 1.1em;
            display: flex;
            align-items: center;
            color: #adb5bd;
            border-left: 4px solid transparent;
            transition: all 0.2s;
            text-decoration: none;
        }

        #sidebar ul li{
            position: relative;
        }

        #sidebar ul li a:hover {
            color: #ffffff;
            background: #495057;
            border-left-color: #0d6efd;
        }
        
        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff;
            background: #0d6efd;
            border-left-color: #0b5ed7;
        }

        #sidebar ul li a i {
            margin-right: 15px;
            min-width: 25px;
            text-align: center;
            font-size: 1.2rem;
            transition: margin-right 0.3s;
        }

        #sidebar.collapsed ul li a {
            justify-content: center;
            padding: 15px 10px;
        }

        #sidebar.collapsed ul li a i {
            margin-right: 0;
            font-size: 1.4rem;
        }

        #sidebar.collapsed ul li a .link-text {
            display: none;
        }
        
        /* --- Gaya Konten & Navbar Atas --- */
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        #sidebarCollapse {
            box-shadow: none;
        }
        
        /* --- Gaya Overlay/Backdrop Mobile --- */
        .overlay {
            display: none;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 998;
            opacity: 0;
            transition: all 0.5s ease-in-out;
        }
        .overlay.active {
            display: block;
            opacity: 1;
        }

        /* --- Media Query Responsif --- */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                left: -260px;
                height: 100vh;
                overflow-y: auto;
            }
            #sidebar.active {
                left: 0;
            }
            #sidebar.collapsed {
                min-width: 260px;
                max-width: 260px;
                text-align: left;
            }
            #sidebar.collapsed .sidebar-header h3,
            #sidebar.collapsed ul li a .link-text {
                display: block;
            }
            #sidebar.collapsed .sidebar-header::after {
                display: none;
            }
            #sidebar.collapsed ul li a {
                justify-content: flex-start;
                padding: 15px 20px;
            }
            #sidebar.collapsed ul li a i {
                margin-right: 15px;
            }
        }


        /* #sidebar .tlt {
            color: white;
            position: absolute;
            top: 0;
            left: 0;
            transform: translateX(100px);
            background-color: black;
            border-radius: .6rem;
            padding: .5em 2rem;
            transition: transform .5s;
        } */
    </style>
</head>
<body>
    <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" class="bg-dark bg-gradient">
        <div class="sidebar-header">
            <h3>Admin Menu</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="<?php echo BASEURL; ?>" class="sidebar-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="link-text">Home</span>
                </a>
                <!-- <span class="tlt">Home</span> -->
            </li>
            <li>
                <a href="<?php echo BASEURL; ?>/user" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span class="link-text">User</span>
                </a>
                <!-- <span class="tlt">User</span> -->
            </li>
            <li>
                <a href="<?php echo BASEURL; ?>/attendance" class="sidebar-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="link-text">Attendance</span>
                </a>
                <!-- <span class="tlt">Attendance</span> -->
            </li>
            <li>
                <!-- Menu Laporan (tanpa submenu) -->
                <a href="<?php echo BASEURL; ?>/report" class="sidebar-link">
                    <i class="fas fa-file-alt"></i>
                    <span class="link-text">Reports</span>
                </a>
                <!-- <span class="tlt">Reports</span> -->
            </li>
            <li>
                <a href="<?php echo BASEURL; ?>/setting" class="sidebar-link">
                    <i class="fas fa-cog"></i>
                    <span class="link-text">Settings</span>
                </a>
                <!-- <span class="tlt">Settings</span> -->
            </li>
            <li>
                <a href="#logout" class="sidebar-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-text">Logout</span>
                </a>
                <!-- <span class="tlt">Logout</span> -->
            </li>
        </ul>
    </nav>

    <!-- Konten Halaman Utama -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 rounded-3 shadow-sm">
            <div class="container-fluid">
                <!-- Tombol Toggle Sidebar -->
                <button type="button" id="sidebarCollapse" class="btn btn-primary me-3">
                    <i class="fas fa-align-left"></i>
                </button>
                
                <!-- Brand/Judul Halaman (Dinamis) -->
                <a class="navbar-brand fw-bold" href="#" id="pageTitle"><?= $data['title']; ?></a>
                
                <div class="ms-auto">
                    <span class="navbar-text">Selamat Datang, Admin!</span>
                </div>
            </div>
        </nav>

        <!-- Konten utama Anda dimulai di sini -->
        <div class="p-4 bg-light bg-gradient rounded-3 shadow-sm">
            <h2 id="content-title">Content</h2>