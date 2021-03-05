<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>" >
<input class="form-input" type="text" placeholder="Поиск" value="<?php echo get_search_query() ?>" name="s" id="s" />
<button class="form-button" type="submit" id="searchsubmit"></button>  
</form>