<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/*
 * Custom dashboard widget (Latest properties)
 */
if(! function_exists('epl_get_active_post_types')){
    function ang_admin_widget() { ?>
        <ol>
        <?php
        global $post;
        $args = array('numberposts' => 10,
                       'post_type' => epl_get_active_post_types(), //array('property', 'land', 'commercial', 'business', 'commercial_land', 'rental', 'rural'),
            );
        $myposts = get_posts($args);
        foreach($myposts as $post) :
            setup_postdata($post); ?>
            <li> <span style="  display: inline-block; margin-right: 10px; min-width: 150px;">
                    <?php echo get_the_date('M jS, Y, h:i a'); ?>
                </span> 
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php endforeach; ?>
        </ol>
    <?php
    }
}
function ang_add_recent_posts_widget() {
    wp_add_dashboard_widget('ang_admin_widget', 'Latest properties', 'ang_admin_widget');
}
add_action('wp_dashboard_setup', 'ang_add_recent_posts_widget');
//custom dashboard widget end


//count registred users in "At a Glance" board / start 
function ang_count_users() {
    global $wpdb;
    $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
    echo "<tr><td class='first b'>Registred users: 
    <strong><a href=\"users.php\">{$users}</a></strong></td></tr>";
}
add_action('activity_box_end', 'ang_count_users');
//count registred users in "At a Glance" board / end

//color posts by status / start
function ang_color_posts_list(){
?>
<style>
.status-draft{background: #FCE3F2 !important;}
.status-pending{background: #87C5D6 !important;}
.status-publish{/* published default */}
.status-future{background: #C6EBF5 !important;}
.status-private{background: #F2D46F;}
</style>
<?php
}
add_action('admin_footer', 'ang_color_posts_list');
//color posts by status / end


//change admin column range / start
function ang_column_order($columns) {
  $n_columns = array();
  $move = 'post_thumbnails';   //move row 'post_thumbnails'
  $before = 'date';  //fix before row 'date'
 
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}
add_filter('manage_timeline_posts_columns', 'ang_column_order');
add_filter('manage_slideshow_posts_columns', 'ang_column_order');
//change admin column range / end

//Select number of rows in dashboatd / start
function ang_restore_columns() {
    add_screen_option('layout_columns', array('max' => 4,'default' => 2)); 
}
add_action('admin_head-index.php', 'ang_restore_columns');
//Select number of rows in dashboatd / end

//Type your own text to admin footer / start 
function ang_admin_footer_text () {
   echo '<span id="footer-thankyou" >Thank you for cooperating with <a href="http://torbara.com" target="_blank">Torbara team</a>.</span>';
}
add_filter('admin_footer_text', 'ang_admin_footer_text');
//Type your own text to admin footer end

//Different favicon for admin tabs / start
function ang_admin_favicon() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" 
	      href="http://www.torbara.com/favicon.ico" />';
}
add_action('admin_head', 'ang_admin_favicon');
//Different favicon for admin tabs / end