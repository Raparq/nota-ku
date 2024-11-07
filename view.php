<?php
include 'database.php'; // Memasukkan file database

// Ambil semua data dari tabel invoices
$result = $db->query('SELECT * FROM invoices');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>View Invoices</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Invoice</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Customer</th>
                <th>Telepon Customer</th>
                <th>Alamat Customer</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Keterangan</th>
                <th>Subtotal</th>
                <th>Aksi</th> <!-- Kolom untuk tombol aksi -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['nama_customer']; ?></td>
                    <td><?php echo $row['telp_customer']; ?></td>
                    <td><?php echo $row['alamat_customer']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td><?php echo number_format($row['harga'], 2); ?></td>
                    <td><?php echo $row['keterangan']; ?></td>
                    <td><?php echo number_format($row['subtotal'], 2); ?></td>
                    <td>
                        <!-- Tombol untuk mengarahkan ke cetakan.php -->
                        <form action="cetakan.php" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Cetak">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="inputcst.php">Input Invoice Baru</a>
</body>
</html>
