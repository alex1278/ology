<?php
/**
 * SHORTCODE :: Displays posts and categories with asinchronious pagination [author_box]
 *
 * @package     author meta
 * @subpackage  Shortcode/author box/ iBloga
 * @copyright   Copyright (c) 2016, Aleksandr Glovatskyy
 * @since       1.0.0
 * @version     1.0.0
 * @date        21.03.2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This shortcode allows you to specify author posts and categoties, displays additional information from User profile.
 * Author box Shortcode:
 * [ author_box ]  
 * Shortcode with parameters:
 * [ author_box cat_limit='3' show_count='0' aut_ava='on' aut_name='on' aut_country='on' aut_social='twitter,google,facebook']
 * You can also write text into shortcode:
 * [ author_box ]  Taxonomy from custom post type. Should be a name like...  [ /author_box ]  
 */

// Only load on front
if( is_admin() ) {
	return;
}

/* Displays Latest posts from selected category in tabs style */

    function aside_author_box($atts, $content = null){
        extract(shortcode_atts(array(
                'post_type'                     =>	'post', // Any post type like "portfolio", "event", "testimonial", "slideshow". Defoult is "post".
                'cat_limit'			=>	'',    // Max number of categories to list.
                'show_count'			=>	'0',    // Show category posts count.  Intager '0' - disable or '1' - enable.
                'aut_id'                        =>      '',    // Set an integer, author id='25'.
                'aut_ava'                       =>      'on',   // "on" or "off" to disable author avatar.
                'aut_name'                      =>      'on',   // "on" or "off" to disable author name.
                'aut_position'                  =>      '',     // "on" or "off" to disable author position.
                'aut_country'                   =>      '',   // "on" or "off" to disable author country.
                'aut_slogan'                    =>      '',   // "on" or "off" to disable author slogan.
                'aut_posts'                     =>      '',   // "on" or "off" to disable. Show author posts count.
                'aut_descr'                     =>      '',   // "on" or "off" to disable author description.
                'aut_social'                    =>      'twitter,google,facebook', // Should be a name like 'pinterest' or string of terms separated by comma. Fill the corresponding fields in author profile first.
                'aut_contact'                   =>      false,     // Show author contacts( phone number, emeil).
                'extra_class'                   =>      '',     // Enter extra class for custom styling. Prepared CSS classes: 'art-author-box', 'fashion-author-box', 'night-author-box'.
                'contact_form'                  =>      false,    // Activate contact form block
            ), $atts ) );
	
        
        ob_start();
        
        //get the author
        $author_id = ($aut_id != '') ? $aut_id : get_the_author_meta('ID');
        
        // get the author fields
        $author_registered      = get_the_author_meta('user_registered', $author_id);
        $name 			= get_the_author_meta( 'display_name' , $author_id);
        $email 			= get_the_author_meta( 'email' , $author_id);
        $website 		= get_the_author_meta( 'url' , $author_id);
        $mobile 		= get_the_author_meta( 'mobile' , $author_id);
        $mobile2 		= get_the_author_meta( 'mobile2' , $author_id);
        $mobile3 		= get_the_author_meta( 'mobile3' , $author_id);
        $skype 			= get_the_author_meta( 'skype' , $author_id);
        $twitter 		= get_the_author_meta( 'twitter' , $author_id);
        $facebook 		= get_the_author_meta( 'facebook' , $author_id);
        $linkedin 		= get_the_author_meta( 'linkedin' , $author_id);
        $odnoklassniki		= get_the_author_meta( 'odnoklassniki' , $author_id);
        $vk      		= get_the_author_meta( 'vk' , $author_id);
        $google 		= get_the_author_meta( 'google' , $author_id);
        $google_plus 		= get_the_author_meta( 'google-plus' , $author_id);
        $linkedin 		= get_the_author_meta( 'linkedin' , $author_id);
        $pinterest 		= get_the_author_meta( 'pinterest' , $author_id);
        $instagram 		= get_the_author_meta( 'instagram' , $author_id);
        $flickr 		= get_the_author_meta( 'flickr' , $author_id);
        $behance 		= get_the_author_meta( 'behance' , $author_id);
        $dribbble		= get_the_author_meta( 'dribbble' , $author_id);
        $youtube		= get_the_author_meta( 'youtube' , $author_id);
        $vimeo  		= get_the_author_meta( 'vimeo' , $author_id);
        
        $description 		= get_the_author_meta( 'description' , $author_id);
        $author_ava             = get_the_author_meta( 'user_email', $author_id);
        
        $gender 		= get_the_author_meta( 'gender' , $author_id); //radio button
        $birthday		= get_the_author_meta( 'birthday' , $author_id);
        $position 		= get_the_author_meta( 'position' , $author_id);
        $slogan 		= get_the_author_meta( 'slogan' , $author_id);
        $slatus 		= get_the_author_meta( 'slatus' , $author_id);
        $country                = get_the_author_meta( 'country', $author_id);
        $subarb                 = get_the_author_meta( 'subarb', $author_id);
        $city                   = get_the_author_meta( 'city', $author_id);
        $address                = get_the_author_meta( 'address', $author_id);
        $map_latitude           = get_the_author_meta( 'map_latitude', $author_id);
        $map_longitude          = get_the_author_meta( 'map_longitude', $author_id);
        $video 			= get_the_author_meta( 'video' , $author_id);
        $contact_form           = get_the_author_meta( 'contact-form' , $author_id);
        
        $author_link            = get_author_posts_url($author_id);
        
        
        // list author categories
        function list_author_categories($author_id, $show_count, $cat_limit) {

            $posts = get_posts( array(
                'author' => $author_id,
                'numberposts' => -1
            ) );

            $categories = array();

            foreach ( $posts as $post )
                foreach( get_the_category( $post->ID ) as $category )
                $categories[$category->term_id] =  $category->term_id;
            
            $output = wp_list_categories( array(
                'include'       => $categories,
                'show_count'    => $show_count,
                'number'        => $cat_limit,
                'title_li'      => '',
                'echo'          => false
                ) );
            $output = str_replace(array('(',')'), array('<span>','</span>'), $output);
            print "<ul class='uk-list uk-list-line'>{$output}</ul>";
        }
        
        // Collect fields
        
        ?>
        <div class="uk-panel ang-author-box <?php echo $extra_class; ?>">
            <?php if($content) print "<div class='ang-author-content'> {$content}</div>";?>
            <div class="uk-grid uk-grid-width-1-1" data-uk-grid-margin>
                <div>
                    <div class="uk-panel uk-panel-box">
                        <div class="ang-author-box-fields uk-clearfix">
                        <?php   
                            // get author avatar
                            if($aut_ava === 'on'){
                                print "<div class='ang-author-box-ava'>";
                                print get_avatar($email, $size = '120', null, 'Avat', array('class'=>'uk-border-circle'));
                                print "</div>";   
                            }
                            ?>
                            <div class="ang-author-box-meta">
                                <?php
                                if($aut_name === 'on' && $name != ''){
                                    print "<div class='ang-author-box-name ang-aut-devider'><h4><span><a href='{$author_link}' title='$name'>$name</a></span></h4></div>";
                                }

                                if($aut_position === 'on' && $position != ''){
                                    print "<div class='ang-author-box-position ang-aut-devider'>$position</div>";
                                }
                                if($aut_country === 'on' && $country != ''){
                                    print "<div class='ang-author-box-country ang-aut-devider'>$country</div>";
                                }

                                if($aut_slogan === 'on' && $slogan != ''){
                                    print "<blockquote class='ang-author-box-slogan'>$slogan</blockquote>";
                                }

                                if($aut_posts === 'on'){
                                    $author_posts_count = count_user_posts($author_id, $post_type, $public_only = false);
                                    print "<div class='ang-author-box-count ang-aut-devider'>".esc_html__('Published ', 'renter')."<span class='uk-text-bold'>{$author_posts_count}</span> posts.</div>";
                                }
                                ?>
                                
                            </div>
                            <?php
                            if($aut_descr === 'on' && $description != ''){ ?>
                                <div class="ang-author-box-descr uk-margin-small uk-width-1-1"><?php echo wp_trim_words($description, 25, ' ... '); ?>
                                    <?php echo '<a class="tm-link-bio-more " href="'.get_author_posts_url($author_id).'">'.esc_html__(' Read more', 'renter').'</a>'; ?>
                                </div>
                            <?php } ?>
                            
                            <?php if(!empty($aut_social) && $aut_social != '' ) {
                                    //get sosial links
                                    if( !is_array( $aut_social ) ) {
                                        $aut_social = explode(",", $aut_social);
                                        $aut_social = array_map('trim', $aut_social);
                                        $num = count($aut_social);
                                        $break_line = ceil($num/2);
                                        ?>

                                        <div class="contact-us-social author-box-social-cover uk-grid uk-grid-width-1-3 uk-grid-collapse">
                                        <?php
                                            for ($i = 0; $i < $num; $i++) {
                                                $source_value = $aut_social[$i];
                                                $get_link = get_the_author_meta( mb_strtolower($source_value, 'utf-8') , $author_id);
                                                if($get_link){ 
                                            ?>
                                            <div class="<?php echo $source_value; ?>">
                                                    <a class="uk-margin-remove uk-icon-small uk-icon-button uk-icon-hover uk-icon-<?php echo mb_strtolower($source_value, 'utf-8'); ?>" href="<?php echo $get_link;?>"></a>
                                            </div>
                                            <?php }
                                            } ?>
                                        </div>
                                <?php } ?>
                            <?php } ?>
                        </div>

                    <?php if($aut_contact) { ?>
                        <div class="uk-grid uk-grid-small uk-grid-width-1-1 ang-aut-contact" data-uk-grid-margin>
                            <?php if ($mobile != '') { ?>
                                <div class="ang-com-contacts" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', repeat: false, delay:600}">
                                    <p><span><i class="uk-icon-phone"></i><?php echo $mobile; ?></span></p>
                                </div>
                            <?php } ?>

                            <?php if ($mobile2 != '') { ?>
                                <div class="ang-com-contacts" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', repeat: false, delay:600}">
                                    <p><span><i class="uk-icon-mobile"></i><?php echo $mobile2; ?></span></p>
                                </div>
                            <?php } ?>

                            <?php if ($email != '') { ?>
                                <div class="ang-com-contacts"  data-uk-scrollspy="{cls:'uk-animation-slide-bottom', repeat: false, delay:1200}">
                                    <p><span><i class="uk-icon-envelope" ></i><?php echo $email; ?></span></p>
                                </div>
                            <?php } ?>
                                <div><a class="uk-button uk-width-1-1 uk-margin-top" href="<?php echo $author_link; ?>"><?php esc_html_e('View profile ', 'ang-plugins'); ?></a></div>
                        </div>

                    <?php } ?>

                    <?php if($cat_limit > 0) { ?>
                        <div class="ang-author-box-cats">
                            <?php list_author_categories($author_id, $show_count, $cat_limit); ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        <?php if($contact_form) { ?>
            <div class="uk-grid uk-grid-width-1-1" data-uk-grid-margin>
                <div>
                    <div class="uk-panel uk-panel-box">
                        <h4 class="uk-margin-bottom"><span><?php esc_html_e('Contact ', 'ang-plugins'); ?></span></h4>
                        <?php echo do_shortcode($contact_form); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
<?php return ob_get_clean();
    }
    add_shortcode( 'author_box', 'aside_author_box');