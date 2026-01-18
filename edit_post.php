<?php
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $_SESSION['user']['id']);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$post = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    $_SESSION['success'] = "Post updated!";
    header("Location: index.php");
    exit;
}

include 'header.php';
?>

<h3>Edit Post</h3>

<form method="post">
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" class="form-control mb-2" required>
    <textarea name="content" class="form-control mb-2" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea>
    <button class="btn btn-success">Update</button>
</form>

<?php include 'footer.php'; ?>









