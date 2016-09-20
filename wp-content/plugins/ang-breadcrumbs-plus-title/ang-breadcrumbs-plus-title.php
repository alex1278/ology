<?php
/*
  Plugin Name:  ANG Breadcrumbs & Title
  Plugin URI:   http://themeforest.net/user/torbara/?ref=torbara
  Description:  Display your site breadcrumb navigation with page title.
  Author:       Aleksandr Glovatskyy
  Version:      1.1.5
  Last Update:  24.03.2016
  Author URI:   http://themeforest.net/user/torbara/portfolio/?ref=torbara
 */

class ANG_Breadcrumbs_And_Title extends \WP_Widget
{
/*
 * Register widget with WordPress. 
 */
    public function __construct()
    {
        $widget_ops = array('description' => 'Display your sites breadcrumb navigation with page title');
        parent::__construct(false, __('ANG Breadcrumbs & Title', 'ang-plugins'), $widget_ops);
    }

    public function widget($args, $instance)
    {   
        wp_reset_postdata(); //reset WP-Query data if nore then one Wp_query affects on page.
        global $wp_query;
        $output_page_title = "";
        extract($args);

        $title = $instance['title'];
        $home_title = trim($instance['home_title']);
        $title_no = $instance['title_no'];
        $bread_position = $instance['bread_position'];
        
        if (empty($home_title)) {
            $home_title = 'Home';
            $output_page_title = "";
        }

        echo $before_widget;

        if ($title) { 
            echo $before_title . $title . $after_title;
            }
            
        if (!is_home() && !is_front_page()) {

            $output = '<ul class="uk-breadcrumb">';
            $output_title ="";
            $output_page_title = "";

            $output .= '<li><a href="'.get_option('home').'">'.$home_title.'</a></li>';
//            $output .= '<li><a href="'.esc_url( home_url( '/' ) ).'">'.$home_title.'</a></li>';

            if (is_single()) {
                if ($cats = get_the_category()) {
                    $cat = $cats[0];

                    if (is_object($cat)) {
                        if ($cat->parent != 0) {
                            $cats = explode("@@@", get_category_parents($cat->term_id, true, "@@@"));

                            unset($cats[count($cats)-1]);
                            $output .= str_replace('<li>@@','<li>', '<li>'.implode("</li><li>", $cats).'</li>');
                        } else {
                            $output .= '<li><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></li>';
                        }
                    }
                }
            }

            if (is_category()) {

                $cat_obj = $wp_query->get_queried_object();

                $cats = explode("@@@", get_category_parents($cat_obj->term_id, TRUE, '@@@'));

                unset($cats[count($cats)-1]);

                $cats[count($cats)-1] = '@@<span>'.strip_tags($cats[count($cats)-1]).'</span>';
                
                $output_page_title = '<h1>'.single_cat_title('',false).'</h1>';
                $output_title = '<h2>'.single_cat_title('',false).'</h2>';
                
                $output .= str_replace('<li>@@','<li class="uk-active">', '<li>'.implode("</li><li>", $cats).'</li>');
            } elseif (is_tag()) {
                
                $output_page_title = '<h1>'.single_cat_title('',false).'</h1>';
                $output_title = '<h2>'.single_cat_title('',false).'</h2>';
                
                $output .= '<li class="uk-active"><span>'.single_cat_title('',false).'</span></li>';
            } elseif (is_date()) {
                
                $output_page_title = '<h1>'.single_month_title(' ',false).'</h1>';
                $output_title = '<h2>'.single_month_title(' ',false).'</h2>';
                
                $output .= '<li class="uk-active"><span>'.single_month_title(' ',false).'</span></li>';
            } elseif (is_author()) {

                //$user = !empty($wp_query->query_vars['author_name']) ? get_user_by('login', $wp_query->query_vars['author_name']) : get_user_by("id", ((int) $_GET['author']));
                if(isset($_GET['author_name'])) {
                    $user = get_user_by('login', $wp_query->query_vars['author_name']);
                } elseif(isset($_GET['author'])) {
                    $user = get_user_by("id", ((int) $_GET['author']));
                } else {
                    $user = get_user_by('ID', get_the_author_meta('ID'));
                }
                
                $output_page_title = '<h1>'.$user->display_name.'</h1>';
                $output_title = '<h2>'.$user->display_name.'</h2>';
                $output .= '<li class="uk-active"><span>'.$user->display_name.'</span></li>';
            } elseif (is_search()) {
                
                $output_page_title = '<h1>'.stripslashes(strip_tags(get_search_query())).'</h1>';
                $output_title = '<h2>'.stripslashes(strip_tags(get_search_query())).'</h2>';
                
                $output .= '<li class="uk-active"><span>'.stripslashes(strip_tags(get_search_query())).'</span></li>';
            } elseif (is_tax()) {
                
                $taxonomy = get_taxonomy (get_query_var('taxonomy'));
                $term = get_query_var('term');
                
                $output_page_title = '<h1>'.$taxonomy->label .': '.$term.'</h1>';
                $output_title = '<h2>'.$taxonomy->label .': '.$term.'</h2>';
                
                $output .= '<li class="uk-active"><span>'.$taxonomy->label .': '.$term.'</span></li>';
            } elseif (is_archive()) {
                
                
                
                
                //custom post type archive
                if(is_post_type_archive()){
                    // woocommerce shop page
                if (is_plugin_active("woocommerce/woocommerce.php") && is_shop()) {
                    $title = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    $output_page_title = '<h1>'.$title.'</h1>';
                    $output_title = '<h1>'.$title.'</h1>';
                    
                    $output .= '<li class="uk-active"><span>'.$title.'</span></li>';
                }else{
                    $post_type = get_post_type_object( get_post_type() );
                    $output .= '<li class="uk-active"><span>'.$post_type->label.'</span></li>';
                        $output_page_title = '<h1>'.$post_type->label.'</h1>';
                        $output_title = '<h2>'.$post_type->label.'</h2>';
                    }
                }
                
                // easy property listing post types
            }elseif (is_singular(array('property', 'land', 'rental', 'commercial', 'business', 'commercial_land', 'rural')) ){
                if (is_plugin_active("easy-property-listings/easy-property-listings.php")) {
                    $output .= '<li><a href="'.get_post_type_archive_link( get_post_type() ).'">'.get_post_type().'</a></li>';
                    //$output .= '<li class="uk-active">'.get_post_type().'</li>';

                    $title = ang_get_property_heading();
                    
                    $output_page_title = '<h1>'.$title.'</h1>';
                    $output_title = '<h2>'.$title.'</h2>';

                    $output .= '<li class="uk-active"><span>'.$title.'</span></li>';
                }
            }else {
                
                $ancestors = get_ancestors(get_the_ID(), 'page');
                for($i = count($ancestors)-1; $i >= 0; $i--) {                    
                    $output .= '<li><a href="'.get_page_link($ancestors[$i]).'" title="'.get_the_title($ancestors[$i]).'">'.get_the_title($ancestors[$i]).'</a></li>';
                }
               
                $output_page_title = '<h1>'.get_the_title().'</h1>';
                $output_title = '<h1>'.get_the_title().'</h1>';
                
                $output .= '<li class="uk-active"><span>'.get_the_title().'</span></li>';
            }

            $output .= '</ul>';
        } else {
//            $output_page_title = '<h1>'.$home_title.'</h1>';
            
            $output = '<ul class="uk-breadcrumb">';
            $output .= '<li class="uk-active"><span>'.$home_title.'</span></li>';

            $output .= '</ul>';
            
        }
        
//        echo $output;
        
           if($instance['title_no']=="1") {
               switch ($instance['bread_position']) {
                    case 1:
                        echo '<div class="uk-grid uk-grid-small ang-title-crumbs" data-uk-grid-margin><div class="uk-width-medium-1-1"><div class="ang-breadcrumbs-output '.$instance[ 'ex_class' ].'">'.$output.'</div></div><div class="uk-width-medium-1-1">'.$output_page_title.'</div></div>';    
                        break;
                    case 2:
                        echo '<div class="uk-grid uk-grid-small ang-title-crumbs" data-uk-grid-margin><div class="uk-width-medium-1-1">'.$output_page_title.'</div><div class="uk-width-medium-1-1"><div class="ang-breadcrumbs-output '.$instance[ 'ex_class' ].'">'.$output.'</div></div></div>';    
                        break;
                    case 3:
                        echo '<div class="uk-grid uk-grid-small ang-title-crumbs" data-uk-grid-margin><div class="uk-width-medium-1-2"><div class="ang-breadcrumbs-output '.$instance[ 'ex_class' ].'">'.$output.'</div></div><div class="uk-width-medium-1-2">'.$output_page_title.'</div></div>';    
                        break;
                    case 4:
                        echo '<div class="uk-grid uk-grid-small ang-title-crumbs" data-uk-grid-margin><div class="uk-width-medium-1-2">'.$output_page_title.'</div><div class="uk-width-medium-1-2"><div class="uk-float-right ang-breadcrumbs-output '.$instance[ 'ex_class' ].'">'.$output.'</div></div></div>';    
                        break;
                    default:
                        echo '<div class="uk-grid uk-grid-small ang-title-crumbs" data-uk-grid-margin><div class="uk-width-medium-1-2">'.$output_page_title.'</div><div class="uk-width-medium-1-2"><div class="uk-float-right ang-breadcrumbs-output '.$instance[ 'ex_class' ].'">'.$output.'</div></div></div>';    
                        break;
               }
        } else {
            echo '<div class="ang-breadcrumbs-output '.$instance[ 'ex_class' ].'">'.$output.'</div>';
        }

    wp_reset_query(); 

         echo $after_widget;
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] 	= $new_instance['title'];
        $instance['home_title'] = $new_instance['home_title'];
        $instance['ex_class'] = $new_instance['ex_class'];
        $instance['title_no'] 	= $new_instance['title_no'];
        $instance['bread_position'] 	= $new_instance['bread_position'];
        
        return $new_instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : 'Breadcrumbs';
        $home_title = isset($instance['home_title']) ? esc_attr($instance['home_title']) :'Home';
        ?>

        <!--enter widget title-->
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title:', 'ang-plugins');?></label>
            <input type="text" name="<?php echo $this->get_field_name('title') ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title') ?>">
        </p>
        
        <!--enter home page title-->
        <p>
            <label for="<?php echo $this->get_field_id('home_title') ?>"><?php esc_html_e('Home title:', 'ang-plugins');?></label>
            <input type="text" placeholder="Home" name="<?php echo $this->get_field_name('home_title') ?>"  value="<?php echo $home_title ?>" class="widefat" id="<?php echo $this->get_field_id('home_title') ?>">
        </p>
        
        <?php $ex_class = isset( $instance[ 'ex_class' ] ) ? $instance[ 'ex_class' ] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('ex_class'); ?>">
                <?php esc_html_e( 'Extra class:', 'ang-plugins'); ?> 
                <input class="widefat" 
                        id="<?php echo $this->get_field_id('ex_class'); ?>" 
                        name="<?php echo $this->get_field_name('ex_class'); ?>" 
                        type="text" 
                        value="<?php echo $ex_class; ?>" />
            </label>
        </p>
        
    <!--checkbox disable page title-->
    
        <?php $title_no = isset( $instance['title_no'] ) ? $instance['title_no'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title_no' )); ?>">
                <?php esc_html_e('Disable page title:', 'ang-plugins');?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('title_no')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('title_no')); ?>" value="1" <?php if($title_no=="1"){ echo "checked"; }?>><?php _e( 'No' ); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('title_no')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('title_no')); ?>" value="2" <?php if($title_no=="2"){ echo "checked"; }?>><?php _e( 'Yes' ); ?> 
        </p>
        
        <!--checkbox select breadcrumbs position-->
        <?php $bread_position = isset( $instance['bread_position'] ) ? $instance['bread_position'] : "1"; ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'bread_position' )); ?>">
                <?php esc_html_e('Breadcrumbs position:', 'ang-plugins');?>
            </label> 
            <br>
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('bread_position')."_1"); ?>" name="<?php echo esc_attr($this->get_field_name('bread_position')); ?>" value="1" <?php if($bread_position=="1"){ echo "checked"; }?>><?php _e( 'Top' ); ?> &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('bread_position')."_2"); ?>" name="<?php echo esc_attr($this->get_field_name('bread_position')); ?>" value="2" <?php if($bread_position=="2"){ echo "checked"; }?>><?php _e( 'Bottom' ); ?> &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('bread_position')."_3"); ?>" name="<?php echo esc_attr($this->get_field_name('bread_position')); ?>" value="3" <?php if($bread_position=="3"){ echo "checked"; }?>><?php _e( 'Left' ); ?> &nbsp;&nbsp;
            <input type="radio" id="<?php echo esc_attr($this->get_field_id('bread_position')."_4"); ?>" name="<?php echo esc_attr($this->get_field_name('bread_position')); ?>" value="4" <?php if($bread_position=="4"){ echo "checked"; }?>><?php _e( 'Right' ); ?>
        </p>
        
        <?php
    }
}

add_action('widgets_init', create_function('', 'return register_widget("ANG_Breadcrumbs_And_Title");'));

//unregister default Warp Breadcrumbs
function ang_deregister_widget() {
    unregister_widget( 'Warp_Breadcrumbs' );
}
add_action( 'widgets_init', 'ang_deregister_widget', 11 );  