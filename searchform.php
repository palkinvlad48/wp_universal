<form class="mysearch-form" role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>" >
<input  type="text" placeholder="Поиск" value="<?php echo get_search_query() ?>" name="s" id="s" />
<button  type="submit" id="searchsubmit"></button>  
</form>