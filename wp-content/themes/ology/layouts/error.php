<?php
/**
* @author    Aleksandr Glovatskyy (aleksandr1278@gmail.com)
* @copyright Copyright ( C ) 2015 CuteMarket (http://Cute.Market). All rights reserved.
* @license  Copyrighted Commercial Software
*/

// add css

$this['asset']->addFile('css', 'css:theme.css');

?>

<!DOCTYPE HTML>
<html lang="<?php echo esc_attr($this['config']->get('language')); ?>" dir="<?php echo esc_attr($this['config']->get('direction')); ?>" class="uk-height-1-1 tm-error uk-margin-remove">

<head>
<?php echo $this->render('head', compact('error', 'title')); ?>
    <?php wp_head(); ?>

</head>

<body class="uk-height-1-1  tm-error-page uk-text-center">
  
	<div class="uk-height-1-1 tm-error-wrap ">
            <div class="uk-height-1-1 uk-vertical-align">
            <div class="tm-border-block uk-vertical-align-middle uk-container uk-container-center">
                <div class="uk-grid uk-grid-large uk-grid-width-1-1 uk-grid-width-small-1-2">
                    <h1 class="tm-error-headline"><?php esc_html_e('404', 'ology');?></h1>
                </div>
                <div class="uk-grid uk-grid-large uk-grid-width-1-1 uk-grid-width-small-1-2  uk-margin-top-remove">
                                        
                    <div class="tm-error-head">
                        
                        <h4><?php esc_html_e('Page not found', 'ology');?></h4>
                    </div>
                    <div class="home-page-button">
                        <a class="uk-button uk-button-primary" href="<?php echo esc_url($this['config']->get('site_url')); ?>"><span><?php esc_html_e('Homepage', 'ology');?></span></a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
</body>
</html>