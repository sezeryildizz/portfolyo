    <div id="messageModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Gelen Mesaj</h3>
                <button class="modal-close" onclick="closeModal('messageModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-field">
                    <span class="modal-label">Gönderen:</span>
                    <strong id="modalName" class="modal-value"></strong>
                </div>
                <div class="modal-field">
                    <span class="modal-label">E-Posta:</span>
                    <a href="#" id="modalEmailLink" style="color:#60a5fa; text-decoration:none;">
                        <span id="modalEmail" class="modal-value" style="color:#60a5fa;"></span>
                    </a>
                </div>
                <div class="modal-divider"></div>
                <div class="modal-field">
                    <span class="modal-label" style="display:block; margin-bottom:0.5rem;">Mesaj İçeriği:</span>
                    <div id="modalText" class="modal-message-box"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Projeyi Düzenle</h3>
                <button class="modal-close" onclick="closeModal('editModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data" class="add-form" style="margin-bottom: 0;">
                    <input type="hidden" name="edit_project" value="1">
                    <input type="hidden" name="project_id" id="editProjectId">
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Proje Başlığı</label>
                        <input type="text" name="title" id="editProjectTitle" required>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Yeni Görsel Seç (İsteğe Bağlı)</label>
                        <input type="file" name="project_image" accept="image/*">
                        <small style="color:#71717a; display:block; margin-top:0.5rem;">Dosya seçmezseniz mevcut proje görseli korunur.</small>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Proje Açıklaması</label>
                        <textarea name="description" id="editProjectDesc" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn-add">Değişiklikleri Kaydet</button>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 400px; text-align: center;">
            <div class="modal-body" style="padding: 2.5rem 1.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#f87171" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1rem;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <h3 style="color: #fff; margin-bottom: 0.5rem; font-size: 1.25rem;">Emin misiniz?</h3>
                <p style="color: #a1a1aa; margin-bottom: 2rem; font-size: 0.95rem; line-height: 1.5;">Bu işlemi onaylarsanız veri kalıcı olarak silinecektir. Geri alamazsınız.</p>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button type="button" onclick="closeModal('deleteModal')" class="btn-cancel">İptal Et</button>
                    <a href="#" id="confirmDeleteBtn" class="btn-confirm-del">Evet, Sil</a>
                </div>
            </div>
        </div>
    </div>
