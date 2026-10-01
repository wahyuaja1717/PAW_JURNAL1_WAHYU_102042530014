<?php
$errors = [];
$success = false;

$nama = "";
$whatsapp = "";
$email = "";
$matkul = "";
$motivasi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST["nama"] ?? "");
    $whatsapp = trim($_POST["whatsapp"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $matkul = trim($_POST["matkul"] ?? "");
    $motivasi = trim($_POST["motivasi"] ?? "");

    if ($nama == "") {
        $errors["nama"] = "Nama lengkap wajib diisi.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors["nama"] = "Nama lengkap hanya boleh berisi huruf.";
    }

    if ($whatsapp == "") {
        $errors["whatsapp"] = "Nomor WhatsApp wajib diisi.";
    } elseif (!preg_match("/^(0|62)[0-9]+$/", $whatsapp)) {
        $errors["whatsapp"] = "Nomor WhatsApp harus diawali 0 atau 62.";
    }

    if ($email == "") {
        $errors["email"] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format email tidak valid.";
    }

    if ($matkul == "") {
        $errors["matkul"] = "Mata kuliah wajib dipilih.";
    }

    if ($motivasi == "") {
        $errors["motivasi"] = "Motivasi wajib diisi.";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Asisten Praktikum</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<?php if (!$success) { ?>

    <div class="card">
        <h1>Pendaftaran Asisten Praktikum</h1>
        <p class="subtitle">Laboratorium Enterprise Application Development</p>

        <form method="POST">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama"
                       value="<?= htmlspecialchars($nama) ?>"
                       placeholder="Masukkan nama lengkap">

                <?php if (isset($errors["nama"])) { ?>
                    <small><?= $errors["nama"] ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <label>Nomor WhatsApp</label>
                <input type="text" name="whatsapp"
                       value="<?= htmlspecialchars($whatsapp) ?>"
                       placeholder="Contoh: 08123456789">

                <?php if (isset($errors["whatsapp"])) { ?>
                    <small><?= $errors["whatsapp"] ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <label>Email Institusi</label>
                <input type="email" name="email"
                       value="<?= htmlspecialchars($email) ?>"
                       placeholder="Masukkan email">

                <?php if (isset($errors["email"])) { ?>
                    <small><?= $errors["email"] ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <label>Pilihan Mata Kuliah Praktikum</label>

                <select name="matkul">
                    <option value="">-- Pilih Mata Kuliah --</option>

                    <option value="Pemrograman Aplikasi Web"
                        <?= $matkul == "Pemrograman Aplikasi Web" ? "selected" : "" ?>>
                        Pemrograman Aplikasi Web
                    </option>

                    <option value="Basis Data"
                        <?= $matkul == "Basis Data" ? "selected" : "" ?>>
                        Basis Data
                    </option>

                    <option value="Pemrograman Berorientasi Objek"
                        <?= $matkul == "Pemrograman Berorientasi Objek" ? "selected" : "" ?>>
                        Pemrograman Berorientasi Objek
                    </option>
                </select>

                <?php if (isset($errors["matkul"])) { ?>
                    <small><?= $errors["matkul"] ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <label>Motivasi Mendaftar</label>

                <textarea name="motivasi"
                          placeholder="Tuliskan motivasi Anda"><?= htmlspecialchars($motivasi) ?></textarea>

                <?php if (isset($errors["motivasi"])) { ?>
                    <small><?= $errors["motivasi"] ?></small>
                <?php } ?>
            </div>

            <button type="submit">Daftar</button>

        </form>
    </div>

<?php } else { ?>

    <div class="card">
        <h1>Pendaftaran Berhasil</h1>

        <p class="success">
            Pendaftaran Anda telah diterima.
        </p>

        <div class="registration">
            <h2>Kartu Registrasi</h2>

            <p><b>Nama:</b> <?= htmlspecialchars($nama) ?></p>
            <p><b>WhatsApp:</b> <?= htmlspecialchars($whatsapp) ?></p>
            <p><b>Email:</b> <?= htmlspecialchars($email) ?></p>
            <p><b>Mata Kuliah:</b> <?= htmlspecialchars($matkul) ?></p>
            <p><b>Motivasi:</b> <?= nl2br(htmlspecialchars($motivasi)) ?></p>
        </div>

        <button onclick="window.print()">Lihat Data Pendaftar</button>

    </div>

<?php } ?>

</div>

</body>
</html>