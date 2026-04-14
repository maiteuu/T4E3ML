<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

    <footer>
        <div class="info-sesion" style="margin-left: 12px;">
            <?php if (isset($_SESSION['erabiltzailea'])): ?>
                <p>
                    <strong>Erabiltzailea:</strong> <?php echo htmlspecialchars($_SESSION['erabiltzailea']); ?>
                    (<?php echo htmlspecialchars($_SESSION['rol']); ?>)
                </p>
            <?php endif; ?>

            <?php if (isset($_SESSION['temporada_id'])): ?>
                <p><strong>Denboraldia:</strong> <?php echo htmlspecialchars($_SESSION['temporada_id']); ?></p>
            <?php endif; ?>
        </div>

        <div class="kontaktua">
            <a href="https://www.google.com/maps/place/P.%C2%BA+de+la+Castellana,+151,+4%C2%BAB,+Tetu%C3%A1n,+28046+Madrid/@40.4608003,-3.6930766,663m/data=!3m2!1e3!4b1!4m6!3m5!1s0xd42291b0928b133:0x9b65449e87642aa0!8m2!3d40.4608003!4d-3.6905017!16s%2Fg%2F11lkzhrg_k?entry=ttu&g_ep=EgoyMDI1MTAwNi4wIKXMDSoASAFQAw%3D%3D" target="_blank">P.º de la Castellana, 151, 4ºB</a>
            <p>+34 91 350 25 01</p>
            <a href="mailto:fnfs@fnfs.es">fnfs@fnfs.es</a>
        </div>

        <div class="links">
            <a href="https://www.instagram.com/lnfs89" class="icono instagram" target="_blank"></a>
            <a href="https://www.youtube.com/..." class="icono youtube" target="_blank"></a>
            <a href="https://www.tiktok.com/..." class="icono tiktok" target="_blank"></a>
        </div>
    </footer>
</body>
</html>
