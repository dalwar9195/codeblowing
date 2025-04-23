<div class="page-banner py-5 bg-primary">
    <div class="container">
        <div class="banner-content text-center">
            <h2 class="text-white"><?php the_title(); ?></h2>
            <?php if( is_singular( 'post' ) ) : ?>
                <p class="text-white fw-bold mt-2"><?php echo wp_trim_words( get_the_content(), 10, null ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>