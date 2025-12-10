<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hafta 11-12 Ödev</title>
</head>
<body>

    
    <h3>Görev 1: 1-100 Arası Tek Sayılar</h3>
    <p>
    <?php
   
    for ($i = 1; $i <= 100; $i++) {
        
        if ($i % 2 == 0) {
            continue; 
        }
       
        echo $i . " - ";
    }
    ?>
    </p>

    <hr>

  
    <h3>Görev 2: Tablo Oluşturma</h3>
    
    
    <form action="" method="post">
        <label for="satir">Satır Sayısı:</label>
        <input type="number" name="satir" id="satir" required>
        
        <br><br>
        
        <label for="sutun">Sütun Sayısı:</label>
        <input type="number" name="sutun" id="sutun" required>
        
        <br><br>
        
        <button type="submit">Tablo Oluştur</button>
    </form>

    <br>

    <?php
    
    if (isset($_POST['satir']) && isset($_POST['sutun'])) {
        
        $satir = $_POST['satir'];
        $sutun = $_POST['sutun'];

        echo "<b>$satir satır ve $sutun sütunlu tablonuz:</b><br><br>";
        
      
        echo "<table border='1' cellspacing='0' cellpadding='10'>";
        
       
        for ($i = 0; $i < $satir; $i++) {
            echo "<tr>";
            
            
            for ($j = 0; $j < $sutun; $j++) {
                
                $rastgeleSayi = rand(1, 100); 
                echo "<td>" . $rastgeleSayi . "</td>";
            }
            
            echo "</tr>";
        }
        
        echo "</table>";
    }
    ?>

</body>
</html>