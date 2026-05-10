document.addEventListener('DOMContentLoaded', function() {
    loadProjects();
    initTheme();

    const contactForm = document.getElementById('contactForm');
    
    if(contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = this.querySelector('button[type="submit"]');
            const msgBox = document.getElementById('formMessage');
            
            const originalBtnHtml = btn.innerHTML;
            btn.innerHTML = 'Gönderiliyor...';
            btn.disabled = true;
            
            msgBox.className = 'form-message';
            msgBox.innerHTML = '';

            const formData = {
                name: document.getElementById('name').value.trim(),
                email: document.getElementById('email').value.trim(),
                message: document.getElementById('message').value.trim()
            };

            if (!formData.name || !formData.email || !formData.message) {
                msgBox.innerHTML = 'Lütfen tüm alanları doldurun.';
                msgBox.classList.add('error');
                btn.innerHTML = originalBtnHtml;
                btn.disabled = false;
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(formData.email)) {
                msgBox.innerHTML = 'Geçersiz e-posta adresi.';
                msgBox.classList.add('error');
                btn.innerHTML = originalBtnHtml;
                btn.disabled = false;
                return;
            }

            fetch('backend/process_contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                msgBox.innerHTML = data.message;
                if(data.status === 'success') {
                    msgBox.classList.add('success');
                    this.reset();
                } else {
                    msgBox.classList.add('error');
                }
            })
            .catch(error => {
                msgBox.innerHTML = 'Sunucuyla bağlantı kurulamadı.';
                msgBox.classList.add('error');
            })
            .finally(() => {
                btn.innerHTML = originalBtnHtml;
                btn.disabled = false;
            });
        });
    }
});

function loadProjects() {
    const grid = document.getElementById('projects-grid');
    if(!grid) return;

    fetch('backend/get_projects.php')
        .then(response => response.json())
        .then(projects => {
            grid.innerHTML = '';
            
            if(projects.length === 0) {
                grid.innerHTML = '<p style="color: #a1a1aa; text-align: center; grid-column: 1/-1;">Henüz proje eklenmemiş.</p>';
                return;
            }

            projects.forEach(project => {
                const safeTitle = escapeHTML(project.title);
                const safeDesc = escapeHTML(project.description);
                const safeUrl = escapeHTML(project.project_url);
                const safeImg = escapeHTML(project.image_url);

                const card = `
                    <div class="project-card">
                        <div class="project-image">
                            <img src="assets/images/${safeImg}" alt="${safeTitle}">
                        </div>
                        <div class="project-info">
                            <h3>${safeTitle}</h3>
                            <p>${safeDesc}</p>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        })
        .catch(error => {
            console.error('Projeler yüklenirken hata oluştu:', error);
            grid.innerHTML = '<p style="color: #f87171; text-align: center; grid-column: 1/-1;">Projeler yüklenemedi.</p>';
        });
}

function escapeHTML(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

function initTheme() {
    const themeToggle = document.getElementById('theme-toggle');
    const moonIcon = document.getElementById('moon-icon');
    const sunIcon = document.getElementById('sun-icon');
    const body = document.body;

    const savedTheme = localStorage.getItem('theme') || 'dark-mode';
    body.className = savedTheme;
    updateThemeIcons(savedTheme === 'dark-mode');

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const isDark = body.classList.contains('dark-mode');
            const newTheme = isDark ? 'light-mode' : 'dark-mode';
            
            body.className = newTheme;
            localStorage.setItem('theme', newTheme);
            updateThemeIcons(newTheme === 'dark-mode');
        });
    }

    function updateThemeIcons(isDark) {
        if(moonIcon && sunIcon) {
            moonIcon.style.display = isDark ? 'none' : 'block';
            sunIcon.style.display = isDark ? 'block' : 'none';
        }
    }
}
