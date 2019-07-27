<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/27/19
 * Time: 5:33 PM
 */

namespace nacsl\App\Views;


use nacsl\App\Models\MboxGroupesCourriels;

/**
 * @method getFrom()
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

                    case  'email':
                        ?>
                        <tr valign="top">
                            <th scope="row" style="padding: 10px 10px 10px 0; min-width: 80px; vertical-align: middle;">
                                <label  class="" for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
                            </th>
                            <td width="100%" style=" padding: 5px 10px;">
                                <input style="height: 28px !important; width: 100%; max-width: 400px;" class="" id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
                            </td>
                        </tr>
                        <?php
                        break;

                    case 'text':
                        ?>
                        <tr valign="top">
                            <th scope="row" style="padding: 10px 10px 10px 0; min-width: 80px; vertical-align: middle;">
                                <label  class="" for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
                            </th>
                            <td width="100%" style=" padding: 5px 10px;">
                                <input style="height: 28px !important; width: 100%;" class="" id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
                            </td>
                        </tr>
                        <?php
                        break;

                    case 'checkbox':
                        ?>
                        <tr valign="top">
                            <th scope="row" style="padding: 10px 10px 10px 0; min-width: 80px; vertical-align: middle;">
                                <label  class="" for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
                            </th>
                            <td width="100%" style=" padding: 5px 10px;">
                                <input class="" id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
                            </td>
                        </tr>
                        <?php
                        break;

                    case 'radio':
                        ?>
                        <tr valign="top">
                            <th scope="row" style="padding: 10px 10px 10px 0; min-width: 80px; vertical-align: middle;">
                                <label  class="" for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
                            </th>
                            <td width="100%" style=" padding: 5px 10px;">
                                <input class="" id="<?= $item['name'] ?>" type="<?= $item['type'] ?>" name="<?= $item['name'] ?>" value="<?= $val ?>" />
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