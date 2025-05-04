<?php 
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }
?>
   <footer>
        <div class="footer-wrapper bg-dark py-5">
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar('footer-sidebar'); ?>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <div class="scroll-top">
        <a href="#"><i class="fa-solid fa-chevron-up"></i></a>
    </div>
    <?php wp_footer(); ?>
</body>
</html>