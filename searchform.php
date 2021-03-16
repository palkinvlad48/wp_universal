<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>" >
<input class="form-input" type="text" placeholder="Поиск" value="<?php echo get_search_query() ?>" name="s" id="s" />
<button class="form-button" type="submit" id="searchsubmit">
  <svg fill="#BCBFC2" width="22" height="22" class="icon">
    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#search">
    </use>
  </svg>
</button>  
</form>