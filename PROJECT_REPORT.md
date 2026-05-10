# Full-Stack Web Portfolyo Proje Raporu

**Öğrenci Adı:** Sezer Yıldız  
**Proje Tarihi:** Mayıs 2026  
**Ders:** Yazılım Mühendisliği - Full-Stack Web Geliştirme  

---

## 1. Projeye Genel Bakış
Bu proje; teknik becerileri ve akademik projeleri sergilemek amacıyla tasarlanmış, dinamik ve profesyonel bir Full-Stack Web Portfolyosudur. Modern ve responsive (duyarlı) bir kullanıcı arayüzü, içerik yönetimi için bir yönetim paneli ve sürdürülebilir bir arka plan (backend) sistemine sahiptir.

## 2. Kullanılan Teknolojiler
- **Frontend:** HTML5 (Semantik), CSS3 (Flexbox/Grid), Vanilla JavaScript (ES6+).
- **Backend:** PHP 8.x (Sunucu tarafı mantığı ve Oturum yönetimi).
- **Veritabanı:** MySQL (İlişkisel veri depolama).
- **Mimari:** Modüler yapı (Frontend, Backend, Includes).

## 3. Temel Özellikler ve Uygulama Detayları

### A. Semantik HTML ve Gelişmiş CSS
- SEO ve erişilebilirlik için semantik etiketler (`<header>`, `<main>`, `<section>`) kullanılmıştır.
- CSS Değişkenleri ve Media Query'ler kullanılarak, mobil, tablet ve masaüstü cihazlarda mükemmel görünüm sağlayan **Duyarlı Tasarım (Responsive Design)** uygulanmıştır.
- Dinamik bir ızgara (grid) arka planına sahip, **Zinc temelli modern bir kullanıcı arayüzü** tasarımı yapılmıştır.

### B. İstemci Tarafı Etkileşimi (JavaScript)
- **Dinamik İçerik Yükleme:** Projeler, **Fetch API (AJAX)** aracılığıyla asenkron olarak çekilir ve DOM'a dinamik olarak yerleştirilir.
- **Tema Yönetimi:** Kullanıcı tercihlerini oturumlar arasında kaydeden, `localStorage` tabanlı kalıcı bir **Karanlık/Aydınlık Mod (Dark/Light Mode)** özelliği eklenmiştir.
- **Form Doğrulama:** İletişim formu, veri bütünlüğünü sağlamak amacıyla gönderimden önce JavaScript ile istemci tarafında doğrulanmaktadır.
- **Kullanıcı Deneyimi (UX):** Sayfa yüklenirken ve etkileşim sırasında yumuşak geçiş sağlayan animasyonlar eklenmiştir.

### C. Sunucu Tarafı Mantığı ve Veritabanı (PHP/MySQL)
- **İletişim Yönetimi:** İletişim formu aracılığıyla gönderilen mesajlar PHP tarafından işlenir ve MySQL'deki `messages` tablosunda saklanır.
- **Dinamik Proje Portfolyosu:** Tüm proje verileri (başlık, açıklama, görsel yolu) veritabanında tutulur; bu sayede kod değişikliği yapmadan yeni projeler eklenebilir.
- **CRUD İşlemleri:** Yönetim Paneli üzerinden projeler için oluşturma, okuma, güncelleme ve silme işlemleri tam kapsamlı olarak yapılabilmektedir.

### D. Güvenlik ve Durum Yönetimi
- **Oturum Yönetimi:** Yönetici erişimi PHP `$_SESSION` ile kontrol edilmektedir. Yetkisiz kullanıcılar otomatik olarak giriş sayfasına yönlendirilir.
- **Güvenli Şifreleme:** Yönetici şifreleri, `password_hash()` (Bcrypt) algoritması kullanılarak güvenli bir şekilde şifrelenmiştir.
- **Veri Güvenliği:** Cross-Site Scripting (XSS) saldırılarını önlemek amacıyla HTML kaçış (escaping) yöntemleri uygulanmıştır.

## 4. Sonuç
Bu portfolyo, akademik öğrenim ile profesyonel uygulama arasındaki köprü görevini görmektedir. AJAX, PHP ve MySQL entegrasyonu sayesinde uygulama, güçlü veri kalıcılığı ile kesintisiz bir kullanıcı deneyimi sunmaktadır.

---
*Ders yönergelerine uygun olarak, tutkuyla ve yapay zeka destekli hata ayıklama yöntemleriyle geliştirilmiştir.*
