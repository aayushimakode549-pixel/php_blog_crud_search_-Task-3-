<?php
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $content, $_SESSION['user']['id']);
        $stmt->execute();

        $_SESSION['success'] = "Post created successfully!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = "All fields required!";
    }
}

include 'header.php';
?>

<h3>Create New Post</h3>

<form method="post">
    <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
    <textarea name="content" class="form-control mb-2" rows="5" placeholder="Content" required></textarea>
    <button class="btn btn-primary">Publish</button>
</form>

<?php include 'footer.php'; ?>