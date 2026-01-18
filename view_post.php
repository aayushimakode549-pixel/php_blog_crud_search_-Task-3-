<?php
include 'config.php';

/* ID check */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

/* Post fetch */
$stmt = $conn->prepare(
    "SELECT * FROM posts WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$post = $result->fetch_assoc();

include 'header.php';
?>

<h2><?= htmlspecialchars($post['title']) ?></h2>

<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

<a href="index.php" class="btn btn-secondary mt-3">Back</a>

<?php include 'footer.php'; ?>


