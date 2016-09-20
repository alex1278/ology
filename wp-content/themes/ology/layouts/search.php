<?php if (have_posts()) : ?>
            <div class="uk-margin-large-bottom uk-text-bold uk-text-left ang-search-form"><?php // get_search_form(); ?></div>
            <h2 class="uk-article-title uk-margin-large-top uk-margin-large-bottom uk-text-bold"><?php esc_html_e('Search Results for', 'ology'); ?> &#8216;<?php echo stripslashes(strip_tags(get_search_query())); ?>&#8217;</h2>
            <div class="ang-search-wrapp">
                <?php
                $epl_posts = array('property', 'land', 'commercial', 'business', 'commercial_land', 'location_profile', 'rental', 'rural', 'post');
                // loop result
                while (have_posts()) {
                    the_post();
                    ?>
                    <article id="item-<?php the_ID(); ?>" <?php post_class('ang-renter-slides-tmp uk-article tm-tab-content'); ?> data-permalink="<?php the_permalink(); ?>">
                    <?php
                        $epl_posts = array('property','land', 'commercial', 'business', 'commercial_land' , 'location_profile','rental','rural');
                        if (in_array(get_post_type(get_the_ID()), $epl_posts)) { ?>
                            <h4 class="uk-margin-top-remove"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo get_post_meta( get_the_ID(), 'property_heading', true );?></a></h4>
                    <?php }else{ ?>
                            <h4 class="uk-margin-top-remove"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                    <?php } ?>

                    <?php if (has_post_thumbnail()) : ?>        
                        <div class="uk-position-relative">
                            <div class="uk-position-relative">

                                    <div class="ang-post-image-cover">
                                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('fullscreen-single', array('class' => 'ang-news-thumb')); ?>
                                        </a>
                                    </div>


                            </div>
                            
                            <div class="ang-stickers-wrapper">
                                <span class="uk-float-left">
                                    <span class="ang-status-sticker">
                                        <time datetime="<?php print get_the_date('Y-m-d');?>"><?php print get_the_date('j M, y');?></time>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <?php else: ?>
                            <?php
                                if(!function_exists('ology_default_image')){
                                    function ology_default_image (){ ?>
                                        <?php global $warp; ?>
                                        <?php if(!$warp['config']->get('no_image', true)) { ?>
                                            <div class="ang-post-image-cover ang-noimage">
                                                <a class="tm-category-post-thumb uk-width-1-1" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img class="uk-width-1-1" src="<?php echo get_template_directory_uri(); ?>/images/no-image/imgo720x400.jpg" alt="no-image" /></a>
                                            </div><?php
                                        }
                                    }
                                }
                                ology_default_image ();
                                ?>
                                

                        <?php endif; ?>
                    <div class="">
                        <div class="uk-margin-top uk-margin-bottom ang-post-slides-excerpt">

                        <?php
                            $exp = get_the_excerpt();
                            if ( $exp != '' ){
                                print "<div class='uk-width-1-1 excerpt'><p class='uk-margin-remove'>". wp_trim_words( do_shortcode($exp), 17, '...') ."</p></div>";
                            } else {
                                print "<div class='uk-width-1-1 content'><p class='uk-margin-remove'>". wp_trim_words( do_shortcode(get_the_content()), 17, '...') ."</p></div>";
                            }

                        ?>

                        </div>
                        <div class="ang-arhive-links uk-clearfix">
                            <?php
                                printf(wp_kses(__('<span class="uk-float-left"> Author: %s</span>', 'ology'), 'post' ), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>');
                            ?>
                            <?php if(comments_open() || get_comments_number()) : ?>
                            <span class="uk-float-right"><?php esc_html_e('Comments: ', 'ology'); comments_popup_link(esc_html__('0', 'ology'), esc_html__('1', 'ology'), esc_html__('%', 'ology'), "", "");?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                </article>
                <?php }  ?>
            </div>
            <?php echo $this->render("_pagination", array("type" => "posts")); ?>

        <?php else : ?>

            <h2 class="tm-search-article uk-article-title uk-text-center uk-margin-large-top uk-margin-large-bottom uk-text-bold"><?php esc_html_e('No posts found. Try a different search?', 'ology'); ?></h2>
            <div class="uk-text-center uk-margin-large-bottom uk-text-bold uk-text-left ang-search-form"><?php get_search_form(); ?></div>

        <?php endif;
