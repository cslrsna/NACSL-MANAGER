<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/21/19
 * Time: 1:22 PM
 */

namespace nacsl;

use nacsl\Wordpress\HooksAdminInterfaces;
use nacsl\Wordpress\HooksFrontInterfaces;
use nacsl\Wordpress\HooksInterfaces;

/**
 * Singleton Class Main
 * @package nacsl
 * @version 1.0
 */
class Main
{

    private static $_isInit = false;
    private static $_instance;

    private $_actions = array();

    /**
     * Main Singleton constructor
     */
    private function __construct(){
        self::$_isInit = true;
    }

    /**
     * Main Singleton instance
     * @return Main
     */
    public static function getInstance(): Main
    {
        if ( !self::$_isInit ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Execute the main actions code of NACSL plugin.
     * @param array|null $actions
     */
    public function execute(  array $actions = null )
    {

        if ( $actions ){
            $this->_actions = $actions;
        }

        if ( empty( $this->_actions ) ){
            add_filter(
                'admin_footer_text',
                function (){
                    ?>
                    <script>console.log( "nacsl: no action register yet." )</script>
                    <?php
                }
            );
        }

        foreach ($this->_actions as $action) {
            switch (true){
                case $action instanceof HooksInterfaces:
                    $action->hook();
                    break;
                case $action instanceof HooksAdminInterfaces:
                    if ( is_admin() && current_user_can( 'manage_options' ) ){
                        $action->hook();
                    }
                    break;
                case $action instanceof HooksFrontInterfaces:
                    if ( ! is_admin() ){
                        $action->hook();
                    }
                    break;
            }
        }

    }

}