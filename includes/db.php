<?php
// Veritabanı bağlantı ayarları
$host = 'localhost';
$dbname = 'portfolyo_db';
$username = 'root'; // XAMPP varsayılan kullanıcı adı
$password = ''; // XAMPP varsayılan şifre (boş)

try {
    // PDO ile MySQL bağlantısı kurma
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Hata modunu exception (istisna) olarak ayarlama
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // FETCH modunu varsayılan olarak ASSOC (İlişkisel Dizi) ayarlama
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Bağlantı hatası olursa ekrana yazdır ve çalışmayı durdur
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>
