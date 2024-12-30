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

    .signup-container {
        width: 400px;
        background-color: white;
        padding: 30px;
        margin: 40px auto;
    }

    .signup-container h1 {
        font-size: 3rem;
        text-align: center;
    }

    .signup-container form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .signup-container input {
        margin-bottom: 15px;
        padding: 15px 20px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 300;
        font-family: "Lexend", sans-serif;
    }

    .signup-container button {
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

    .signup-container button:hover {
        background-color: #ef436b;
    }

    .signup-container p {
        text-align: center;
        font-weight: 300;
        margin-top: 25px;
    }

    .signup-container p a {
        color: black;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .signup-container p a:hover {
        color: #ef436b;
    }

</style>

<div class="signup-container">
    <h1>Sign Up</h1>

    <?php if (isset($validation)): ?>
        <div style="color: red; text-align: center; margin-bottom: 15px;">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>

    <form action="/signup/process" method="POST">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Create Account</button>
    </form>

    <p>Already have an account? <a href="/login">Sign In</a></p>
</div>