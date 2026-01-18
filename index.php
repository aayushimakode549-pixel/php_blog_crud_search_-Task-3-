<?php
include 'header.php';

/* ---------- FUNCTIONS ---------- */
function highlight($text, $search){
    if($search == '') return htmlspecialchars($text);
    return preg_replace(
        '/(' . preg_quote($search, '/') . ')/i',
        '<span class="highlight">$1</span>',
        htmlspecialchars($text)
    );
}

function timeAgo($time){
    $diff = time() - strtotime($time);
    if($diff < 60) return "Just now";
    if($diff < 3600) return floor($diff/60)." minutes ago";
    if($diff < 86400) return floor($diff/3600)." hours ago";
    return floor($diff/86400)." days ago";
}

/* ---------- SEARCH & PAGINATION ---------- */
$search = $_GET['search'] ?? '';
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit  = 5;
$offset = ($page - 1) * $limit;

/* WHERE condition */
$where = "";
if($search !== ''){
    $safe = $conn->real_escape_string($search);
    $where = "WHERE title LIKE '%$safe%' OR content LIKE '%$safe%'";
}

/* TOTAL POSTS */
$countRes = $conn->query("SELECT COUNT(*) AS total FROM posts $where");
$total = $countRes->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);

/* FETCH POSTS (🔥 $res IS DEFINED HERE) */
$res = $conn->query("
    SELECT * FROM posts
    $where
    ORDER BY id DESC
    LIMIT $limit OFFSET $offset
");
?>

<!-- SEARCH INFO -->
<?php if($search !== ''): ?>
<div class="alert alert-info">
    Showing results for <b><?= htmlspecialchars($search) ?></b>
    <a href="index.php" class="btn btn-sm btn-light ms-2">Clear</a>
</div>
<?php endif; ?>

<!-- POSTS -->
<?php if($res && $res->num_rows > 0): ?>
    <?php while($row = $res->fetch_assoc()): ?>
        <div class="card mb-3">
            <div class="card-body">

                <h4><?= highlight($row['title'], $search) ?></h4>

                <p><?= nl2br(highlight($row['content'], $search)) ?></p>

                <p class="text-muted">
                    Views: <?= isset($row['views']) ? $row['views'] : 0 ?> |
                    Posted <?= timeAgo($row['created_at']) ?>
                </p>

                <a href="view_post.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">
                    Read More
                </a>

                <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $row['user_id']): ?>
                    <a href="edit_post.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="delete_post.php?id=<?= $row['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this post?')">
                       Delete
                    </a>
                <?php endif; ?>

            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="alert alert-warning">No Post Found</div>
<?php endif; ?>

<!-- PAGINATION -->
<div class="mt-3">
<?php for($i = 1; $i <= $total_pages; $i++): ?>
    <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"
       class="btn btn-sm <?= ($i == $page) ? 'btn-dark' : 'btn-outline-dark' ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>
</div>

<?php include 'footer.php'; ?>



