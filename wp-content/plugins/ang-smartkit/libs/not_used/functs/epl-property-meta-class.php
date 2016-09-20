<?php
/*******************************
 * shows price under the thumbnail pic //ang
 *********************************/

function ang_get_price_stiker1() {
    global $post, $property;
		$ang_stiker_price = '';
		if ( 'property' == $this->post_type || 'land' == $this->post_type || 'rural' == $this->post_type){
			if ( 'sold' == $this->get_property_meta('property_status') && '' != $this->get_property_price_sold_display()) {
				$ang_stiker_price = '<span class="status-sticker current">'.$this->get_property_price_sold_display() . '</span>';
			}
			elseif ( '' != $this->get_property_price_display() && 'yes' == $this->get_property_meta('property_price_display') ) {	// Property
				$ang_stiker_price = '<span class="status-sticker current">'. $this->get_property_price_display() . '</span>';
				
			}
			elseif ( $this->get_property_meta('property_authority') == 'auction' && 'no' == $this->get_property_meta('property_price_display') ) {	// Auction
				$ang_stiker_price = '<span class="page-price auction">' . __( 'Auction' , 'epl') . ' ' . $this->get_property_auction() . '</span>';
			}
			else {
				$price_plain_value_poa = __( 'POA' , 'epl');
				if(!empty($this->epl_settings) && isset($this->epl_settings['label_poa'])) {
					$ang_stiker_price = $this->epl_settings['label_poa'];
				}
				$ang_stiker_price = '<span class="status-sticker current">' . $price_plain_value_poa . '</span>';
			}
			if ( 'yes' == $this->get_property_meta('property_under_offer') && 'sold' != $this->get_property_meta('property_status')) {
				$ang_stiker_price = '';
			}
			
	} 
		elseif('rental' == $this->post_type) { 
			if( '' != $this->get_property_rent() && 'yes' == $this->get_property_meta('property_rent_display') && 'leased' != $this->get_property_meta('property_status') ) {
				
				
				$ang_stiker_price .='<span class="status-sticker open current-rent">'. $this->get_property_rent() . '</span>';
				
				
				
			} elseif('' != $this->get_property_rent() && 'yes' == $this->get_property_meta('property_rent_display') && 'leased' == $this->get_property_meta('property_status')) {
				$ang_stiker_price = '<span class="status-sticker open current-rent">'.$this->get_property_rent().'</span>';
				
			} else {
				$ang_stiker_price = '<span class="status-sticker  under-offer">'.__('TBA', 'epl').'</span>';
			}
			
		} 
		elseif ( 'commercial' == $this->post_type || 'business' == $this->post_type || 'commercial_land' == $this->post_type) {
			$rent_lease_type = 
				$this->get_property_meta('property_com_rent_period') != '' ? epl_listing_load_meta_commercial_rent_period_value( $this->get_property_meta('property_com_rent_period') ) : 'P.A.';
			// Sale or both
			$ang_stiker_price = '';
			if ( $this->get_property_meta('property_com_listing_type') == 'sale' ) {
				if ( '' != $this->get_property_price_display() && 'yes' == $this->get_property_meta('property_price_display') ) {	// Property
					$ang_stiker_price = '<span class="status-sticker current">'. $this->get_property_price_display(). '</span>';
				} else {
					$price_plain_value = '';
					if(!empty($this->epl_settings) && isset($this->epl_settings['label_poa'])) {
						$price_plain_value = $this->epl_settings['label_poa'];
					}
					$ang_stiker_price = '<span class="status-sticker  under-offer">'.$price_plain_value . '</span>';
				}
			}
			// Lease or Both
			if ( $this->get_property_meta('property_com_listing_type') == 'lease' ) { // Both
				
				if ( $this->get_property_com_rent() != '' && $this->get_property_price_display() == '' ) {
					$ang_stiker_price .= '<span class="status-sticker open current-rent">'. $this->get_property_com_rent().'</span>';
				
                                        
                                } elseif ( $this->get_property_price_display() != '' && $this->get_property_meta('property_com_listing_type') == 'lease' ) {
					$ang_stiker_price .= '<span class="status-sticker open">'. $this->get_property_price_display() . '</span>';
				
                                        
                                } elseif ( $this->get_property_meta('property_com_listing_type') == 'both' ) {
					$ang_stiker_price .='';
				
                                        
                                } else {
					if(!empty($this->epl_settings) && isset($this->epl_settings['label_poa'])) {
						$ang_stiker_price .= '<span class="status-sticker  under-offer">' . $this->epl_settings['label_poa'] . '</span>';
					}
				}
			}
                        
			// Status
			if ( 'sold' == $this->get_property_meta('property_status') ){
				$ang_stiker_price = '<span class="status-sticker current">'.$this->get_property_price_display().'</span>';
			}
			if ( 'yes' == $this->get_property_meta('property_under_offer') && 'sold' != $this->get_property_meta('property_status') ) { // Under Offer
				$ang_stiker_price = '';
			}
			if ( 'leased' == $this->get_property_meta('property_status') ) {
				$ang_stiker_price = '<span class="status-sticker current current-rent">'.$this->get_property_price_display().'</span>';
			}
		}
		return $ang_stiker_price;
	}

        
//}

$bb = new Ang_renter_price;

function ang_get_price_sticker_show1() { //ang
    global $property;
    //echo $property->ang_get_price_stiker1();
    echo $check;
       
}