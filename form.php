<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);


$conn->set_charset("utf8");


$sql_db = "CREATE DATABASE IF NOT EXISTS okul_odevi CHARACTER SET utf8 COLLATE utf8_turkish_ci";
$conn->query($sql_db);


$conn->select_db("okul_odevi");


$sql_tablo = "CREATE TABLE IF NOT EXISTS kisi (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(30) NOT NULL,
    soyad VARCHAR(30) NOT NULL,
    email VARCHAR(50)
)";
$conn->query($sql_tablo);


$mesaj = "";
$aramaSonucu = "";


if (isset($_POST['kaydet'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];

   
    $sql = "INSERT INTO kisi (ad, soyad, email) VALUES ('$ad', '$soyad', '$email')";

    if ($conn->query($sql) === TRUE) {
        $mesaj = "Yeni kayıt başarıyla oluşturuldu.";
    } else {
        $mesaj = "Hata: " . $conn->error;
    }
}


if (isset($_POST['ara'])) {
    $aranan_isim = $_POST['aranan_isim'];

   
    $sql = "SELECT soyad, email FROM kisi WHERE ad='$aranan_isim'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        while($row = $result->fetch_assoc()) {
            $aramaSonucu .= "<b>Bulunan Kişi:</b> " . $aranan_isim . "<br>";
            $aramaSonucu .= "<b>Soyad:</b> " . $row["soyad"] . "<br>";
            $aramaSonucu .= "<b>Email:</b> " . $row["email"] . "<br><hr>";
        }
    } else {
        $aramaSonucu = "Bu isimde kayıt bulunamadı.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Veri Tabanı Ödevi</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #c1c0c0ff; 
            display: flex; 
            justify-content: center; 
            padding-top: 50px; 
        }
        .container {
            display: flex;
            gap: 30px;
        }
        .form-kutu { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            width: 300px; 
        }
        input[type="text"], input[type="email"] { 
            width: 100%; 
            padding: 8px; 
            margin: 5px 0 15px 0; 
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #96f399ff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .basari { color: green; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    
   
    <div class="form-kutu">
        <h3>Yeni Kişi Ekle</h3>
        <?php if($mesaj != "") echo "<p class='basari'>$mesaj</p>"; ?>
        
        <form method="POST">
            Ad: <input type="text" name="ad" required>
            Soyad: <input type="text" name="soyad" required>
            Email: <input type="email" name="email" required>
            <input type="submit" name="kaydet" value="Kaydet">
        </form>
    </div>

   
    <div class="form-kutu">
        <h3>Kişi Bul</h3>
        <p style="font-size:14px; color:#666;">İsim girerek soyad ve maili bulun.</p>
        
        <form method="POST">
            Aranacak İsim: <input type="text" name="aranan_isim" required>
            <input type="submit" name="ara" value="Bul" style="background-color: #6dbbd5ff;">
        </form>
        
        <br>
        <div style="background-color: #c1c0c0ff; padding: 10px;">
            <?php echo $aramaSonucu; ?>
        </div>
    </div>

</div>

</body>
</html>