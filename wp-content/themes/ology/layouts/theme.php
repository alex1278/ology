<?php
/*
 * 
 * @encoding     UTF-8
 * @author       Aleksandr Glovatskyy (aleksandr1278@gmail.com)
 * @copyright    Copyright (C) 2016 torbara (http://torbara.com/). All rights reserved.
 * @license      Copyrighted Commercial Software
 * @support      support@torbara.com
 * 
 */

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html <?php body_class(); ?> lang="<?php echo esc_attr( $this['config']->get('language')); ?>" dir="<?php echo esc_attr($this['config']->get('direction')); ?>"  data-config='<?php echo esc_attr($this['config']->get('body_config','{}')); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>
<?php wp_head(); ?>

</head>

<body class="<?php echo esc_attr($this['config']->get('body_classes')); ?> <?php print $this['config']->get('style');?>">
<?php if(!$this['config']->get('preloader', true)){ ?>
    <div class="preloader-wrap uk-text-center uk-height-1-1">
        <div class="preloader-bg uk-height-1-1">
            <div class="uk-vertical-align uk-height-1-1 uk-container uk-container-center">
                <div class="uk-width-1-1 uk-vertical-align-middle">
                    <div class="uk-grid uk-grid-width-1-1" data-uk-grid-margin>
                        <div class="uk-text-center"><img src="<?php echo get_template_directory_uri(); ?>/images/preloader1.gif" alt="" /></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="ag-page-wrapp">
    <div class="<?php if(!$this['config']->get('menu_absolute', true)){
        echo 'tm-nav-absolute '; } ?>">
        <?php if ($this['widgets']->count('toolbar-l + toolbar-r + toolbar-dropdown + toolbar-dropdown-extra')) : ?>
        <div id="tm-toolbar-wrapper">
            <div class="uk-container uk-container-center">
                <div id="tm-toolbar" class="tm-toolbar uk-clearfix uk-hidden-small">

                    <?php if ($this['widgets']->count('toolbar-l')) : ?>
                        <div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('toolbar-r + toolbar-dropdown + toolbar-dropdown-extra')) : ?>
                        <div class="uk-float-right uk-margin-remove uk-position-relative">
                            <?php echo $this['widgets']->render('toolbar-r'); ?>
                            
                            <?php if ($this['widgets']->count('toolbar-dropdown')) : ?>
                                <div class=" uk-float-left1 woocommerce uk-display-inline-block ang-toolbar-dropdown" data-uk-dropdown="{mode:'click', justify:'#tm-toolbar'}">
                                    <a href="#"><i class="uk-icon-search"></i></a>
                                    <div class="uk-dropdown uk-container-center uk-margin-top">
                                        <?php echo $this['widgets']->render('toolbar-dropdown'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($this['widgets']->count('toolbar-dropdown-extra')) : ?>
                                <div class=" uk-float-left1 woocommerce uk-display-inline-block ang-toolbar-dropdown-extra" data-uk-dropdown="{mode:'click', pos:'bottom-right'}">
                                    <a href="#"><i class="uk-icon-shopping-cart"></i></a>
                                    <div class="uk-dropdown uk-container-center uk-margin-top">
                                        <?php echo $this['widgets']->render('toolbar-dropdown-extra'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($this['widgets']->count('headerbar')) : ?>
            <div id="tm-headerbar">
                <div class="uk-container uk-container-center">
                    <div class="tm-headerbar uk-clearfix uk-hidden-small">
                                <?php if ( $this['widgets']->count('headerbar') ) : ?>
                                    <?php echo $this['widgets']->render('headerbar'); ?>
                                <?php endif; ?> 
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!--  menu + logo small +  fullscreen + extra toolbar -->
        
            <div class="uk-position-z-index <?php 
            
            if(!$this['config']->get('menu_absolute', true)) {
                echo 'tm-nav-absolute ';
            }else{ echo 'uk-position-relative ';}
            if(!$this['config']->get('menu_top_offset', true)){
                echo 'tm-nav-top-offset ';
            }
            ?>">
                <div class="tm-menu-box "
                 
            <?php if(!$this['config']->get('menu_fixed', true)){
                        echo ' data-uk-sticky';
                } ?>
             <?php if($this['config']->get('menu_delay')!== 'default'){
                        echo ' data-uk-sticky="{'.$this['config']->get('menu_delay') .$this['config']->get('menu_showup').', '.$this['config']->get('menu_animation').'}"';
                } ?>>
            <nav id="tm-navbar" class="tm-navbar uk-navbar uk-margin-remove uk-position-relative uk-text-right">
                <div class="uk-container uk-container-center">      
                    <!-- The logo you can set up in widget or in theme setting -->
                    <?php if ( $this['widgets']->count('logo') ) : ?>
                        <a class="uk-float-left uk-navbar-brand uk-hidden-small uk-position-relative <?php if(is_front_page()) echo 'home-active';?>" href="<?php echo esc_url( $this['config']->get('site_url')); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
                    <?php else : ?>
                        <a class="uk-float-left uk-navbar-brand uk-hidden-small uk-position-relative <?php if(is_front_page()) echo 'home-active';?>" href="<?php echo esc_url($this['config']->get('site_url')); ?>"><?php echo esc_html($this['config']->get('logo_text')); ?></a>
                    <?php endif; ?> 
                        
                    <?php if ($this['widgets']->count('logo-small')) : ?>
                        <div class="uk-navbar-content  uk-float-left uk-navbar-center uk-visible-small">
                            <a class="uk-navbar-brand  ag-logo-small uk-position-relative <?php if(is_front_page()) echo 'home-active';?>" href="<?php echo esc_url($this['config']->get('site_url')); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
                        </div>
                    <?php else : ?>
                        <div class="uk-navbar-content  uk-float-left uk-navbar-center uk-visible-small">
                            <a class="uk-navbar-brand  ag-logo-small uk-position-relative <?php if(is_front_page()) echo 'home-active';?>" href="<?php echo esc_url($this['config']->get('site_url')); ?>"><?php echo esc_html($this['config']->get('logo_text')); ?></a>
                        </div>
                    <?php endif; ?>
                        
                    
                    <?php if ($this['widgets']->count('search')) : ?>
                        <div class="uk-display-inline-block uk-hidden-medium uk-vertical-align-middle uk-text-left">
                            <div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('extra-toolbar')) : ?>
                        <div class="uk-display-inline-block uk-text-left tm-extra-toolbar uk-hidden-small" data-uk-dropdown="{mode:'hover', justify:'.uk-container'}">
                            <a href="#" class="ang-pulse-anim-child"><i class="uk-icon-search"></i></a>
                            <div class="uk-dropdown uk-container-center">
                                <?php echo $this['widgets']->render('extra-toolbar'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="uk-navbar-flip">
                        <?php if ($this['widgets']->count('menu')) : ?>
                            <?php echo $this['widgets']->render('menu'); ?>
                        <?php endif; ?>
                    </div>
                        
                    <?php if ($this['widgets']->count('offcanvas')) : ?>
                        <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>

                    <?php endif; ?>
                </div> 
            </nav>
        </div>
    </div>
    </div>
    
<!--     breadcrumbs section  -->

    <?php if ($this['widgets']->count('breadcrumbs')) : ?>
    <div id="tm-breadcrumbs" <?php do_action('ang_breadcrumbs_bg'); ?> class="<?php echo esc_attr($this['config']->get('grid.breadcrumbs.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.breadcrumbs.background-animation')).' '; ?>">
         <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.breadcrumbs.background-color') ); ?>">
            <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.breadcrumbs.fullscreen') ) { echo esc_attr('ang-container-fullwidth'); } ?> <?php if (@$this['config']->get('grid.breadcrumbs.viewport_height')) { echo esc_attr('ang-height-viewport '); } ?> <?php if (@$this['config']->get('grid.breadcrumbs.vertical_alignment') != ''){echo esc_attr(' uk-vertical-align');} ?>">
                <div class="<?php echo esc_attr($grid_classes['breadcrumbs']); echo esc_attr($display_classes['breadcrumbs']); ?> <?php echo esc_attr($this['config']->get('grid.breadcrumbs.pad-top' )); ?>  <?php echo esc_attr($this['config']->get('grid.breadcrumbs.pad-bot' )); ?> <?php echo esc_attr($this['config']->get('grid.breadcrumbs.vertical_alignment')); ?>" data-uk-grid-match="{target:'> div > .uk-panel > .uk-grid'}" data-uk-grid-margin>
                    <?php echo $this['widgets']->render('breadcrumbs', array('layout'=>$this['config']->get('grid.breadcrumbs.layout'))); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>  

        <?php if ($this['widgets']->count('fullscreen')) : ?>
        
            <section id="tm-top-fullscreen" class="tm-fullscreen-box"><?php echo $this['widgets']->render('fullscreen'); ?></section>
        
        <?php endif; ?>
                 
        <!--  section with 5 blocks of features -->
        <?php if ($this['widgets']->count('top-a')) : ?>
            <div id="tm-top-a" class="<?php echo esc_attr($this['config']->get('grid.top-a.background')).' ';?> <?php echo esc_attr($this['config']->get('grid.top-a.background-animation') ).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-a.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-a.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.top-a.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['top-a']); echo esc_attr($display_classes['top-a']); ?> <?php echo esc_attr($this['config']->get('grid.top-a.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.top-a.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-a.vertical_alignment')); ?>" data-uk-grid-match="{target:'> div > .uk-panel > .uk-grid'}" data-uk-grid-margin>
                            <?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?>
                        </section>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!--   section with descr and accordion -->
        <?php if ($this['widgets']->count('top-b')) : ?>        
            <div id="tm-top-b" class="<?php echo esc_attr($this['config']->get('grid.top-b.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.top-b.background-animation')).' '; ?> " data-uk-parallax="{bg: '-500'}">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-b.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-b.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?>  <?php if (@$this['config']->get('grid.top-b.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">               
                        <section class="<?php echo esc_attr($grid_classes['top-b']); echo esc_attr($display_classes['top-b']); ?> <?php echo esc_attr($this['config']->get('grid.top-b.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.top-b.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-b.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>               
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!--  section with galery and search -->
        <?php if ($this['widgets']->count('top-c')) : ?>  
            <div id="tm-top-c" class="<?php echo esc_attr($this['config']->get('grid.top-c.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.top-c.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-c.background-color')); ?>">  
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-c.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.top-c.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">                   
                        <section class="<?php echo esc_attr( $grid_classes['top-c']); echo esc_attr( $display_classes['top-c']); ?> <?php echo esc_attr( $this['config']->get('grid.top-c.pad-top')); ?> <?php echo esc_attr( $this['config']->get('grid.top-c.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-c.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?></section>                   
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!--   section achievements -->
        <?php if ($this['widgets']->count('top-d')) : ?>
            <div id="tm-top-d" class="<?php  echo esc_attr( $this['config']->get('grid.top-d.background')).' '; ?> <?php  echo esc_attr( $this['config']->get('grid.top-d.background-animation')).' '; ?>" data-uk-parallax="{bg: '-300'}">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-d.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-d.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.top-d.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr( $grid_classes['top-d']); echo esc_attr($display_classes['top-d']); ?>  <?php echo esc_attr( $this['config']->get('grid.top-d.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.top-d.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-d.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-d', array('layout'=>$this['config']->get('grid.top-d.layout'))); ?></section>               
                    </div> 
                </div>
            </div>
        <?php endif; ?>     
        
        <!--   woocomerce items -->
        <?php if ($this['widgets']->count('top-e')) : ?>   
            <div id="tm-top-e" class="<?php echo esc_attr($this['config']->get('grid.top-e.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.top-e.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-e.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-e.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.top-e.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">                  
                        <section class="<?php echo esc_attr($grid_classes['top-e']); echo esc_attr($display_classes['top-e']); ?>  <?php echo esc_attr($this['config']->get('grid.top-e.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.top-e.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-e.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-e', array('layout'=>$this['config']->get('grid.top-e.layout'))); ?></section>                
                    </div>
                </div>
            </div>
        <?php endif; ?>    

        <!--   pricing section -->
        <?php if ($this['widgets']->count('top-f')) : ?>
            <div id="tm-top-f" class="<?php echo esc_attr( $this['config']->get('grid.top-f.background')).' '; ?> <?php echo esc_attr( $this['config']->get('grid.top-f.background-animation')).' '; ?>" data-uk-parallax="{bg: '-400'}">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-f.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-f.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.top-f.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">  
                        <section class="<?php echo esc_attr($grid_classes['top-f']); echo esc_attr( $display_classes['top-f']); ?>  <?php echo esc_attr( $this['config']->get('grid.top-f.pad-top')); ?> <?php echo esc_attr( $this['config']->get('grid.top-f.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-f.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-f', array('layout'=>$this['config']->get('grid.top-f.layout'))); ?></section> 
                    </div>
                </div>
            </div>          
        <?php endif; ?>
        
         <!--   extended section -->
        <?php if ($this['widgets']->count('top-g')) : ?>
            <div id="tm-top-g" class="<?php echo esc_attr($this['config']->get('grid.top-g.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.top-g.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.top-g.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.top-g.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.top-g.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">  
                        <section class="<?php echo esc_attr($grid_classes['top-g']); echo esc_attr($display_classes['top-g']); ?>  <?php echo esc_attr( $this['config']->get('grid.top-g.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.top-g.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.top-g.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-g', array('layout'=>$this['config']->get('grid.top-g.layout'))); ?></section> 
                    </div>
                </div>
            </div>          
        <?php endif; ?>
        
<!--        main content plus aside sections -->
       
    <?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
        <div  id="tm-main-section" class="<?php echo esc_attr($this['config']->get('background_color')).' '; ?> ">
             <div class="uk-container uk-container-center  <?php if (!$this['config']->get('content_fullwidth', true)) { echo esc_attr("ang-container-fullwidth"); }?>">
                 <div class="tm-middle uk-grid <?php if (!$this['widgets']->count('breadcrumbs')) { echo 'tm-padding-top-large'; } ?>" style = "padding-top:<?php echo esc_html($this['config']->get('content_pad_top'));?>; padding-bottom:<?php echo esc_html($this['config']->get('content_pad_bot'));?>;" data-uk-grid-match data-uk-grid-margin>
                    <?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
                        <div class="<?php echo esc_attr($columns['main']['class']) ?>">
                            
                        <?php 
                        if ($this['widgets']->count('social-sidebar')) : ?>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1 uk-width-large-9-10">
                                <div class="sidebar-in-sidebar-left">
                                    <?php if ($this['widgets']->count('main-top')) : ?>
                                        <div class="<?php echo esc_attr( $this['config']->get('grid.main-top.background')).' '; ?> <?php echo esc_attr( $this['config']->get('grid.main-top.background-animation')).' '; ?>">
                                            <div class=" <?php echo esc_attr($this['config']->get('grid.main-top.background-color')); ?> <?php if (@$this['config']->get('grid.main-top.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                                                <section id="tm-main-top" class="<?php echo esc_attr($grid_classes['main-top']); echo esc_attr($display_classes['main-top']); ?> <?php echo esc_attr( $this['config']->get('grid.main-top.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.main-top.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.main-top.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($this['config']->get('system_output', true)) : ?>
                                        <main id="tm-main-content" class="tm-content">
                                            <?php echo $this['template']->render('content'); ?>
                                        </main>
                                    <?php endif; ?>

                                    <?php if ($this['widgets']->count('main-bottom')) : ?>
                                        <div class="<?php echo esc_attr( $this['config']->get('grid.main-bottom.background')).' ';?> <?php echo esc_attr( $this['config']->get('grid.main-bottom.background-animation')).' '; ?>">
                                            <div class="<?php echo esc_attr( $this['config']->get('grid.main-bottom.background-color')); ?> <?php if (@$this['config']->get('grid.main-bottom.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                                                <section id="tm-main-bottom" class="<?php echo esc_attr( $grid_classes['main-bottom']); echo esc_attr($display_classes['main-bottom']); ?> <?php echo esc_attr( $this['config']->get('grid.main-bottom.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.main-bottom.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.main-bottom.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
                                            </div>
                                        </div>  
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-1 uk-width-large-1-10">
                                <div id="social-sidebar " class="sidebar-in-sidebar-right uk-hidden-small uk-hidden-medium" data-uk-sticky="{top:80,boundary:true}">
                                    <section id="tm-main-bottom" class="<?php echo esc_attr($grid_classes['social-sidebar']); echo esc_attr($display_classes['social-sidebar']); ?>" ><?php echo $this['widgets']->render('social-sidebar', array('layout'=>$this['config']->get('grid.social-sidebar.layout'))); ?></section>
                                </div>
                            </div>

                        </div>
                    <?php else:?>
                         <?php if ($this['widgets']->count('main-top')) : ?>
                            <div class="<?php echo esc_attr( $this['config']->get('grid.main-top.background')).' '; ?> <?php echo esc_attr( $this['config']->get('grid.main-top.background-animation')).' '; ?>">
                                <div class=" <?php echo esc_attr($this['config']->get('grid.main-top.background-color')); ?> <?php if (@$this['config']->get('grid.main-top.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                                    <section id="tm-main-top" class="<?php echo esc_attr($grid_classes['main-top']); echo esc_attr($display_classes['main-top']); ?> <?php echo esc_attr( $this['config']->get('grid.main-top.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.main-top.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.main-top.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this['config']->get('system_output', true)) : ?>
                            <main id="tm-main-content" class="tm-content">
                                <?php echo $this['template']->render('content'); ?>
                            </main>
                        <?php endif; ?>

                        <?php if ($this['widgets']->count('main-bottom')) : ?>
                            <div class="<?php echo esc_attr( $this['config']->get('grid.main-bottom.background')).' ';?> <?php echo esc_attr( $this['config']->get('grid.main-bottom.background-animation')).' '; ?>">
                                <div class="<?php echo esc_attr( $this['config']->get('grid.main-bottom.background-color')); ?> <?php if (@$this['config']->get('grid.main-bottom.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                                    <section id="tm-main-bottom" class="<?php echo esc_attr( $grid_classes['main-bottom']); echo esc_attr($display_classes['main-bottom']); ?> <?php echo esc_attr( $this['config']->get('grid.main-bottom.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.main-bottom.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.main-bottom.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
                                </div>
                            </div>  
                        <?php endif; ?>   
                    <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php foreach($columns as $name => &$column) : ?>
                    <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
                    <aside class="<?php echo esc_attr($column['class']) ?> <?php echo esc_attr($this['config']->get('aside_background_color')).' '; ?> "><?php echo $this['widgets']->render($name) ?></aside>
                    <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        
    <?php endif; ?>
        <!--   testimonials -->
        <?php if ($this['widgets']->count('bottom-a')) : ?>
            <div id="tm-bottom-a" class="<?php echo esc_attr($this['config']->get('grid.bottom-a.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.bottom-a.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-a.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-a.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-a.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-a']); echo esc_attr( $display_classes['bottom-a']); ?> <?php echo esc_attr( $this['config']->get('grid.bottom-a.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.bottom-a.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-a.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section> 
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    <!--  get it touch-->
        <?php if ($this['widgets']->count('bottom-b')) : ?>
            <div id="tm-bottom-b" class="<?php echo esc_attr($this['config']->get('grid.bottom-b.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.bottom-b.background-animation')).' '; ?>" data-uk-parallax="{bg: '-500'}">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-b.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-b.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-b.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-b']); echo esc_attr($display_classes['bottom-b']); ?> <?php echo esc_attr($this['config']->get('grid.bottom-b.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-b.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-b.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
                    </div>
               </div>
            </div>
        <?php endif; ?>

<!--  extra sections-->
       <?php if ($this['widgets']->count('bottom-c')) : ?>
            <div id="tm-bottom-c" class="<?php echo esc_attr($this['config']->get('grid.bottom-c.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.bottom-c.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-c.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-c.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-c.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-c']); echo esc_attr($display_classes['bottom-c']); ?> <?php echo esc_attr($this['config']->get('grid.bottom-c.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-c.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-c.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
                    </div>
                </div>
            </div>
       <?php endif; ?> 

        <?php if ($this['widgets']->count('bottom-d')) : ?>
            <div id="tm-bottom-d" class="<?php echo esc_attr($this['config']->get('grid.bottom-d.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.bottom-d.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-d.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-d.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-d.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-d']); echo esc_attr($display_classes['bottom-d']); ?> <?php echo esc_attr($this['config']->get('grid.bottom-d.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.bottom-d.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-d.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-d', array('layout'=>$this['config']->get('grid.bottom-d.layout'))); ?></section>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this['widgets']->count('bottom-e')) : ?>
            <div id="tm-bottom-e" class="<?php echo esc_attr($this['config']->get('grid.bottom-e.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.bottom-e.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-e.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-e.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-e.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-e']); echo esc_attr($display_classes['bottom-e']); ?> <?php echo esc_attr($this['config']->get('grid.bottom-e.pad-top')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-e.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-e.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-e', array('layout'=>$this['config']->get('grid.bottom-e.layout'))); ?></section>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($this['widgets']->count('bottom-f')) : ?>
            <div id="tm-bottom-f" class="<?php echo esc_attr($this['config']->get('grid.bottom-f.background')).' '; ?> <?php echo esc_attr( $this['config']->get('grid.bottom-f.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-f.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-f.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-f.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-f']); echo esc_attr($display_classes['bottom-f']); ?>  <?php echo esc_attr($this['config']->get('grid.bottom-f.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.bottom-f.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-f.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-f', array('layout'=>$this['config']->get('grid.bottom-f.layout'))); ?></section> 
                    </div>
                </div>
            </div>
        <?php endif; ?>

<!-- extra fullscreen bottom section-->

        <?php if ($this['widgets']->count('bottom-fullscreen')) : ?>
        <section id="tm-bottom-fullscreen" class="tm-bottom-fullscreen uk-position-relative"><?php echo $this['widgets']->render('bottom-fullscreen'); ?></section>
        <?php endif; ?>
                
        <?php if ($this['widgets']->count('bottom-g')) : ?>
            <div id="tm-bottom-g" class="<?php echo esc_attr($this['config']->get('grid.bottom-g.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.bottom-g.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.bottom-g.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.bottom-g.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.bottom-g.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        <section class="<?php echo esc_attr($grid_classes['bottom-g']); echo esc_attr($display_classes['bottom-g']); ?>  <?php echo esc_attr($this['config']->get('grid.bottom-g.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.bottom-g.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.bottom-g.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-g', array('layout'=>$this['config']->get('grid.bottom-g.layout'))); ?></section> 
                    </div>
                </div>
            </div>
        <?php endif; ?>

<!--footer section-->
        <?php if ($this['widgets']->count('footer + debug') || $this['config']->get('totop_scroller', true)  || $this['config']->get('warp_branding', true) ) : ?>
            <div class="<?php echo esc_attr($this['config']->get('grid.footer.background')).' '; ?> <?php echo esc_attr($this['config']->get('grid.footer.background-animation')).' '; ?>">
                <div class="tm-section-box <?php echo esc_attr($this['config']->get('grid.footer.background-color')); ?>">
                    <div class="uk-container uk-container-center <?php if (@$this['config']->get('grid.footer.fullscreen')) { echo esc_attr("ang-container-fullwidth"); } ?> <?php if (@$this['config']->get('grid.footer.viewport_height')) { echo esc_attr('ang-height-viewport uk-vertical-align'); } ?>">
                        
                        <footer id="tm-footer" class="uk-position-relative <?php echo esc_attr($grid_classes['footer']); if ( $this['widgets']->count('footer') ) { echo esc_attr($display_classes['footer']); } ?>  <?php echo esc_attr($this['config']->get('grid.footer.pad-top')); ?>  <?php echo esc_attr($this['config']->get('grid.footer.pad-bot')); ?> <?php echo esc_attr($this['config']->get('grid.footer.vertical_alignment')); ?> " data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
                                <?php if ( $this['widgets']->count('footer') ): ?>
                                    <?php echo $this['widgets']->render('footer', array('layout'=>$this['config']->get('grid.footer.layout'))); ?>
                                <?php else : ?>
                                    <p class="uk-panel uk-panel-box uk-width-1-1 uk-text-left"><?php $this->output('warp_branding'); ?></p>
                                <?php endif; ?>

                                <?php if ($this['config']->get('totop_scroller', true)) : ?>
                                    <a class="tm-my-totop-scroller"  href="#" data-uk-smooth-scroll></a>
                                <?php endif; ?>
                                
                                <?php echo $this['widgets']->render('debug'); ?>
                        </footer> 
                        
                    </div>                
                </div>
            </div>
            
        <?php endif; ?>

	<?php echo $this->render('footer'); ?>
</div>
	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>