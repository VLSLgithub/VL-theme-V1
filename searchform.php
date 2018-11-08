<?php
/**
 * The template for displaying search form
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */
 ?>

<form role="search" method="get" class="search-form" action="<?php bloginfo( 'url' ); ?>">
    <label class="search-field-label" for="site-search-field">
        <?php _e( 'Type and press "Enter" to search:', 'vibrant-life-theme' ); ?>
    </label>

    <div class="search-submitting" style="display: none;">
        <?php _e( 'Searching...', 'vibrant-life-theme' ); ?> <span class="fas fa-spin fa-circle-notch" aria-hidden="true"></span>
    </div>

    <input type="search" class="search-field" value="<?php the_search_query(); ?>" name="s" id="site-search-field"
           title="<?php _e( 'Search for:', 'vibrant-life-theme' ); ?>">
</form>