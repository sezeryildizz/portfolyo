# Kişisel Portfolyo Web Uygulaması - Proje Raporu

## 1. Proje Özeti
Bu proje, projelerimi ve teknik yeteneklerimi sergilemek ve ziyaretçilerin benimle kolayca iletişim kurmasını sağlamak amacıyla geliştirilmiş dinamik, full-stack bir kişisel portfolyo web uygulamasıdır. Statik bir HTML sitesinin aksine bu portfolyo, yöneticinin (admin) arka plandaki güvenli bir panel üzerinden proje listesini dinamik olarak güncellemesine ve gelen iletişim mesajlarını yönetmesine olanak tanıyan özel olarak geliştirilmiş bir içerik yönetim sistemine (CMS) sahiptir.

## 2. Kullanılan Teknolojiler
Uygulama, temel web teknolojilerinde derinlemesine bir anlayış kazanmak amacıyla ağır framework'lere bağlı kalmadan, sıfırdan ve modern bir teknoloji yığını kullanılarak inşa edilmiştir:

*   **Frontend (Ön Yüz):**
    *   **HTML5 & CSS3:** Mobil uyumlu (responsive) kullanıcı arayüzünü oluşturmak ve şekillendirmek için kullanıldı.
    *   **JavaScript (Vanilla):** DOM manipülasyonu, Karanlık/Aydınlık (Dark/Light) tema geçişi ve asenkron API isteklerini yönetmek için kullanıldı.
*   **Backend (Arka Yüz):**
    *   **PHP:** Sunucu tarafı mantığını yönetmek, güvenli yönetici kimlik doğrulaması (oturumlar/sessions) sağlamak ve form verilerini işlemek için kullanıldı.
*   **Veritabanı:**
    *   **MySQL:** Yönetici giriş bilgilerini (şifrelenmiş olarak), proje verilerini (başlık, açıklama, kullanılan teknolojiler, görsel yolları) ve kullanıcı mesajlarını güvenli bir şekilde saklamak için kullanılan ilişkisel veritabanı.
*   **Diğer Araçlar:**
    *   **AJAX:** İstemciden sunucuya sayfa yenilenmeden (no-reload) sorunsuz veri gönderimi için kullanıldı.
    *   **XAMPP:** Yerel geliştirme ortamı ve sunucusu olarak kullanıldı.

## 3. Mimari ve Geliştirme Süreci (Nasıl Yapıldı?)

### Veritabanı Tasarımı
Projenin temeli, üç ana tablodan oluşan ilişkisel bir MySQL veritabanına dayanmaktadır:
1.  **`admin`**: Yöneticinin güvenli giriş bilgilerini barındırır.
2.  **`projects`**: Portfolyo galerisinin ön yüzde dinamik olarak oluşturulmasını sağlayan, projelere ait tüm detayları barındırır.
3.  **`messages`**: Ziyaretçiler tarafından iletişim formu aracılığıyla gönderilen mesajları yakalar ve saklar.

### Frontend Geliştirme
Kullanıcı arayüzü, tüm cihazlarda (telefon, tablet, bilgisayar) kusursuz görünmesi için "mobile-first" (önce mobil) yaklaşımıyla tasarlandı. Temiz ve anlaşılır bir kod yapısı için modüler bir CSS mimarisi uygulandı. Kullanıcı deneyimini artırmak için JavaScript yoğun olarak kullanıldı; kullanıcının tercihini `localStorage`'da saklayan kalıcı bir Karanlık/Aydınlık tema butonu entegre edildi.

### Backend ve API (AJAX) Entegrasyonu
Uygulamanın temel mantığı PHP ile yönetilmektedir. Bir kullanıcı iletişim formunu doldurduğunda, JavaScript bu veriyi alır ve asenkron bir AJAX isteği ile PHP işleme dosyasına (`process_contact.php`) gönderir. PHP, gelen veriyi doğrular, MySQL veritabanına kaydeder ve frontend tarafına JSON formatında bir yanıt döndürür. Böylece sayfa yenilenmeden ekranda bir başarı veya hata mesajı gösterilir.

### Yönetim Paneli (Admin Dashboard)
Siteyi tamamen dinamik hale getirmek için güvenli ve kimlik doğrulama gerektiren bir Yönetici Paneli (Admin Panel) geliştirildi. Panele erişim PHP Session (Oturum) yönetimi ile kısıtlandı. Yönetici giriş yaptıktan sonra tam kapsamlı CRUD (Oluştur, Oku, Güncelle, Sil) işlemlerini gerçekleştirebilir. Bu sayede, HTML dosyalarına manuel olarak kod yazmaya gerek kalmadan, doğrudan veritabanı üzerinden yeni projeler eklenebilir, mevcut projeler düzenlenebilir veya ziyaretçi mesajları okunup silinebilir.

## 4. Temel Özellikler
*   **Dinamik Veri İşleme:** Projeler ve mesajlar tamamen veritabanı üzerinden çekilir.
*   **Güvenli Admin Paneli:** Site yönetimi ve veri girişi için korumalı kontrol paneli.
*   **Asenkron İletişim Formu:** Sayfa yenilenmesine gerek kalmadan anlık geri bildirim sağlayan AJAX destekli form.
*   **Tema Özelleştirmesi:** Kullanıcı tercihini hatırlayan interaktif Karanlık/Aydınlık mod (Dark/Light mode) geçişi.
*   **Tam Duyarlı (Responsive) Tasarım:** Masaüstü, tablet ve mobil cihazlar için optimize edilmiş görünüm.

## 5. Sonuç
Bu full-stack portfolyo projesini geliştirmek; ön yüz arayüzleri ile arka plan mantığını ve veritabanı yönetimini birbirine bağlama konusunda kapsamlı bir deneyim sağlamıştır. Sıfırdan özel bir web uygulamasının nasıl inşa edilebileceğini, güvenliğinin nasıl sağlanabileceğini ve dinamik bir yapının nasıl kurulabileceğini başarılı bir şekilde ortaya koymuş; hem tasarım estetiğini hem de sağlam bir işlevsel mimariyi bir araya getirmiştir.
