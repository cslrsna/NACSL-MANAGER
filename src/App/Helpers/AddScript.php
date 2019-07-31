<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/31/19
 * Time: 7:54 PM
 */

namespace nacsl\App\Helpers;


use nacsl\Wordpress\HooksFrontInterfaces;

class AddScript implements HooksFrontInterfaces
{

    public function script()
    {
        ?>
        <script>
            jQuery("td:contains('Poste vacant')").css('font-weight','700');
        </script>
        <?php
    }

    public function hook()
    {
        add_filter('update_footer', array($this, 'script'));
    }
}