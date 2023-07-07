<!DOCTYPE html>
<html>
<head>
    <title>My Portfolio</title>
    <!-- Memuat file CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>UTS Pemrograman Web 1</h1>
            <div class="profile-image">
                <img src="Abror.jpeg" alt="Gambar Profil Anda" class="img-fluid rounded-circle mb-4" style="width: 200px;">
            </div>
        </div>
    </header>

    <section id="profil" class="bg-light">
        <div class="container py-5">
            <h2 class="mb-4">Profil Saya</h2>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama :</strong> Abror Abdul Gani </p>
                    <p><strong>NPM :</strong> 21312022</p>
                    <p><strong>Jurusan :</strong> S1 Informatika</p>
                    <p><strong>Kelas :</strong> IF 21 A</p>
                    <div class="skills">
                        <h3>Keahlian</h3>
                        <p>Bermain Gitar</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="diri.jpeg" alt="Foto Diri Anda" class="img-fluid rounded-circle mb-4" style="width: 200px;">
                    <div class="activities">
                        <h3>Seminar/Workshop yang Pernah Diikuti</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Seminar ilmiah perbandingan harga saham BRI</li>
                            <li class="list-group-item">Workshop Community Metaverse</li>
                            <li class="list-group-item">Workshop Augmented Reality & Virtual Reality</li>
                            <!-- Tambahkan entri lain sesuai kebutuhan -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak">
        <div class="container py-5">
            <h2 class="mb-4">Kontak</h2>
            <div class="contact-info">
                <ul class="list-unstyled">
                    <li><i class="fab fa-instagram me-2"></i> <a href="https://instagram.com/abror.ag?igshid=OGQ5ZDc2ODk2ZA==">Instagram</a></li>
                    <li><i class="fab fa-facebook me-2"></i> <a href="https://www.facebook.com/profile.php?id=100077185472879&mibextid=LQQJ4d">Facebook</a></li>
                    <li><i class="fab fa-whatsapp    me-2"></i> <a href="https://api.whatsapp.com/send?phone=085783908208_anda&text=Halo%20saya%20ingin%20bertanya">whatsapp</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section id="hasil-karya" class="bg-light">
        <div class="container py-5">
            <h2 class="mb-4">Hasil Karya</h2>
            <div class="portfolio">
                <?php
                // Koneksi ke database
                $koneksi = mysqli_connect("localhost", "root", "", "db_uts");

                // Cek koneksi
                if (mysqli_connect_errno()) {
                    echo "Koneksi database gagal: " . mysqli_connect_error();
                }

                // Menambahkan data hasil karya
                if (isset($_POST['submit'])) {
                    $judul = $_POST['judul'];
                    $deskripsi = $_POST['deskripsi'];
                    $gambar = $_POST['gambar'];

                    $query = "INSERT INTO hasil_karya (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')";
                    mysqli_query($koneksi, $query);
                }

                // Menghapus data hasil karya
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];

                    $query = "DELETE FROM hasil_karya WHERE id = '$id'";
                    mysqli_query($koneksi, $query);
                }

                // Query untuk mendapatkan data dari database
                $query = "SELECT * FROM hasil_karya";
                $result = mysqli_query($koneksi, $query);

               // Perulangan untuk menampilkan data hasil karya
                $count = 0; // Variabel untuk menghitung jumlah gambar
                echo '<div class="row">'; // Membuka baris pertama
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($count % 3 == 0 && $count != 0) {
                        echo '</div><div class="row">'; // Menutup baris sebelumnya dan membuka baris baru setiap 3 gambar
                    }
                
                    echo '<div class="card mb-3 col-md-4">';
                    if (strpos($row['gambar'], 'mp4') !== false || strpos($row['gambar'], 'avi') !== false || strpos($row['gambar'], 'mov') !== false) {
                        // Jika tipe file adalah video
                        echo '<video src="' . $row['gambar'] . '" class="card-img-top img-fluid" alt="Video Karya" style="object-fit: cover; height: 500px; width: 500px;" controls></video>';
                    } else {
                        // Jika tipe file adalah gambar
                        echo '<img src="' . $row['gambar'] . '" class="card-img-top img-fluid" alt="Gambar Karya" style="object-fit: cover; height: 500px; width: 500px;">';
                    }
                
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['judul'] . '</h5>';
                    echo '<p class="card-text">' . $row['deskripsi'] . '</p>';
                    echo '<a href="?delete=' . $row['id'] . '" class="btn btn-danger">Hapus</a>';
                    echo '</div>';
                    echo '</div>';
                    $count++;
                }
                
                echo '</div>'; // Menutup baris terakhir



                // Menutup koneksi database
                mysqli_close($koneksi);
                ?>
            </div>

            <div class="add-karya mt-4">
                <h3>Tambah Karya Baru</h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Karya</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Karya</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">URL Gambar/Video</label>
                        <input type="text" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="preview-gambar" class="form-label">Preview Gambar/video</label>
                        <div id="preview-gambar"></div>
                    </div>

                    <!-- Menambahkan script JavaScript -->
                    <script>
                    // Mendapatkan input URL gambar
                    var inputGambar = document.getElementById('gambar');
                    // Mendapatkan elemen div untuk preview gambar
                    var previewGambar = document.getElementById('preview-gambar');

                    // Menambahkan event listener pada perubahan input
                    inputGambar.addEventListener('input', function() {
                        // Menghapus konten preview gambar sebelumnya
                        previewGambar.innerHTML = '';

                        // Membuat elemen img untuk menampilkan gambar
                        var img = document.createElement('img');
                        // Mengatur sumber gambar menjadi URL yang dimasukkan pengguna
                        img.src = inputGambar.value;
                        // Mengatur gaya untuk menyesuaikan ukuran gambar dengan tampilan website
                        img.style.maxWidth = '70%';
                        img.style.maxHeight = '70%';
                        img.style.width = 'auto';
                        img.style.height = 'auto';

                        // Menambahkan elemen img ke dalam div preview gambar
                        previewGambar.appendChild(img);
                    });
                    </script>


                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Memuat file JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
