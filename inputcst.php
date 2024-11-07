<?php
include 'database.php'; // Memasukkan file database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $tanggal = date('Y-m-d H:i:s'); // Waktu saat ini
    $nama_customer = $_POST['nama_customer'];
    $telp_customer = $_POST['telp_customer'];
    $alamat_customer = $_POST['alamat_customer'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $subtotal = $jumlah * $harga; // Hitung subtotal

    // Simpan ke database
    $stmt = $db->prepare('INSERT INTO invoices (tanggal, nama_customer, telp_customer, alamat_customer, nama_barang, jumlah, harga, keterangan, subtotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bindValue(1, $tanggal);
    $stmt->bindValue(2, $nama_customer);
    $stmt->bindValue(3, $telp_customer);
    $stmt->bindValue(4, $alamat_customer);
    $stmt->bindValue(5, $nama_barang);
    $stmt->bindValue(6, $jumlah);
    $stmt->bindValue(7, $harga);
    $stmt->bindValue(8, $keterangan);
    $stmt->bindValue(9, $subtotal);
    $stmt->execute();
    echo "Data berhasil disimpan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            color: #333;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: inline-block;
            margin: 0px 0px 0px 0; /* Margins untuk memberi jarak antar label */
            width: 80px; /* Lebar label agar sejajar */
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 160px); /* Mengurangi lebar untuk menampung label */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block; /* Menjadikan input berada di samping label */
        }
        input[type="submit"] {
            background-color: #4CAF50; /* Hijau */
            color: white;
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block; /* Tombol akan berada di baris baru */
            margin-top: 15px; /* Jarak atas untuk tombol */
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Lebih gelap saat hover */
        }
        .section {
            margin-bottom: 0px; /* Jarak antar tabel */
        }
        .section h2 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Invoice Service</h1>
    <form method="post">
        <div class="section">
            <h2>Data Customer</h2>
            <label>Nama Customer:</label>
            <input type="text" name="nama_customer" required>
            <label>Telepon Customer:</label>
            <input type="text" name="telp_customer" required>
            <label>Alamat Customer:</label>
            <input type="text" name="alamat_customer" required>
        </div>

        <div class="section">
            <h2>Detail Barang</h2>
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" required>
            <label>Jumlah:</label>
            <input type="number" name="jumlah" required>
            <label>Harga:</label>
            <input type="number" name="harga" step="0.01" required>
            <label>Keterangan:</label>
            <input type="text" name="keterangan">
        </div>

        <input type="submit" value="Simpan">
    </form>
    <a href="view.php">Lihat Invoice</a>
</body>
</html>
