<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

if (isset($_GET['delete_msg'])) {
    $stmt = $db->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$_GET['delete_msg']]);
    header("Location: admin.php");
    exit;
}

if (isset($_GET['delete_proj'])) {
    $id = $_GET['delete_proj'];
    $stmt = $db->prepare("SELECT image_url FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    if ($project && $project['image_url'] != 'default.png') {
        $filePath = 'assets/images/' . $project['image_url'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $url = "";
    $imageFileName = 'default.png';
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/images/';
        $fileExtension = pathinfo($_FILES['project_image']['name'], PATHINFO_EXTENSION);
        $newFileName = 'project_' . time() . '_' . uniqid() . '.' . $fileExtension;
        if (move_uploaded_file($_FILES['project_image']['tmp_name'], $uploadDir . $newFileName)) {
            $imageFileName = $newFileName;
        }
    }
    if(!empty($title) && !empty($desc)) {
        $stmt = $db->prepare("INSERT INTO projects (title, description, image_url, project_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $desc, $imageFileName, $url]);
    }
    header("Location: admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_project'])) {
    $id = $_POST['project_id'];
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $url = "";
    $stmt = $db->prepare("SELECT image_url FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $existing = $stmt->fetch();
    $imageFileName = $existing['image_url'] ?? 'default.png';
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/images/';
        $fileExtension = pathinfo($_FILES['project_image']['name'], PATHINFO_EXTENSION);
        $newFileName = 'project_' . time() . '_' . uniqid() . '.' . $fileExtension;
        if (move_uploaded_file($_FILES['project_image']['tmp_name'], $uploadDir . $newFileName)) {
            $imageFileName = $newFileName;
        }
    }
    if(!empty($title) && !empty($desc)) {
        $stmt = $db->prepare("UPDATE projects SET title=?, description=?, image_url=?, project_url=? WHERE id=?");
        $stmt->execute([$title, $desc, $imageFileName, $url, $id]);
    }
    header("Location: admin.php");
    exit;
}

$messages = $db->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
$projects = $db->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
include_once 'includes/admin_header.php';
?>

<div class="admin-section">
    <h3>Yeni Proje Ekle</h3>
    <form method="POST" action="" enctype="multipart/form-data" class="add-form">
        <input type="hidden" name="add_project" value="1">
        <div class="form-group">
            <label>Proje Başlığı</label>
            <input type="text" name="title" required placeholder="Örn: E-Ticaret Sistemi">
        </div>
        <div class="form-group">
            <label>Proje Görseli Yükle</label>
            <input type="file" name="project_image" accept="image/*">
        </div>
        <div class="form-group" style="grid-column: span 2;">
            <label>Proje Açıklaması</label>
            <textarea name="description" rows="3" required placeholder="Projede kullanılan teknolojiler ve detaylar..."></textarea>
        </div>
        <button type="submit" class="btn-add">Projeyi Yayına Al</button>
    </form>
</div>

<div class="admin-section">
    <h3>Yayındaki Projeler <span class="badge"><?= count($projects) ?></span></h3>
    <?php if(count($projects) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">Görsel</th>
                    <th style="width: 25%;">Proje Adı</th>
                    <th style="width: 45%;">Açıklama</th>
                    <th style="width: 10%;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($projects as $proj): ?>
                    <tr>
                        <td><img src="assets/images/<?= htmlspecialchars($proj['image_url']) ?>" style="width: 80px; height: 50px; object-fit: cover; border-radius: 0.5rem; border: 1px solid rgba(255,255,255,0.1);"></td>
                        <td><strong style="color: #fff;"><?= htmlspecialchars($proj['title']) ?></strong></td>
                        <td style="line-height: 1.6;"><?= htmlspecialchars($proj['description']) ?></td>
                        <td>
                            <div class="action-btns">
                                <?php 
                                    $editData = htmlspecialchars(json_encode([
                                        'id' => $proj['id'],
                                        'title' => $proj['title'],
                                        'description' => $proj['description'],
                                        'project_url' => $proj['project_url']
                                    ]), ENT_QUOTES, 'UTF-8'); 
                                ?>
                                <a href="#" class="btn-action edit" onclick="openEditModal('<?= $editData ?>'); return false;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                </a>
                                <a href="#" class="btn-action delete" onclick="openDeleteModal('admin.php?delete_proj=<?= $proj['id'] ?>'); return false;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: #71717a; text-align: center;">Henüz eklenmiş proje yok.</p>
    <?php endif; ?>
</div>

<div class="admin-section">
    <h3>Gelen Mesajlar <span class="badge"><?= count($messages) ?></span></h3>
    <?php if(count($messages) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Tarih</th>
                    <th style="width: 20%;">İsim Soyisim</th>
                    <th style="width: 25%;">E-Posta</th>
                    <th style="width: 30%;">Mesaj</th>
                    <th style="width: 10%;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($messages as $msg): ?>
                    <tr>
                        <td><?= date('d.m.Y H:i', strtotime($msg['created_at'])) ?></td>
                        <td><strong style="color: #fff;"><?= htmlspecialchars($msg['name']) ?></strong></td>
                        <td><a href="mailto:<?= htmlspecialchars($msg['email']) ?>" style="color: #60a5fa; text-decoration: none;"><?= htmlspecialchars($msg['email']) ?></a></td>
                        <td style="line-height: 1.6;"><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                        <td>
                            <div class="action-btns">
                                <?php 
                                    $jsData = htmlspecialchars(json_encode([
                                        'name' => $msg['name'],
                                        'email' => $msg['email'],
                                        'message' => $msg['message']
                                    ]), ENT_QUOTES, 'UTF-8'); 
                                ?>
                                <a href="#" class="btn-action view" onclick="openModalFromJSON('<?= $jsData ?>'); return false;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                                <a href="#" class="btn-action delete" onclick="openDeleteModal('admin.php?delete_msg=<?= $msg['id'] ?>'); return false;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: #71717a; text-align: center;">Henüz mesaj almadınız.</p>
    <?php endif; ?>
</div>

<?php 
include_once 'includes/admin_modals.php';
include_once 'includes/admin_footer.php'; 
?>
