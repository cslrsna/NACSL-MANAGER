<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/27/19
 * Time: 5:33 PM
 */

namespace nacsl\App\Views;

use nacsl\App\Config;
use nacsl\Wordpress\MetaboxViewsInterfaces;

/**
 * Class MetaboxViews
 * @package nacsl\App\Views
 */
class MetaboxViewCourriels implements MetaboxViewsInterfaces
{

    /**
     * @param $post
     * @param $mbox
     */
    public static function render($post, $mbox)
    {

        ?>
        <p>
            <?= __("Les courriels du RSG et son adjoint sont et doivent rester secrets, ils ne s'afficheront jamais sur le site web. Ceux-ci servent à mettre à jour les redirections de courriels.", Config::TEXTDOMAINE) ?>
        </p>
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

                }

            }

            ?>
            </tbody>
        </table>
        <?php

    }

}

/***
<div class="inside">
    <div id="postcustomstuff">
        <div id="ajax-response"></div>

        <table id="list-table" style="display: none;">
            <thead>
                <tr>
                    <th class="left">Nom</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr><td></td></tr>
            </tbody>
        </table>
        <p><strong>Ajouter un nouveau champ personnalisé&nbsp;:</strong></p>
        <table id="newmeta">
            <thead>
                <tr>
                    <th class="left"><label for="metakeyinput">Nom</label></th>
                    <th><label for="metavalue">Valeur</label></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td id="newmetaleft" class="left">
                        <input type="text" id="metakeyinput" name="metakeyinput" value="">
                    </td>
                    <td>
                        <textarea id="metavalue" name="metavalue" rows="2" cols="25"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="submit">
                            <input type="submit" name="addmeta" id="newmeta-submit" class="button" value="Ajouter un champ personnalisé" data-wp-lists="add:the-list:newmeta">
                        </div>
                        <input type="hidden" id="_ajax_nonce-add-meta" name="_ajax_nonce-add-meta" value="d7f15e6b06">
                    </td>
                </tr>
            </tbody>
        </table>
</div>
<p>
Les champs personnalisés peuvent être utilisés pour ajouter des métadonnées supplémentaires à une publication, que vous pouvez ensuite <a href="https://codex.wordpress.org/Using_Custom_Fields">utiliser dans votre thème</a>.</p>
</div>
*
 */