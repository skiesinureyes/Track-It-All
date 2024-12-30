<style>
    /* CSS */
    @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');

    .lexend-<uniquifier> {
    font-family: "Lexend", serif;
    font-optical-sizing: auto;
    font-weight: <weight>;
    font-style: normal;
    }

    body {
        font-family: "Lexend", sans-serif;
        font-style: bold;
        font-weight: 100;
        margin: 0;
        padding: 0;
        background: white;
    }

    .login-container {
        width: 400px;
        background-color: white;
        padding: 30px;
        margin: 100px auto;
    }

    .login-container h1 {
        font-size: 3rem;
        text-align: center;
    }

    .login-container form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .login-container input {
        margin-bottom: 15px;
        padding: 15px 20px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 300;
        font-family: "Lexend", sans-serif;
    }

    .login-container button {
        display: inline-block;
        padding: 10px 30px;
        margin-top: 10px;
        background-color: black;
        color: white;
        font-size: 1.1rem;
        text-decoration: none;
        border-radius: 25px;
        transition: background-color 0.3s;
        font-weight: 500;
        font-family: "Lexend", sans-serif;
        border: none;
    }

    .login-container button:hover {
        background-color: #ef436b;
    }

    .login-container p {
        text-align: center;
        font-weight: 300;
        margin-top: 25px;
    }

    .login-container p a {
        color: black;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .login-container p a:hover {
        color: #ef436b;
    }

</style>

<div class="login-container">
    <h1>Log In</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form action="/login/process" method="POST">
        <?= csrf_field() ?>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Log In</button>
    </form>
    
    <p>Don't have an account? <a href="/signup">Sign Up</a></p>
</div>