<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

<footer class="footer">
    <div class="footer-container">
        <h3>OneBuilding Management</h3>

        <p class="contact">
            Email: info@onebuilding.com | Phone: +880 123-456-789
        </p>

        <div class="social-links">
            <a href="https://facebook.com" target="_blank">🌐 Facebook</a>
            <a href="https://twitter.com" target="_blank">🐦 Twitter</a>
            <a href="https://linkedin.com" target="_blank">💼 LinkedIn</a>
        </div>

        <p class="copyright">
            &copy; <span id="year"></span> OneBuilding. All rights reserved.
        </p>
    </div>
</footer>

<script>
    document.getElementById("year").innerText = new Date().getFullYear();
</script>

</body>
</html>
