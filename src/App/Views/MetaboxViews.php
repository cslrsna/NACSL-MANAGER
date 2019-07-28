<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/27/19
 * Time: 5:33 PM
 */

namespace nacsl\App\Views;

/**
 * Class MetaboxViews
 * @package nacsl\App\Views
 */
class MetaboxViews
{

    public static function render($post, $mbox)
    {

        ?>
        <table class="form-table">
            <tbody>
            <?php

            foreach ($mbox['args'] as $item) {
                $val = get_post_meta($post->ID,$item['key'],true);

                switch ($item['type']){

                    case  'email' || 'text':
                        ?>
                        <tr valign="top">
                            <th scope="row">
                                <label  class="" for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
                            </th>
                            <td width="100%">
                                <input style="height: 28px !important; width: 100%; max-width: 400px;" class="" id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
                            </td>
                        </tr>
                        <?php
                        break;

                    case  'number':
                        ?>
                        <tr valign="top">
                            <th scope="row">
                                <label  class="" for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
                            </th>
                            <td width="100%">
                                <input style="height: 28px !important; width: 100px;" class="" id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
                            </td>
                        </tr>
                        <?php
                        break;

                }

            }

            ?>
            </tbody>
        </table>
        <?php

    }

}