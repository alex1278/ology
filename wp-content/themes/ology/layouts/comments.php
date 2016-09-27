<?php if (comments_open() || have_comments()) : ?>

    <div id="comments" class="uk-margin-large-top ang-comment-cover">

        <?php if (have_comments()) : ?>

            <?php
            $classes = array("level1");

            if (get_option('comment_registration') && !is_user_logged_in()) {
                $classes[] = "no-response";
            }

            if (get_option('thread_comments')) {
                $classes[] = "nested";
            }
            ?>

            <ul class="uk-comment-list">
            <?php

                // single comment
                function ology_comment($comment, $args, $depth) {
                    global $user_identity;

                    $GLOBALS['comment'] = $comment;

                    $_GET['replytocom'] = get_comment_ID();
                    ?>
                    <li>
                        <article id="comment-<?php comment_ID(); ?>" class="uk-clearfix uk-comment <?php echo ($comment->user_id > 0) ? 'uk-comment-primary' : ''; ?>">

                                <div class="ang-comment-avatar">
                                    <?php echo get_avatar($comment, $size = '45', null, 'Avatar', array('class' => 'uk-border-circle')); ?>
                                </div>
                                <div class="ang-comment-content">
                                    <header class="ang-comment-header uk-margin-top">
                                        <div class="uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between">
                                            <h3 class="uk-comment-title uk-margin-remove"><?php echo get_comment_author_link(); ?></h3>
                                            <p class="uk-comment-meta">
                                                <a class="permalink ang-comment-date" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><time datetime="<?php echo get_comment_date('Y-m-d'); ?>"><?php printf(esc_html__('%1$s, %2$s', 'ology'), get_comment_date('j M, Y'), get_comment_time('G:i')) ?></time></a>    
                                                <?php if (comments_open() && $args['max_depth'] > $depth) : ?>
                                                    <span class="js-reply">&ensp;|&ensp;<a href="#" rel="<?php comment_ID(); ?>"><i class="uk-icon-reply"></i><?php esc_html_e('Reply', 'ology'); ?></a></span>
                                                    <?php edit_comment_link(esc_html__('Edit', 'ology'), ' | ', '') ;?>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </header>
                                    <div class="uk-comment-body uk-margin-top">
                                        <?php comment_text(); ?>

                                        <?php if ($comment->comment_approved == '0') : ?>
                                        <div class="uk-alert uk-margin"><?php esc_html_e('Your comment is awaiting moderation.', 'ology'); ?></div>
                                        <?php endif; ?>

                                    </div>
                                </div>

                        </article>
                    <?php
                    unset($_GET['replytocom']);

                    // </li> is rendered by system
                }

                wp_list_comments('type=all&callback=ology_comment');
            ?>
            </ul>
            <?php endif; ?>
            <?php
            if (!function_exists("ology_call_tpl_comment_respond")) {

                function ology_call_tpl_comment_respond() { ?>

                    <div id="respond" class="ang-respond-form">

                        <h3 class="uk-h3 uk-panel-title uk-text-bold uk-margin-large-top"><span><?php (comments_open()) ? comment_form_title(esc_html__('ADD COMMENT', 'ology')) : esc_html_e('Comments are closed', 'ology'); ?></span></h3>

                        <?php if (comments_open()) : ?>
                        <div>
                            <p class="ang-comment-note uk-margin-remove"> <?php esc_html_e('Your email address will not be published. Required fields are marked', 'ology'); ?> <span class="tm-comment-required-marker">*</span></p>

                            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                                <div class="uk-alert uk-alert-warning">
                                    <?php esc_html_e('You must be ', 'ology'); ?>
                                    <a href="<?php print wp_login_url(get_permalink());?>"><?php esc_html_e('logged in', 'ology'); ?></a>
                                    <?php esc_html_e(' to post a comment.', 'ology'); ?>
                                </div>

                            <?php else : ?>

                                <form class="uk-form1 uk-margin-top" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
                                    <?php if (is_user_logged_in()) : ?>

                                        <?php global $user_identity; ?>

                                        <div class="uk-grid uk-grid-medium uk-grid-width-1-1" data-uk-grid-margin>
                                            <div class="ang-comment-logout">
                                                <p>
                                                <?php
                                                
                                                esc_html_e('Logged in as ', 'ology');
                                                printf('<a href="%s">%s</a>', get_option('siteurl') . '/wp-admin/profile.php', $user_identity);
                                                
                                                ?>
                                                <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_html_e('Log out of this account', 'ology'); ?>"><?php esc_html_e('Log out &raquo;', 'ology'); ?></a>
                                                </p>
                                            </div>
                                            <div>
                                                <textarea class="tm-touch-message" name="comment" id="comment" cols="80" rows="5" tabindex="4" required placeholder="<?php esc_html_e('Comment *', 'ology'); ?>"></textarea>
                                            </div>
                                         </div>
                                        
                                    <?php else : ?>

                                        <?php $req = get_option('require_name_email'); ?>
                                        <?php
                                            if (!isset($comment_author)) {
                                                $comment_author = "";
                                            }
                                            ?>
                                            <?php
                                            if (!isset($comment_author_email)) {
                                                $comment_author_email = "";
                                            }
                                            ?>
                                            <?php
                                            if (!isset($comment_author_url)) {
                                                $comment_author_url = "";
                                            }
                                        ?>
                                        
                                        <div class="uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-2" data-uk-grid-margin>
                                            
                                            <div class="uk-form-row1 <?php if ($req) echo "required"; ?>">
                                                <input class="tm-touch-name" type="text" name="author" placeholder="<?php esc_html_e('YOUR NAME', 'ology'); ?> <?php if ($req) echo "*"; ?>" value="<?php echo esc_attr(@$comment_author); ?>" required <?php if ($req) echo "aria-required='true'"; ?>>
                                            </div>
                                            <div class="uk-form-row1 <?php if ($req) echo "required"; ?>">
                                                <input class="tm-touch-email" type="email" name="email" placeholder="<?php esc_html_e('YOUR E-MAIL', 'ology'); ?> <?php if ($req) echo "*"; ?>" value="<?php echo esc_attr(@$comment_author_email); ?>" required <?php if ($req) echo "aria-required='true'"; ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="uk-grid uk-grid-medium uk-grid-width-1-1" data-uk-grid-margin>
                                            
                                            <div>
                                                <textarea class="tm-touch-message" name="comment" id="comment" cols="80" rows="5" tabindex="4" required placeholder="<?php esc_html_e('YOUR MESSAGE *', 'ology'); ?>"></textarea>
                                            </div>
                                         </div>
                                        
                                    <?php endif; ?> 

                                        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                                            <div class="uk-form-row actions uk-width-1-1">
                                                <button class="uk-button uk-button-primary uk-margin-bottom-remove uk-text-bold uk-border-rounded uk-width-1-1" name="submit" type="submit" id="submit" tabindex="5"><?php esc_html_e('SEND MESSAGE', 'ology'); ?></button>
                                                <?php comment_id_fields(); ?>
                                            </div>
                                        </div>
                                    
                                    <?php global $post;
                                        do_action('comment_form', $post->ID);
                                    ?>
                                </form>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php
                }
            }
            ology_call_tpl_comment_respond();
            ?>

        <?php echo $this->render("_pagination", array("type" => "comments")); ?>

    
    </div>

    <?php

 endif;
