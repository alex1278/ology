<?php
/**
 * Author Card used in Widget
 *
 * @package easy-property-listings
 * @subpackage Theme renter
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
<div class="epl-tab-section ang-single-author-box uk-clearfix">
    <h3 class="uk-panel-title"><span><?php esc_html_e('Assigned Agent', 'renter'); ?></span></h3>
    <div class="ang-author-card">
        <div class="uk-grid">
            <div class="ang-authot-box-ava uk-vertical-align uk-text-center-small uk-width-medium-1-3">
                <div class="uk-vertical-align-middle">
                <?php 
                    if (function_exists('get_wp_user_avatar')) {
                        echo get_wp_user_avatar(get_the_author_meta('user_email', $author_id), 'thumbnail');
                    }else{
                        do_action('epl_author_thumbnail',$epl_author); 
                    }	
                ?>
                </div>
            </div>
            <div class="ang-author-box-inf uk-width-medium-2-3">
                <div class="uk-panel">
                <?php
                    $permalink 	= apply_filters('epl_author_profile_link', get_author_posts_url($author_id), $epl_author);
                    $author_title	= apply_filters('epl_author_profile_title',get_the_author_meta( 'display_name',$epl_author->author_id ) ,$epl_author );
                ?>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-small-2-3">
                        <h5 class="epl-author-title author-title"><a href="<?php echo esc_attr($permalink); ?>"><?php echo esc_attr($author_title);?></a></h5>
                        <div class="epl-author-position author-position tm-agent-position"><?php echo esc_attr($epl_author->get_author_position()) ?></div>
                    </div>
                    <div class="uk-width-small-1-3">
                        <?php if(get_the_author_meta('contact-form', $author_id) != '') { ?>
                            <div class="ang-author-contact-form author-id-<?php echo esc_attr($author_id); ?>">
                                <button class="uk-button uk-button-primary uk-float-right uk-width-1-1" data-uk-modal="{target:'#agent-modal'}"><?php esc_html_e('Contact', 'renter'); ?></button>
                                <div id="agent-modal" class="uk-modal">
                                    <div class="uk-modal-dialog">
                                        <button type="button" class="uk-modal-close uk-close"></button>
                                        <div class="uk-modal-header">
                                            <h3 class="uk-panel-title uk-margin-bottom"><span><?php esc_html_e('Contact', 'renter'); ?> <?php echo get_the_author_meta( 'display_name' , $author_id); ?></span></h3>
                                        </div>
                                        <?php echo do_shortcode(get_the_author_meta('contact-form', $author_id));?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php if (get_the_author_meta('description', $author_id) !='') { ?>

                    <div class="uk-width-1-1">
                        <div class="ang-author-box-descr"><?php echo wp_trim_words(get_the_author_meta('description', $author_id), 15, ' ... '); ?>
                            <?php echo '<a class="tm-link-bio-more " href="'.get_author_posts_url($author_id).'"> '.esc_html__('Read more', 'renter').'</a>'; ?>
                        </div>
                    </div>

                <?php } ?>

                    <div class="ang-author-mobiles">
                        <div class="uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between" data-uk-grid-margin>
<!--                        <div class="uk-width-small-2-3">-->
                            <?php if ( $epl_author->get_author_mobile() != '' ) { ?>
                                <div><i class="uk-icon-mobile"></i><?php echo esc_attr($epl_author->get_author_mobile()); ?></div>
                            <?php } ?>
                            <?php if ( get_the_author_meta('email', $author_id) != '' ) { ?>
                                <div>
                                    <?php echo '<i class="uk-icon-at"></i><a href="mailto:' . get_the_author_meta('email', $author_id). '" title="'.esc_html__('Contact', 'renter').' '.get_the_author_meta('name', $author_id).' '.esc_html__('by Email', 'renter').'">'.get_the_author_meta('email', $author_id).'</a>'; ?>
                                </div>
                            <?php  } ?>
<!--                        </div>-->
                        <!--<div class=" uk-margin-bottom-remove uk-width-small-1-3" >-->
                        <div class=" ang-author-social">
                            <?php if ( get_the_author_meta('facebook', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-facebook" href="<?php echo get_the_author_meta('facebook', $author_id);?>"></a>
                            <?php } ?>
                            <?php if ( get_the_author_meta('twitter', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-twitter" href="<?php echo get_the_author_meta('twitter', $author_id); ?>"></a>
                            <?php } ?>
                            <?php if ( get_the_author_meta('google', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-google-plus" href="<?php echo get_the_author_meta('google', $author_id); ?>"></a>
                            <?php } ?>
                            <?php if ( get_the_author_meta('linkedin', $author_id) != '' ) { ?>
                            <a class="uk-icon-small uk-icon-hover uk-icon-linkedin" href="<?php echo get_the_author_meta('linkedin', $author_id); ?>"></a>
                            <?php } ?>
                        </div>
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
