function openModalFromJSON(jsonData) {
    const data = JSON.parse(jsonData);
    document.getElementById('modalName').textContent = data.name;
    document.getElementById('modalEmail').textContent = data.email;
    document.getElementById('modalEmailLink').href = 'mailto:' + data.email;
    document.getElementById('modalText').textContent = data.message;
    openModal('messageModal');
}

function openEditModal(jsonData) {
    const data = JSON.parse(jsonData);
    document.getElementById('editProjectId').value = data.id;
    document.getElementById('editProjectTitle').value = data.title;
    document.getElementById('editProjectDesc').value = data.description;
    openModal('editModal');
}

function openDeleteModal(deleteUrl) {
    document.getElementById('confirmDeleteBtn').href = deleteUrl;
    openModal('deleteModal');
}

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if(modal) {
        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('active'), 10);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if(modal) {
        modal.classList.remove('active');
        setTimeout(() => modal.style.display = 'none', 300);
    }
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.classList.remove('active');
        setTimeout(() => event.target.style.display = 'none', 300);
    }
}
