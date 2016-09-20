<?php
/*
 * Ordinary WP pagination
 */
if (!function_exists('ang_ordinary_wp_pagination')) {
    function ang_ordinary_wp_pagination($wp_query) {
            //global $wp_query;
            $pages = '';
            $max = $wp_query->max_num_pages;
            if (!$current = get_query_var('paged')) $current = 1;
            $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
            $a['total'] = $max;
            $a['current'] = $current;

            $total = 1; //1 - выводить текст "Страница N из N", 0 - не выводить
            $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
            $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
            $a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
            $a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"

            if ($max > 1) echo '<div class="navigation">';
            if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
            echo $pages . paginate_links($a);
            if ($max > 1) echo '</div>';
    }

    add_action('ordinary_pagination','ang_ordinary_wp_pagination', 1);
}