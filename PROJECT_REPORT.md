# Full-Stack Web Portfolyo Proje Raporu

**Öğrenci Adı:** Sezer Yıldız  
**Proje Tarihi:** Mayıs 2026  
**Ders:** Yazılım Mühendisliği - Full-Stack Web Geliştirme  

---

## 1. Projeye Genel Bakış
Bu proje; teknik becerileri ve akademik projeleri sergilemek amacıyla tasarlanmış, dinamik ve profesyonel bir Full-Stack Web Portfolyosudur. Modern ve responsive (duyarlı) bir kullanıcı arayüzü, içerik yönetimi için bir yönetim paneli ve sürdürülebilir bir arka plan (backend) sistemine sahiptir.

## 2. Kullanılan Teknolojiler
- **Frontend:** HTML5 (Semantik), CSS3 (Flexbox/Grid), Vanilla JavaScript (ES6+).
- **Backend:** PHP 8.x (Sunucu tarafı mantığı, Oturum ve Çerez yönetimi).
- **Veritabanı:** MySQL (İlişkisel veri depolama).
- **Mimari:** Modüler yapı (Frontend, Backend, Includes).

## 3. Temel Özellikler ve Uygulama Detayları

### A. Semantik HTML ve Gelişmiş CSS
- SEO ve erişilebilirlik için semantik etiketler (`<header>`, `<main>`, `<section>`) kullanılmıştır.
- CSS Değişkenleri ve Media Query'ler kullanılarak, her türlü cihazda mükemmel görünüm sağlayan **Responsive Design** uygulanmıştır.
- Dinamik bir grid arka planına sahip, **Zinc temelli modern bir kullanıcı arayüzü** tasarımı yapılmıştır.

### B. İstemci Tarafı Etkileşimi (JavaScript)
- **Asenkron Veri (AJAX):** Projeler, **Fetch API** aracılığıyla asenkron olarak çekilir. Bu sayede sayfa yenilenmeden dinamik içerik yüklenir.
- **Tema Yönetimi (Persistence):** Kullanıcı tercihlerini kaydeden, `localStorage` tabanlı kalıcı bir **Karanlık/Aydınlık Mod** özelliği eklenmiştir.
- **Gelişmiş Form Doğrulama:** İletişim formu, Regex ve boş alan kontrolü ile JavaScript tarafında doğrulanmadan gönderilmez.

### C. Sunucu Tarafı Mantığı ve Veritabanı (PHP/MySQL)
- **Mesaj Yönetimi:** Gönderilen mesajlar PHP ile işlenip MySQL veritabanındaki `messages` tablosuna kaydedilir.
- **Dinamik Proje Yönetimi:** Tüm projeler veritabanından çekilir ve Admin Paneli üzerinden tam kapsamlı **CRUD (Ekle/Sil/Düzenle)** işlemleri yapılabilir.

### D. Durum Yönetimi ve Güvenlik (Sessions & Cookies)
- **Oturum Yönetimi (Sessions):** Yönetici yetkilendirmesi PHP `$_SESSION` ile güvenli hale getirilmiştir.
- **Çerez Kullanımı (Cookies):** Kullanıcının en son giriş yaptığı tarih ve saat bilgisi `setcookie()` fonksiyonu ile bir çerezde saklanır ve Admin Panelinde gösterilir.
- **Güvenli Şifreleme:** Şifreler veritabanında **Bcrypt (password_hash)** algoritması ile korunmaktadır.
- **XSS & SQL Injection Koruması:** `escapeHTML` ve PDO `prepared statements` kullanılarak veritabanı ve kullanıcı güvenliği sağlanmıştır.

## 4. Sonuç
Bu uygulama; AJAX, PHP ve MySQL entegrasyonu ile modern web standartlarını karşılayan, güvenli ve kullanıcı dostu bir portfolyo sistemidir.

---
*Ders yönergelerine uygun olarak, tutkuyla ve yapay zeka destekli hata ayıklama yöntemleriyle geliştirilmiştir.*
