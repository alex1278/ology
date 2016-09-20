<style>
    #gopro{
        width: 100%;
        display: block;
        clear: both;
        padding: 10px;
        margin: 10px 8px 15px 5px;
        border: 1px solid #e1e1e1;
        background: #E7A199;
        color: #ffffff;
        overflow: hidden;
    }
    #wrapper{
        border: 1px solid #f0f0f0;
        width: 95%;

    }
    #wrapper{
        border: 1px solid #f0f0f0;
        width: 95%;

    }
    table.widefat{
        margin-bottom: 15px;
    }
    table.widefat tr{
        transition: 0.3s all ease-in-out;
        -moz-transition: 0.3s all ease-in-out;
        -webkit-transition: 0.3s all ease-in-out;
    }
    table.widefat tr:hover{
        /*background: #E6E6E6;*/
    }

    #wrapper input[type='text']{
        width: 80%;
        transition: 0.3s all ease-in-out;
        -moz-transition: 0.3s all ease-in-out;
        -webkit-transition: 0.3s all ease-in-out;
    }
    #wrapper input[type='text']:focus{
        border: 1px solid #1784c9;
        box-shadow: 0 0 7px #1784c9;
        -moz-box-shadow: 0 0 5px #1784c9;
        -webkit-box-shadow: 0 0 5px #1784c9;
    }
    #wrapper input[type='text'].small-text{
        width: 20%;
    }
    .proversion{
        color: red;
        font-style: italic;
        font-size: 11px;
    }
    .choose-progress{
        display: none;
    }
    .sc_popup_mode{
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        position: relative;
        top: 2px;
        box-shadow: 0 0 3px #333;
        -moz-box-shadow: 0 0 3px #333;
        -webkit-box-shadow: 0 0 3px #333;
    }

    .sc_popup_mode_off{
        background: #F54412;
    }
    .sc_popup_mode_live{
        background: #84E11F;
    }
    .sc_popup_mode_test{
        background: #FF9717;
    }
    .left{ float: left;}
    .right {float: right;}
    .center{text-align: center;}
    .width70{ width: 70%;}
    .width25{ width: 25% !important;}
    .width50{ width: 50%;}
    .larger{ font-size: larger;}
    .bold{ font-weight: bold;}
    .editcursor{ cursor: text}
    .red{ color: #CC0000; font-size: 12px;}
</style>


    <div id="gopro">
        <div class="center">
            <h1><b><?php esc_html_e('ANG Commando Staff Team Settings', 'ang-commando-staff-team'); ?></b></h1>
        </div>
        
    </div>

    <div class="width25 right">
        
        <table class="widefat">
            <thead>
            <tr>
                <th><b><?php esc_html_e('Read Me', 'ang-commando-staff-team');?></b> </th>
            </tr>
            <tr>
                <td>
                    <ul>
                        
                        <li><?php esc_html_e('To display Team Member from a specific category, add the category name in the shortcode like this', 'ang-commando-staff-team');?></li>
                        <li><?php esc_html_e('[co_commando commando_cat="" template="columns" columns="" link="" limit=""]', 'ang-commando-staff-team');?></li>
                        <li><?php esc_html_e('The ideal size for featured images is 400x400 or 300x300. Please ensure all images are the same size for ideal results', 'ang-commando-staff-team');?></li>
                    </ul>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?php esc_html_e('Shortcode Options:', 'ang-commando-staff-team');?></strong>
                    <ul>
                        <li><?php esc_html_e('commando_cat - specific taxonomy', 'ang-commando-staff-team');?></li>
                        <li><?php esc_html_e('template - specify view type', 'ang-commando-staff-team');?></li>
                        <li><?php esc_html_e('columns - 2, 3, 4', 'ang-commando-staff-team');?></li>
                        <li><?php esc_html_e('link - show single page', 'ang-commando-staff-team');?></li>
                        <li><?php esc_html_e('limit - set -1 to show all ', 'ang-commando-staff-team');?></li>
                    </ul>
                </td>
            </tr>

            </thead>
        </table>
        
        <table class="widefat">
            <thead>
                <tr>
                    <th><b><?php esc_html_e('YOU MAY ALSO LIKE', 'ang-commando-staff-team');?></b></th>
                </tr>
<!--                <tr>
                    <td>
                        <h4><?php esc_html_e('Esta - Real Estate Theme', 'ang-commando-staff-team');?></h4>
                        <img src="<?php echo plugin_dir_url( __FILE__ )?>img/screenshot-1.jpg" style="width: 100%"/>
                        <a href="https://themeforest.net/item/esta-responsive-real-estate-wordpress-theme/14292309?s_rank=37" class="button-primary" onclick="window.open(this.href); return false;">View Demo</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4><?php esc_html_e('iBloga - Multiporpose Theme', 'ang-commando-staff-team');?></h4>
                        <img src="<?php echo plugin_dir_url( __FILE__ )?>img/screenshot-2.jpg" style="width: 100%"/>
                        <a href="https://themeforest.net/item/ibloga-creative-multipurpose-blogportfolio-wordpress-theme/15859129?s_rank=4" class="button-primary" onclick="window.open(this.href); return false;">View Demo</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4><?php esc_html_e('Renter - Real Estate Theme', 'ang-commando-staff-team');?></h4>
                        <img src="<?php echo plugin_dir_url( __FILE__ )?>img/screenshot-3.jpg" style="width: 100%"/>
                        <a href="https://themeforest.net/item/renter-rentsale-real-estate-agency-psd-template/15211049?s_rank=34" class="button-primary" onclick="window.open(this.href); return false;">View Demo</a>
                    </td>
                   
                </tr>-->
                
            </thead>
        </table>

    </div>