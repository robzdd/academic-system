<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <style>
        body { margin:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#F3F4F6; color:#111827; }
        .sidebar {
            width:220px; height:100vh; background:#1E3A8A; color:white; position:fixed; top:0; left:0;
            display:flex; flex-direction:column; padding:20px; box-shadow:2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 { margin-bottom:30px; font-size:1.5rem; letter-spacing:1px; }
        .sidebar a {
            color:white; text-decoration:none; margin:10px 0; display:block; padding:8px 12px;
            border-radius:6px; transition:0.2s;
        }
        .sidebar a:hover { background:#3B82F6; }
        .main { margin-left:240px; padding:20px; }
        header {
            display:flex; justify-content:space-between; align-items:center;
            background:#3B82F6; color:white; padding:15px 25px; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }
        .card {
            background:white; padding:20px; margin:20px 0; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);
        }
        table { width:100%; border-collapse: collapse; margin-top:15px; }
        table, th, td { border:1px solid #E5E7EB; }
        th, td { padding:10px; text-align:left; }
        th { background:#3B82F6; color:white; border-radius:6px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Siakad</h2>
        <a href="#">Dashboard</a>
        <a href="#">KRS</a>
        <a href="#">KHS / Nilai</a>
        <a href="#">Jadwal</a>
        <a href="#">Pengumuman</a>
    </div>
    <div class="main">
        <header>
            <div>Selamat datang, Mahasiswa Test</div>
        </header>

        <div class="card">
            <h3>Ringkasan Akademik</h3>
            <p>Semester: 4</p>
            <p>IPK: 3.75</p>
            <p>SKS: 110</p>
        </div>

        <div class="card">
            <h3>Pengumuman</h3>
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pendaftaran KRS Dibuka</td>
                        <td>2025-10-05</td>
                    </tr>
                    <tr>
                        <td>Ujian Tengah Semester</td>
                        <td>2025-10-15</td>
                    </tr>
                    <tr>
                        <td>Pengumuman Libur Nasional</td>
                        <td>2025-10-20</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
