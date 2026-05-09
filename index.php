<?php
require_once 'includes/db.php';

// Veritabanından projeleri çek
try {
    $stmt = $db->prepare("SELECT * FROM projects ORDER BY created_at DESC");
    $stmt->execute();
    $projects = $stmt->fetchAll();
} catch(PDOException $e) {
    $projects = [];
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benim Portfolyom | Full-Stack Geliştirici</title>
    <!-- Modern ve şık bir font olan Inter'i Google Fonts'tan çekiyoruz -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <!-- Devicon for Language Logos -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <!-- Kendi yazdığımız CSS dosyası -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Sadece estetik amaçlı karanlık mod (dark-mode) sınıfı body'e ekliyorum, çünkü 21st.dev genelde koyu temadır -->
    <script>document.body.classList.add('dark-mode');</script>

    <!-- Header (Shadcn style minimalist nav) -->
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">Sezer.</a>
                <ul class="nav-links">
                    <li><a href="#about">Hakkımda</a></li>
                    <li><a href="#projects">Projeler</a></li>
                    <li><a href="#contact">İletişim</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <!-- EXACT Replica of User's Image -->
        <section class="hero-block">
            <div class="container hero-content">

                <!-- 3D Sphere Avatar -->
                <div class="sphere-wrapper animate-in delay-1">
                    <div class="sphere-avatar"></div>
                </div>

                <!-- Title -->
                <h1 class="hero-title animate-in delay-2">
                    Ben Sezer
                </h1>

                <!-- Description -->
                <p class="hero-desc animate-in delay-3">
                    Yazılım Mühendisliği 3. sınıf öğrencisiyim. Neler yaptığıma göz at.
                </p>

                <!-- Buttons -->
                <div class="button-group animate-in delay-4">
                    <a href="#contact" class="shadcn-btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        İletişime Geç
                    </a>
                    <a href="#projects" class="shadcn-btn btn-outline">
                        Projeleri Gör
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 0.5rem;"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                    </a>
                </div>

                <!-- Social Links -->
                <div class="social-icons animate-in delay-5">
                    <a href="#" class="social-icon" aria-label="GitHub">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.02c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                    </a>
                    <a href="#" class="social-icon" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="#" class="social-icon" aria-label="Email">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </a>
                </div>
                
            </div>
        </section>
    </main>

    <!-- Hakkımda Bölümü -->
    <section id="about" class="about-block">
        <div class="container">
            <h2 class="section-title">Hakkımda</h2>
            
            <div class="about-grid">
                <!-- Sol Taraf: Biyografi & Deneyim -->
                <div class="about-info">
                    <p class="about-bio">
                        Haliç Üniversitesi'nde 3. sınıf Yazılım Mühendisliği öğrencisiyim. Ağırlıklı olarak backend geliştirmeye odaklanıyor; Java, Python, C++ ve SQL alanlarındaki yetkinliklerimi sürekli ileriye taşıyorum. Takım çalışmasına yatkın ve her zaman öğrenmeye aç bir yapıya sahibim. Algoritmik temelimi gerçek dünya projelerinde uygulayabileceğim iş fırsatları arıyorum.
                    </p>
                    
                    <div class="about-timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                            </div>
                            <div class="timeline-content">
                                <h4>Haliç Üniversitesi</h4>
                                <span class="timeline-date">2022 - Günümüz | Lisans</span>
                                <p>Yazılım Mühendisliği 3. Sınıf</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>
                            </div>
                            <div class="timeline-content">
                                <h4>Beşiktaş Belediyesi</h4>
                                <span class="timeline-date">Temmuz 2025 - Eylül 2025 | IT Stajyeri</span>
                                <p>İlişkisel veritabanı tasarımı (SQL) ve ağ bağlantısı, donanım optimizasyonları.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sağ Taraf: Yetenekler -->
                <div class="about-skills">
                    <h3 class="skills-title">Yeteneklerim</h3>
                    <div class="skills-wrapper">
                        <span class="skill-badge"><i class="devicon-java-plain"></i> Java</span>
                        <span class="skill-badge"><i class="devicon-python-plain"></i> Python</span>
                        <span class="skill-badge"><i class="devicon-cplusplus-plain"></i> C++</span>
                        <span class="skill-badge"><i class="devicon-csharp-plain"></i> C#</span>
                        <span class="skill-badge"><i class="devicon-mysql-plain"></i> SQL</span>
                        <span class="skill-badge"><i class="devicon-html5-plain"></i> HTML</span>
                        <span class="skill-badge"><i class="devicon-css3-plain"></i> CSS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projeler Bölümü -->
    <section id="projects" class="projects-block">
        <div class="container">
            <h2 class="section-title">Projelerim</h2>
            <div class="projects-grid">
                <?php if(count($projects) > 0): ?>
                    <?php foreach($projects as $project): ?>
                        <div class="project-card">
                            <div class="project-image">
                                <!-- Proje görseli. Eğer veritabanında varsa assets/images/ altından çeker -->
                                <img src="assets/images/<?= htmlspecialchars($project['image_url']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
                            </div>
                            <div class="project-info">
                                <h3><?= htmlspecialchars($project['title']) ?></h3>
                                <p><?= htmlspecialchars($project['description']) ?></p>
                                <a href="<?= htmlspecialchars($project['project_url']) ?>" class="project-github-link" target="_blank" rel="noopener noreferrer" title="GitHub'da Görüntüle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.02c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                                    Kaynak Kodu Göster
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Henüz proje eklenmemiş.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

</body>
</html>
