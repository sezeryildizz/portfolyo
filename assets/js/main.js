document.addEventListener('DOMContentLoaded', function() {
    loadProjects();

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
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value
            };

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
