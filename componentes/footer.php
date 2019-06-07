</main>
<footer class="footer mt-auto py-3 text-center bg-dark">
    <div class="container">
        <span class="text-white">Desenvolvido por <a class="github" href="https://github.com/alanbernardino" target="_blank">Alan Bernadino</a>, <a class="github" href="https://github.com/joseoliveira89" target="_blank">José Clebson</a>, <a class="github" href="https://github.com/luizhcarminati" target="_blank">Luiz Henrique</a>, <a class="github" href="https://github.com/mauricifj" target="_blank">Maurici</a> e <a class="github" href="https://github.com/Thiagogiannaccini" target="_blank">Thiago</a></span>
    </div>
</footer>
<script>
    $(document).ready(() => {
        if (this.location.pathname.includes('home')) {
            $('a[href*="/"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('livros')) {
            $('a[href*="/livros"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('editoras')) {
            $('a[href*="/editora"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('autores')) {
            $('a[href*="/autores"]').parent().addClass('active');
        }
        if (this.location.pathname.includes('usuarios')) {
            $('a[href*="/usuarios"]').parent().addClass('active');
        }
        // $('a[href*="' + this.location.pathname + '"]').parent().addClass('active');
    });
</script>
</body>
</html>