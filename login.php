<?php
session_start();
require_once 'includes/db.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $admin['username'];
                
                setcookie("last_login", date("d.m.Y H:i"), time() + (86400 * 30), "/");

                header("Location: admin.php");
                exit;
            } else {
                $error = "Kullanıcı adı veya şifre hatalı!";
            }
        } catch(PDOException $e) {
            $error = "Veritabanı hatası oluştu.";
        }
    } else {
        $error = "Lütfen tüm alanları doldurun!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi | Sezer Portfolyo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
            padding: 1rem;
        }
        .login-box { 
            background-color: rgba(255,255,255,0.03); 
            border: 1px solid rgba(255,255,255,0.1); 
            padding: 3rem; 
            border-radius: 1.5rem; 
            width: 100%; 
            max-width: 420px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.4); 
            backdrop-filter: blur(10px);
        }
        .login-box h2 { 
            text-align: center; 
            margin-bottom: 0.5rem; 
            color: #fff; 
            font-size: 1.8rem;
            font-weight: 700;
        }
        .login-desc {
            text-align: center;
            color: #a1a1aa;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
        .error-msg { 
            background-color: rgba(239, 68, 68, 0.1); 
            color: #f87171; 
            border: 1px solid rgba(239, 68, 68, 0.2); 
            padding: 1rem; 
            border-radius: 0.5rem; 
            margin-bottom: 1.5rem; 
            text-align: center; 
            font-size: 0.9rem;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #a1a1aa;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #ffffff;
        }
    </style>
</head>
<body class="dark-mode">
    <div class="login-box">
        <h2>Yönetim Paneli</h2>
        <p class="login-desc">Sadece yetkili kişiler giriş yapabilir.</p>
        <?php if($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" required autocomplete="off">
            </div>
            <div class="form-group" style="margin-bottom: 2rem;">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="contact-submit-btn">Giriş Yap</button>
        </form>
        <a href="index.html" class="back-link">← Siteye Dön</a>
    </div>
</body>
</html>
