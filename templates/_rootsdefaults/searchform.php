<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'cobalt'); ?></label>
  <div class="input-group">
    <input type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'cobalt'); ?> <?php bloginfo('name'); ?>" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'cobalt'); ?></button>
    </span>
  </div>
</form>
