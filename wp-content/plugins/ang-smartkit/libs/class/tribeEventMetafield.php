<?php

/**
 * Description of tribeEventMetafield
 *
 * @author alex1
 */
class tribeEventsMetafield {
    //put your code here
    
    private $p_type; // CPT
    
    private $field_id; // HTML attr ID
    
    private $fiels_name; // Meta field Header Text
    
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $p_type        The name of CPT.
     * @param      string    $field_id      The ID of the meta field.
     * @param      string    $fiels_name    The name of this meta field.
     */
        
    public function __construct($p_type = 'post', $field_id = 'tribeEventsStarsMeta_box', $fiels_name = 'Additional Box') {
        $this->p_type = $p_type; // CPT
        $this->field_id = $field_id; // HTML attr ID
        $this->fiels_name = $fiels_name; // Meta field Header Text
    }
    
    
    public function get_post_type(){
        return $this->p_type;
    }
    
    public function get_id(){
        return $this->field_id;
    }
    
    public function get_name(){
        return $this->fiels_name;
    }
    
    public function add_hooks() {
        add_action( 'add_meta_boxes', array($this, 'tribeEventsStarsMeta_box') );
        add_action('save_post', array($this, 'tribeEventsStarsMeta_box_save'), 10, 2);
    }
     
    public function tribeEventsStarsMeta_box() {

        add_meta_box(
                $this->get_id(), $this->get_name(), array( $this, 'tribeEventsStarsMeta_box_content' ), $this->get_post_type(), 'normal', 'high'
        );

    }
    
    public function tribeEventsStarsMeta_box_content( $post ) {
        //nonce
        wp_nonce_field(plugin_basename(__FILE__), 'tribeEventsStarsMeta_box_content_nonce');

        //social
    ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"> 
                    <label for="event_rating"><?php esc_html_e('Rating', 'ang-smartkit'); ?></label>
                </th>
                <td>
                    <select name="event_rating" style="width: 150px">
                        <option value="1" <?php selected( 1, get_post_meta( $post->ID, 'event_rating', true ) ); ?>><?php _e('1 Star', 'ang-smartkit'); ?></option>
                        <option value="2" <?php selected( 2, get_post_meta( $post->ID, 'event_rating', true ) ); ?>><?php _e('2 Stars', 'ang-smartkit'); ?></option>
                        <option value="3" <?php selected( 3, get_post_meta( $post->ID, 'event_rating', true ) ); ?>><?php _e('3 Stars', 'ang-smartkit'); ?></option>
                        <option value="4" <?php selected( 4, get_post_meta( $post->ID, 'event_rating', true ) ); ?>><?php _e('4 Stars', 'ang-smartkit'); ?></option>
                        <option value="5" <?php selected( 5, get_post_meta( $post->ID, 'event_rating', true ) ); ?>><?php _e('5 Stars', 'ang-smartkit'); ?></option>
                        
                    </select>
                    <span class="description"><i><?php esc_html_e( 'Rate it with stars.', 'ang-smartkit' ); ?></i></span>
                </td>
            </tr>
            
        </table>
    <?php      

    }
    
    public function tribeEventsStarsMeta_box_save($post_id) {

        $slug = $this->get_post_type();
        if (isset($_POST['post_type'])) {
            if ($slug != $_POST['post_type']) {
                return;
            }
        }
        if (isset($_REQUEST['event_rating'])) {
            update_post_meta($post_id, 'event_rating', $_POST['event_rating']);
        }
    }
    
}