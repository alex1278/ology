<div class="ang-author-wrapp ang-tabs-switcher-content">
    <div class="uk-grid ang-article-content" data-uk-grid-margin data-uk-grid-match>
        <div class="uk-width-small-1-2">
           
            <?php if ($title == 'on'){ ?>
                    <h4 class="uk-margin-bottom-remove">
                        <a class="author-title" href="<?php echo $permalink; ?>"><?php echo esc_attr($name); ?></a>
                    </h4>
            <?php } ?>
            <div class="uk-grid uk-grid-small" data-uk-grid-margin>
                <div class="uk-width-small-1-2"><span><?php echo esc_attr($position); ?></span></div>
                <div class="uk-width-small-1-2 ang-author-social ">
                    <div class="uk-text-right">
                        <?php if ($facebook != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-facebook' href="<?php echo esc_attr($facebook); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>

                        <?php if ($twitter != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-twitter' href="<?php echo esc_attr($twitter); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>

                        <?php if ($google != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-google-plus' href="<?php echo esc_attr($google); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>

                        <?php if ($linkedin != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-linkedin' href="<?php echo esc_attr($linkedin); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>

                        <?php if ($instagram != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-instagram' href="<?php echo esc_attr($instagram); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>
                        <?php if ($flickr != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-flickr' href="<?php echo esc_attr($flickr); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>
                        <?php if ($pinterest != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-pinterest' href="<?php echo esc_attr($pinterest); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>
                        <?php if ($behance != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-behance' href="<?php echo esc_attr($behance); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>
                        <?php if ($dribbble != '') { ?>
                            <a rel='nofollow' class='uk-icon-small uk-icon-hover uk-icon-dribbble' href="<?php echo esc_attr($dribbble); ?>" onclick="window.open(this.href); return false;"></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="uk-margin uk-clearfix ang-author-contacts">
                <div class="ang-author-mobiles">
                    <div class="uk-grid-small uk-flex uk-flex-wrap uk-flex-space-between"  data-uk-grid-margin>
                        <?php if ($mobile != '') { ?>
                            <div><i class="uk-icon-mobile"></i><?php echo esc_attr($mobile); ?></div> 
                        <?php } ?>
                        <?php if ($mobile2 != '') { ?>
                            <div><i class="uk-icon-phone"></i><?php echo esc_attr($mobile2); ?></div> 
                        <?php } ?>
                        <?php if ($mobile3 != '') { ?>
                            <div><i class="uk-icon-phone-square"></i><?php echo esc_attr($mobile3); ?></div> 
                        <?php } ?>
                    </div>
                </div>
                
            </div>
            <?php if ($description != '') { ?>
                    <div class="uk-margin uk-clearfix ang-author-descr">
                        <?php echo wpautop($description); ?>
                    </div>
            <?php } ?>
            
            <div class="uk-grid uk-grid-small uk-margin-top" data-uk-grid-margin>
                <div class="uk-width-small-1-2 ang-author-properties">
                    <?php echo $prop_number; ?>
                </div>
                <div class="uk-width-small-1-2">
                    <div class="uk-align-medium-right uk-margin-bottom-remove" >
                    <?php if ($contact_form != '') { ?>
                        <a class="uk-float-right" data-uk-modal="{target:'#agent-modal'}"><i class="uk-icon-envelope"></i> <?php esc_html_e('Contact agent', 'renter'); ?></a>

                        <div id="agent-modal" class="uk-modal">
                            <div class="uk-modal-dialog">
                                <button type="button" class="uk-modal-close uk-close"></button>
                                <div class="uk-modal-header">
                                    <h3 class="uk-panel-title uk-margin-bottom"><span><?php esc_html_e('Contact', 'renter'); ?> <?php echo esc_html($name); ?></span></h3>
                                </div>
                                <?php echo do_shortcode($contact_form); ?>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="uk-width-small-1-2">
            <div class="uk-text-center">
                <?php echo $author_ava; ?>
            </div>
        </div>

    </div>
</div>