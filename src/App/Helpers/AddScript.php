<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/31/19
 * Time: 7:54 PM
 */

namespace nacsl\App\Helpers;

use nacsl\Wordpress\HooksInterfaces;

class AddScript implements HooksInterfaces
{

    public function script()
    {
        global $post;
        ?>
        <script>
            jQuery("td:contains('Poste vacant')").css({
                "font-weight":700,
                "color": "#ff1e1e",
            });
            jQuery('a[href*="drive.google"]').attr("target", "_blank");

            console.log("<?= $_SERVER['PATH_INFO']; ?>");
        </script>
        <?php
    }

    public function hook()
    {
        add_action('wp_footer', array($this, 'script'));
    }
}