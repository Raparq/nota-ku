<?php
include 'database.php'; // Memasukkan file database

// Ambil ID dari query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data dari tabel invoices berdasarkan ID
    $stmt = $db->prepare('SELECT * FROM invoices WHERE id = ?');
    $stmt->bindValue(1, $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    
    // Jika invoice ditemukan, ambil data
    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // Set variabel dengan data dari database
        $tanggal = $row['tanggal'];
        $nama_customer = $row['nama_customer'];
        $telp_customer = $row['telp_customer'];
        $alamat_customer = $row['alamat_customer'];
        $nama_barang = $row['nama_barang'];
        $jumlah = $row['jumlah'];
        $harga = $row['harga'];
        $keterangan = $row['keterangan'];
        $subtotal = $row['subtotal'];
    } else {
        echo "Invoice tidak ditemukan.";
        exit();
    }
} else {
    echo "ID invoice tidak diberikan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .invoice {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .company-info {
            margin: 10px 0;
        }
        .company-info p {
            margin: 5px 0;
        }
        table {
            font-size:12px;
        width: 100%;
        border-collapse: collapse; /* Menghapus jarak antar border */
        margin-bottom: 10px; /* Jarak antar tabel */
    }
    th, td {
        border: 1px solid #dddddd; /* Border untuk sel */
        text-align: left; /* Text alignment */
        padding: 8px; /* Padding di dalam sel */
    }
    th {
        background-color: #f2f2f2; /* Background untuk header */
    }
    .keterangan {
        width: 50%; /* Lebar untuk kolom keterangan, sesuaikan sesuai kebutuhan */
        word-wrap: break-word; /* Memungkinkan teks panjang dipecah ke baris baru */
    }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .button-container {
            text-align: center;
            margin-top: 0px;
        }
        .customer-info {
    margin-bottom: 10px; /* Jarak antar bagian */
    margin-top: 10px;
    width: 50%; /* Atur lebar tabel customer */
}

.customer-info table {
    width: 100%; /* Mengatur tabel agar memenuhi lebar div */
    border-collapse: collapse; /* Menghindari garis batas ganda */
}

.customer-info tr {
    height: 10px; /* Menambahkan tinggi baris agar lebih rapi */
}

.customer-info th, .customer-info td {
    padding: 5px; /* Mengatur padding di sel */
    text-align: left; /* Mengatur text-align agar kiri */
    border: none; /* Menghilangkan garis batas */
    outline: none; /* Menghilangkan outline saat sel difokuskan */
}

.customer-info th {
    background: none; /* Menghilangkan background pada header */
    font-weight: bold; /* Membuat teks header menjadi tebal */
}

.customer-info td {
    background-color: #f9f9f9; /* Tambahkan latar belakang pada sel data */
}
        
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>EZ-COMPUTER</h1>
            <div class="company-info">
                <p>Jln. Kemiri Raya Pondok Cabe Tangsel Tlp: 0895 3336 10046</p>
            </div>
        </div>

        <h2>Data Customer</h2>
        <table class="customer-info">
            <tr>
                <th class="header">Nama:</th>
                <th><?php echo htmlspecialchars($nama_customer); ?></th>
            </tr>
            <tr>
                <th class="header">Telepon:</th>
                <th><?php echo htmlspecialchars($telp_customer); ?></th>
            </tr>
            <tr>
                <th class="header">Alamat:</th>
                <th><?php echo htmlspecialchars($alamat_customer); ?></th>
            </tr>
        </table>

        <h2>Detail Barang</h2>
        <table>
            <tr>
                <th class="header">Nama Barang</th>
                <th class="header">Jumlah</th>
                <th class="header">Harga</th>
                <th class="header">Keterangan</th>
                <th class="header">Subtotal</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($nama_barang); ?></td>
                <td><?php echo htmlspecialchars($jumlah); ?></td>
                <td><?php echo number_format($harga, 2); ?></td>
                <td><?php echo htmlspecialchars($keterangan); ?></td>
                <td><?php echo number_format($subtotal, 2); ?></td>
            </tr>
        </table>

        <div class="total">
            <p>Total: <?php echo number_format($subtotal, 2); ?></p>
        </div>

        <form method="post" action="some_save_script.php"> <!-- Ganti dengan script yang sesuai untuk simpan -->
            <input type="hidden" name="nama_customer" value="<?php echo htmlspecialchars($nama_customer); ?>">
            <input type="hidden" name="telp_customer" value="<?php echo htmlspecialchars($telp_customer); ?>">
            <input type="hidden" name="alamat_customer" value="<?php echo htmlspecialchars($alamat_customer); ?>">
            <input type="hidden" name="nama_barang" value="<?php echo htmlspecialchars($nama_barang); ?>">
            <input type="hidden" name="jumlah" value="<?php echo htmlspecialchars($jumlah); ?>">
            <input type="hidden" name="harga" value="<?php echo htmlspecialchars($harga); ?>">
            <input type="hidden" name="keterangan" value="<?php echo htmlspecialchars($keterangan); ?>">
            <input type="hidden" name="subtotal" value="<?php echo htmlspecialchars($subtotal); ?>">
            <div class="button-container">
                <input type="submit" value="💌">
                <input type="button" value="🆗" onclick="window.print();">
                <input type="button" value="🔄" onclick="history.back();">
            </div>
        </form>
    </div>
    <a href="inputcst.php">➰</a>
</body>
</html>
