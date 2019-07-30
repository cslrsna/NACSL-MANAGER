<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/27/19
 * Time: 4:11 PM
 */

namespace nacsl\App\Models;

use nacsl\App\Config;
use nacsl\App\Helpers\CustomsDataInterface;
use nacsl\App\Views\MetaboxViewCourriels;
use nacsl\App\Views\MetaboxViews;

/**
 * Class MboxGroupesCourriels
 * @package nacsl\App\Models
 */
abstract class MboxGroupesCourriels implements CustomsDataInterface
{

    /**
     * @return array
     */
    public static function data()
    {
        return array(
            'id'        => "email_groupe",
            'title'     => __("Courriels du groupe", Config::TEXTDOMAINE),
            'screen'    => CptGroupes::getName(),
            'context'   => "normal",
            'priority'  => "default",
            'form'      => array(
                [
                    'label' => __("Groupes", Config::TEXTDOMAINE),
                    'key'   => "_email_groupe",
                    'type'  => "email",
                    'name'  => "groupe",
                ],
                [
                    'label' => __("RSG", Config::TEXTDOMAINE),
                    'key'   => "_email_rsg",
                    'type'  => "email",
                    'name'  => "rsg",
                ],
                [
                    'label' => __("RSG-adjoint", Config::TEXTDOMAINE),
                    'key'   => "_email_rsg_adj",
                    'type'  => "email",
                    'name'  => "rsg_adj",
                ],
            ),
            'view' => MetaboxViewCourriels::class
        );

    }
}