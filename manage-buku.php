<?php
//  fungsi untuk memulai atau mengaktifkan sesi pada halaman web. Sesi digunakan untuk menyimpan informasi pengguna antara permintaan halaman yang berbeda.
session_start();
// untuk menonaktifkan laporan kesalahan. Ini bertujuan untuk menghindari tampilan pesan kesalahan yang tidak perlu kepada pengguna.
error_reporting(0);
// perintah untuk mengimpor atau menyertakan file config.php
include('config.php');
// memeriksa apakah panjang nilai dari $_SESSION['id'] adalah 0 atau tidak. Jika panjangnya 0, maka pengguna diarahkan ke halaman mydb.php
if (strlen($_SESSION['id'] == 0)) {
    header('location:mydb.php');
} else {

    // Jika ada parameter GET dengan nama 'del' (misalnya: ?del=1), maka bagian kode di dalam blok if (isset($_GET['del'])) akan dieksekusi.
    if (isset($_GET['del'])) {
        $bookid = $_GET['id'];
        // terjadi penghapusan data dari tabel buku berdasarkan ID yang diterima melalui parameter GET ($bukuid)
        mysqli_query($con, "delete from books where id ='$bookid'");
        $_SESSION['msg'] = "data deleted !";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Manage Book</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    </head>

    <body>
        <div class="main-content">
            <div class="wrap-content container">
                <section>
                    <div class="row">
                        <div class="col-sm-8 mt-3">
                            <h1><i class="fa-solid fa-book"></i>Manage Book </h1>
                        </div>
                    </div>
                </section>
                <div class="container-fluid bg-warning">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- kode ini berfungsi untuk mencetak pesan yang disimpan dalam variabel $_SESSION['msg'] ke halaman HTML, menggunakan warna teks merah, 
                            dan kemudian mengosongkan variabel tersebut agar pesan tidak tercetak lagi pada kunjungan berikutnya ke halaman. -->
                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                <!-- perintah PHP yang bertujuan untuk menghapus nilai dari variabel $_SESSION['msg'] setelah dicetak ke halaman -->
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </p>
                            <table class="table table-hover" style="border-radius:6px;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // menjalankan query SQL yang mengambil semua data dari tabel "books". Fungsi mysqli_query() digunakan untuk menjalankan query SQL pada koneksi database yang disimpan dalam variabel $con
                                    $sql = mysqli_query($con, "select * from books");
                                    // menginisialisasi variabel $cnt dengan nilai 1. 
                                    $cnt = 1;
                                    // awal dari loop while
                                    while ($row = mysqli_fetch_array($sql)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; ?>.</td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['author']; ?></td>
                                            <td><?php echo $row['publisher']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td>
                                                <div>
                                                    <!-- Menambah icon dari font awesome -->
                                                    <a href="edit-buku.php?id=<?php echo $row['id']; ?>" class="btn" title="Change"><i class="fa fa-pencil"></i></a>

                                                    <a href="manage-buku.php?id=<?php echo $row['id'] ?>&del=delete" title="Delete" onClick="return confirm('Are you sure you want to delete?')" class="btn"><i class="fa fa-times fa fa-white"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        // increment dari varibel cnt
                                        $cnt = $cnt + 1;
                                        // alkhir while loop }
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row text-end">
                        <a href="add-buku.php" class="btn">
                            <i class="fa-solid fa-circle-plus fa-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>