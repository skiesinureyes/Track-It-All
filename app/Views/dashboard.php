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

    .header {
        text-align: center;
        padding: 150px 20px;
    }

    .header h1 {
        font-size: 3rem;
    }

    .header p {
        font-size: 1.5rem;
        font-weight: 300;
    }

    .cta-button {
        display: inline-block;
        margin-top: 20px;
        padding: 15px 30px;
        background-color: black;
        color: white;
        font-size: 1.1rem;
        text-decoration: none;
        border-radius: 25px;
        transition: background-color 0.3s;
        font-weight: 500;
    }

    .cta-button:hover {
        background-color: #ef436b;
    }

    .features-title {
        text-align: center;
    }

    .features-title h1 {
        font-size: 2.5rem;
    }

    .features {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        padding: 50px;
    }
    
    .feature {
        flex: 1 1 300px;
        margin: 10px;
        padding: 30px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .feature h3 {
        margin-bottom: 10px;
        font-size: 1.5rem;
    }

    .feature p {
        color: black;
        font-weight: 300;
    }
</style>

<body>
<div class="header">
    <h1>Simplify Your Day, Track It All Your Way.</h1>
    <p>An all-in-one task and expense tracker</p>
    <a href="/signup" class="cta-button">Get Started</a>
</div>