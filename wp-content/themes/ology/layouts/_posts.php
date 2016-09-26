<?php
/**
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// init vars

$colcount = $this['config']->get('multicolumns', 1);
$posts_fp = $this['config']->get('posts_on_frontpage');
$count    = $this['system']->getPostCount();
$rows     = ceil($count / $colcount);
$columns  = array();
$row      = 0;
$column   = 0;
$i        = 0;

if (is_front_page() && ($posts_fp && $posts_fp !== 'default')) {
    query_posts( 'posts_per_page='.$posts_fp );
}

while (have_posts()) {
    the_post();

    if ($this['config']->get('multicolumns_order', 1) == 0) {
        // order down
        if ($row >= $rows) {
            $column++;
            $row  = 0;
            $rows = ceil(($count - $i) / ($colcount - $column));
        }
        $row++;
    } else {
        // order across
        $column = $i % $colcount;
    }

    if (!isset($columns[$column])) {
        $columns[$column] = '';
    }

    $columns[$column] .= $this->render('_post');
    $i++;
}



//get grid parallax
if($this['config']->get('grid_parallax') !=''){
    $grid_parallax_val = esc_html($this['config']->get('grid_parallax'));
    $grid_parallax = 'data-uk-grid-parallax = "{translate:'.$grid_parallax_val.'}"';
}else{
    $grid_parallax = '';
}

//get grid top gutter odd columns
if($this['config']->get('top_gutter_odd') !=''){
    $grid_gutter_odd_val = esc_html($this['config']->get('top_gutter_odd'));
    $grid_gutter_odd = 'style = "margin-top:'.$grid_gutter_odd_val.'"';
}else{
    $grid_gutter_odd = '';
}
//get grid top gutter even columns
if($this['config']->get('top_gutter_even') !=''){
    $grid_gutter_even_val = esc_html($this['config']->get('top_gutter_even'));
    $grid_gutter_even = 'style = "margin-top:'.$grid_gutter_even_val.'"';
}else{
    $grid_gutter_even = '';
}

// render columns
if ($count = count($columns)) {
    print '<div class="uk-grid ang-posts-archive" data-uk-grid-match data-uk-grid-margin '.$grid_parallax.'>';
    for ($i = 0; $i < $count; $i++) {
        if($i % 2 == 0){
            print '<div class="uk-width-medium-1-'.$count.'"'.$grid_gutter_odd.'>'.$columns[$i].'</div>';
        }else{
            print '<div class="uk-width-medium-1-'.$count.'"'.$grid_gutter_even.'>'.$columns[$i].'</div>';
        }
    }
    print '</div>';
}