<?php
// Koneksi ke database
$servername = "localhost";  // Ganti dengan server Anda
$username = "root";         // Ganti dengan username Anda
$password = "";             // Ganti dengan password Anda
$dbname = "biodata_diri";   // Nama database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani form jika ada data dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    // Menyimpan data ke tabel biodata
    $sql = "INSERT INTO biodata (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan data dalam tabel
$sql = "SELECT * FROM biodata";
$result = $conn->query($sql);

// CSS untuk tampilan tabel
echo "<style>
    body {
        font-family: Poppins;
        margin: 20px;
        background-color: #f4f4f9;
        color: #333;
    }
    table {
        border-collapse: collapse;
        width: 70%;
        margin: 20px auto;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        background: #fff;
    }
    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #3b85ca;
        color: white;
        text-transform: uppercase;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    h2 {
        text-align: center;
        color: #333;
    }
</style>";

echo "<h2>TABEL BIODATA MAHASISWA</h2>";
echo "<table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>JURUSAN</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["nim"] . "</td>
                <td>" . $row["jurusan"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Tidak ada data.</p>";
}

$conn->close();