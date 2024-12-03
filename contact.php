<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validasi sederhana
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('Please fill in all fields.');</script>";
        exit;
    }

    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Ganti dengan password MySQL Anda
    $dbname = "db_jesika";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Simpan data ke database
    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Pesan berhasil di kirim terimakasih!');</script>";
    } else {
        echo "<script>alert('pesan gagal dikirim.');</script>";
    }

    $stmt->close();
    $conn->close();

    // Redirect atau kembali ke halaman kontak
    echo "<script>window.location.href = 'main.html';</script>";
}
?>