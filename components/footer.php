<footer class="site-footer">
    <div class="container">
        <p class="copyright">© Не_Рви, 2020</p>
        <ul class="navigation-list">
            <li><a href="catalog.php">Каталог</a></li>
            <li><a href="services.php">Послуги</a></li>
            <li><a href="contacts.php">Контакти</a></li>
        </ul>
        <ul class="social-list">
            <li>
                <a class="social-link-instagram" href="https://instagram.com">
                    <span class="visually-hidden">Інстаграм</span>
                </a>
            </li>
            <li>
                <a class="social-link-facebook" href="https://facebook.com">
                    <span class="visually-hidden">Фейсбук</span>
                </a>
            </li>
        </ul>
    </div>
    <script>
        var footer = document.getElementsByTagName('footer');
		html = document.documentElement;
        html.style.margin = "0 0 " + footer[0].clientHeight + "px 0";
        console.log(footer[0].clientHeight);
		console.log(html.style.margin);
    </script>
</footer>
