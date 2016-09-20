<?php

//hooks, disable updates for following plugins : EPL(easy-property-listings);
    
    function ang_disable_updates_epl($value) {
    if(isset($value->response['easy-property-listings/easy-property-listings.php']))
    {
        unset($value->response['easy-property-listings/easy-property-listings.php']);
    }
    return $value;
}
add_filter('site_transient_update_plugins', 'ang_disable_updates_epl');

