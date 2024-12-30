<style>
    html, body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 15px 0px;
        position: fixed;
        top: 0; /* Aligns it to the top of the page */
        left: 0; /* Ensures it starts from the left edge */
        width: 100%; /* Makes the navbar span the full width of the page */
        z-index: 1000;
    }

    .navbar a {
        color: black;
        text-decoration: none;
        padding: 0px 20px;
        font-weight: 300;
    }

    .navbar a:hover {
        color: #ef436b;
        transition: color 0.3s;
    }

    .navbar .logo {
        font-weight: 850;
        font-size: 1.5rem;
        margin-left: 15px;
    }

    .navbar .menu {
        display: flex;
    }

    .navbar .menu-2 {
        display: flex;
        gap: 10px;
        margin-right: 15px;
    }

    .navbar .menu-2 a, span {
        color: white;
        text-decoration: none;
        padding: 7px 17px;
        font-weight: 300;
        background-color: black;
        border-radius: 20px;
    }

    .navbar .menu-2 .sign-in-navbar {
        color: black;
        text-decoration: none;
        background-color: white;
        border-radius: 20px;
        border: 2px solid black;
    }

    .navbar .menu-2 a, span {
        font-weight: 300;
    }

    .navbar .menu-2 span:hover {
        background-color: #ef436b;
        transition: background 0.3s;
    }

    .navbar .menu-2 .sign-in-navbar:hover {
        color: #ef436b;
        border: 2px solid #ef436b;
        transition: color 0.3s, border 0.3s;
    }

    .navbar .menu-2 .sign-up-navbar:hover {
        background-color: #ef436b;
        transition: background 0.3s;
    }

</style>

<body>
    <div class="navbar">
        <a href="/" class="logo">
            TrackItAll
        </a>
        
        <?php if (isset($logged_in) && $logged_in): ?>
        <div class="menu">
            <a href="/expenses">Expense Tracker</a>
        </div>
        <div class="menu-2">
            <span>Hi, <?= htmlspecialchars($full_name ?? 'User') ?> ♡ </span>
            <a href="/logout" class="sign-in-navbar">Log Out</a>
        </div>
        
        <?php else: ?>
        <div class="menu-2">
            <a href="/login" class="sign-in-navbar">Log In</a>
            <a href="/signup" class="sign-up-navbar">Sign Up</a>
        </div>

        <?php endif; ?>
        
    </div>
</body>