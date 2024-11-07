<?php
// database.php
$db = new SQLite3('invoices.db');

// Buat tabel jika belum ada
$query = "CREATE TABLE IF NOT EXISTS invoices (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tanggal TEXT NOT NULL,
    nama_customer TEXT NOT NULL,
    telp_customer TEXT NOT NULL,
    alamat_customer TEXT NOT NULL,
    nama_barang TEXT NOT NULL,
    jumlah INTEGER NOT NULL,
    harga REAL NOT NULL,
    keterangan TEXT,
    subtotal REAL NOT NULL
)";

$db->exec($query);
?>
