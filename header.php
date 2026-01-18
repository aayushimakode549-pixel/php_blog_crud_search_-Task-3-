<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>My Blog</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.highlight{
    background:#ffc107;
    padding:2px 4px;
    border-radius:4px;
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="index.php">My Blog</a>

<div class="collapse navbar-collapse">
<ul class="navbar-nav me-auto">
<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
</ul>

<form class="d-flex" method="get" action="index.php">
<input class="form-control form-control-sm me-2" name="search" placeholder="Search">
<button class="btn btn-outline-light btn-sm">Search</button>
</form>

<?php if(isset($_SESSION['user'])): ?>
<a href="create_post.php" class="btn btn-success btn-sm ms-2">+Post</a>
<a href="logout.php" class="btn btn-danger btn-sm ms-2">Logout</a>
<?php else: ?>
<a href="login.php" class="btn btn-primary btn-sm ms-2">Login</a>
<a href="register.php" class="btn btn-warning btn-sm ms-2">Register</a>
<?php endif; ?>
</div>
</div>
</nav>

<div class="container mt-4">
