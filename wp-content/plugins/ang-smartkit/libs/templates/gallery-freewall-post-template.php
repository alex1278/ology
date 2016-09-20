<?php
    global $post;
        // get post thumbnail id
        if ( has_post_thumbnail() ) {
            $thumb_id = get_post_thumbnail_id( $post->ID ); //add post thumbnail id;
            $img = wp_prepare_attachment_for_js ( $thumb_id ); // get image data array
            
            if($taxonomy  && $filter === 'on'){
            $tax_terms = get_the_terms($post->ID, $taxonomy); //get taxonomy terms array
                $tax_terms_arr = array();
                foreach($tax_terms as $tax_term){
                    $tax_terms_arr[] = $tax_term->slug; // get term slug
                }
                $tax_terms_str = implode(" ", $tax_terms_arr); // create term string separated by comma
                $image_attributes = wp_get_attachment_image_src( $img["id"], 'full' );
            }else{
                $tax_terms_str = '';
            }
            ?>  
            <div class="box brick <?php echo "item-{$count}"; ?> <?php echo $sizes_arr[mt_rand(0, $number)]; ?> <?php echo $tax_terms_str; ?> ang-main-gallery-item"
                 data-uk-filter="<?php echo $tax_terms_str; ?>" 
                 style="background-image: url('<?php echo $image_attributes[0]; ?>') ">

                <figure class="uk-overlay uk-overlay-hover uk-width-1-1 uk-height-1-1">                                    
                    <img src="<?php echo $image_attributes[0] ?>"
                         alt="<?php echo $img["alt"]; ?>" 
                         title="<?php echo $img["title"];?>"
                         style="display:none">

                    <figcaption class="uk-overlay-panel uk-overlay-background uk-text-center uk-overlay-fade">
                        <div class="uk-height-1-1 uk-flex uk-flex-center uk-flex-middle ang-gallery-item-overlay">

                                <a data-uk-lightbox="{group:'<?php echo $template; ?>-portfolio-group'}" 
                                   data-lightbox-type="image" 
                                   title="<?php echo $img["title"]; ?>"
                                   href="<?php echo $img["url"]; ?>">
                                    <i class="uk-icon-search-plus"></i>
                                </a>
                                <a href="<?php the_permalink() ?>"><i class="uk-icon-eye"></i></a>
                        </div>
                    </figcaption>
                </figure>
            </div>

<?php } 
                                    
                    

