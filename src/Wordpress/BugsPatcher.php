<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/31/19
 * Time: 11:46 AM
 */

namespace nacsl\Wordpress;


class BugsPatcher implements HooksInterfaces
{
    public function override_wp_get_nav_menu_object( $menu_obj, $menu ) {

        if ( ! is_object( $menu_obj ) ) {
            $menu_obj = (object) array( 'name' => '' );
        }

        return $menu_obj;
    }

    public function hook()
    {
        add_filter( 'wp_get_nav_menu_object', array($this,'override_wp_get_nav_menu_object'), 10, 2 );
    }


}