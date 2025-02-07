<!-- /views/footer.php -->
</div> <!-- Close the content div from the header.php -->

<footer>
    <div class="footer-container">
        <p>&copy; <?php echo date("Y"); ?> Employee Performance Tracker. All Rights Reserved.</p>
        <div class="footer-links">
            <a href="../views/about.php">About Us</a> |
            <a href="../views/contact.php">Contact</a> |
            <a href="../views/privacy.php">Privacy Policy</a>
        </div>
    </div>
</footer>

<!-- Link to the footer CSS -->
<link rel="stylesheet" href="../assets/css/footer.css">

<!-- Optional external JS scripts (e.g., for analytics) -->
<script src="https://www.googletagmanager.com/gtag/js?id=YOUR_ANALYTICS_ID" async></script>
<script>
    // Google Analytics or other analytics script
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'YOUR_ANALYTICS_ID');
</script>
</body>
</html>
