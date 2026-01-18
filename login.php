<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username !== '' && $password !== '') {

        $stmt = $conn->prepare(
            "SELECT * FROM users WHERE username = ?"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['username']
                ];

                $_SESSION['success'] = "Login successful!";
                header("Location: index.php");
                exit;

            } else {
                $_SESSION['error'] = "Invalid password!";
            }

        } else {
            $_SESSION['error'] = "User not found!";
        }

    } else {
        $_SESSION['error'] = "All fields are required!";
    }
}

include 'header.php';
?>

<h3>Login</h3>

<form method="post">

    <input type="text"
           name="username"
           class="form-control mb-2"
           placeholder="Username"
           required>

    <input type="password"
           name="password"
           class="form-control mb-2"
           placeholder="Password"
           required>

    <button class="btn btn-success">Login</button>

</form>

<?php include 'footer.php'; ?>




