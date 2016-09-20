<?php
/**
 * Author Card used in Widget
 *
 * @package easy-property-listings
 * @subpackage Theme
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- Author Box Tall Container -->
<?php if (get_the_author_meta('ID') !='')
   {
        $author_id       =  get_the_author_meta('ID');
    }else{
        $author_id       =  $epl_author->author_id;
    }
        ?>
<div class="epl-widget epl-author-card epl-author author-card author">
	<div class="entry-content">
		<?php do_action('epl_author_widget_before_image'); ?>
		<div class="epl-author-box-tall epl-author-image author-box-tall author-image epl-clearfix">
			<?php if ( $d_image == 'on' ) {
                            
                                if (function_exists('get_wp_user_avatar')) {
                                    echo get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 'agent-size-box');
                                }else{
                                    do_action('epl_author_thumbnail',$epl_author); 
                                }	
                            } ?>
		</div>
		<?php do_action('epl_author_widget_after_image'); ?>
		
		<?php do_action('epl_author_widget_before_content'); ?>
		<div class="epl-author-box-tall epl-author-details author-box-tall author-details epl-clearfix">
                     <?php
                    
			$permalink 	= apply_filters('epl_author_profile_link', get_author_posts_url($author_id), $epl_author);
			$author_title	= apply_filters('epl_author_profile_title',get_the_author_meta( 'display_name',$epl_author->author_id ) ,$epl_author );

                         ?>
			<?php do_action('epl_author_widget_before_title'); ?>
                    
			<h5 class="epl-author-title author-title"><a href="<?php echo esc_attr($permalink); ?>"><?php echo esc_attr($author_title);?></a></h5>
			<?php do_action('epl_author_widget_after_title'); ?>
			
			<div class="epl-author-position author-position"><?php echo esc_attr($epl_author->get_author_position()) ?></div>
			<?php if(get_the_author_meta('contact-form', $author_id) != '') { ?>
                            <div class="ang-author-contact-form author-id-<?php echo esc_attr($author_id); ?>">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-small-2-3"><?php esc_html_e('You can leave the message. I will contact you as soon as possible.', 'renter'); ?></div>
                                    <div class="uk-width-small-1-3">
                                        <button class="uk-button uk-button-primary uk-float-right uk-width-1-1" data-uk-modal="{target:'#agent-modal'}"><?php esc_html_e('Contact', 'renter'); ?></button>
                                    </div> 
                                </div>
                                <div id="agent-modal" class="uk-modal">
                                    <div class="uk-modal-dialog">
                                        <button type="button" class="uk-modal-close uk-close"></button>
                                        <div class="uk-modal-header">
                                            
                                            <h4>Contact <?php echo get_the_author_meta( 'display_name' , $author_id); ?></h4>
                                        </div>
                                       
                                        <?php  

                                             echo do_shortcode(get_the_author_meta('contact-form', $author_id));
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
			<?php do_action('epl_author_widget_before_contact'); ?>
			<div class="epl-author-contact author-contact ang-author-contacts ang-widget-author-contacts">
				<?php if ( $epl_author->get_author_mobile() != '' ) { ?>
                                    <p><span class="ang-author-mobile"><i class="uk-icon-mobile"></i><?php echo esc_attr($epl_author->get_author_mobile()); ?></span>
                                    </p>
				<?php } ?>
                                <?php if ( $epl_author->get_author_mobile2() != '' ) { ?>
                                    <p><span class="ang-author-mobile"><i class="uk-icon-phone"></i><?php echo esc_attr($epl_author->get_author_mobile2()); ?></span>
                                    </p>
				<?php } ?>
                                <?php if ( $epl_author->get_author_website() != '' ) { ?>
                                    <p><span class="ang-author-mobile"><i class="uk-icon-globe"></i><a href="<?php echo esc_attr($epl_author->get_author_website()); ?>" onclick="window.open(this.href); return false;"><?php echo esc_attr($epl_author->get_author_website()) ?></a></span>
                                    </p>
				<?php } ?> 
                                <?php if ( get_the_author_meta('email', $author_id) != '' ) { ?>
                                    <p><span class="ang-author-mobile">
                                        <?php echo '<i class="uk-icon-at"></i><a href="mailto:' . get_the_author_meta('email', $author_id). '" title="'.esc_html__('Contact', 'renter').' '.get_the_author_meta('name', $author_id).' '.esc_html__('by Email', 'renter').'">'.get_the_author_meta('email', $author_id).'</a>'; ?>
                                    </span>
                                    </p>
                                <?php  } ?>
                                <?php 
                                
                                if ( get_the_author_meta('skype', $author_id) != '' ) { ?>
                                    <p><span class="ang-author-mobile"><i class="uk-icon-skype"></i><?php echo get_the_author_meta('skype', $author_id); ?></span>
                                    </p>
				<?php } ?>    
                               
			</div>
                        <div class=" uk-margin-bottom-remove" >
                            <?php if ( get_the_author_meta('facebook', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-facebook" href="<?php echo get_the_author_meta('facebook', $author_id);?>" onclick="window.open(this.href); return false;"></a>
                            <?php } ?>
                            <?php if ( get_the_author_meta('twitter', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-twitter" href="<?php echo get_the_author_meta('twitter', $author_id); ?>" onclick="window.open(this.href); return false;"></a>
                            <?php } ?>
                            <?php if ( get_the_author_meta('google', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-google-plus" href="<?php echo get_the_author_meta('google', $author_id); ?>" onclick="window.open(this.href); return false;"></a>
                            <?php } ?>
                            <?php if ( get_the_author_meta('linkedin', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-linkedin" href="<?php echo get_the_author_meta('linkedin', $author_id); ?>" onclick="window.open(this.href); return false;"></a>
                            <?php } ?>
                        </div>
                        <?php do_action('epl_author_widget_before_bio'); ?>
                        <?php if ( $d_bio == 'on' ) 
                            {
                            if (get_the_author_meta('description', $author_id) !='') 
                                { 
                                ?>
                                <div class="uk-margin"><?php echo wp_trim_words(get_the_author_meta('description', $author_id), 70, ' ... '); ?>
                                    <?php echo '<a class="tm-link-bio-more " href="'.get_author_posts_url($author_id).'">'.esc_html__('Read more', 'renter').'</a>'; ?>
                                </div>
                            <?php
                                }
                            } 
                        ?>
                        <?php do_action('epl_author_widget_after_bio'); ?>
                        
			<?php do_action('epl_author_widget_after_contact'); ?>
			
			<?php do_action('epl_author_widget_before_icons'); ?>
			<?php if ( $d_icons == 'on' ) { ?>
				<div class="epl-author-social-buttons author-social-buttons">
					<?php
						$social_icons = apply_filters('epl_display_author_social_icons',array('email','facebook','twitter','google','linkedin','skype'));
						foreach($social_icons as $social_icon){
							echo call_user_func(array($epl_author,'get_'.$social_icon.'_html')); 
						}
					?>
				</div>
			<?php } ?>
			<?php do_action('epl_author_widget_after_icons'); ?>
			
		</div>
		<?php do_action('epl_author_widget_after_content'); ?>
	</div>
</div>
