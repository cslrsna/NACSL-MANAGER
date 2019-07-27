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

abstract class MboxGroupesCourriels implements CustomsDataInterface
{
    public static function data()
    {
        return array(
            'id'        => "email_groupe",
            'title'     => __("Courriels du groupe", Config::TEXTDOMAINE),
            'screen'    => CptGroupes::getName(),
            'context'   => "normal",
            'priority'  => "high",
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
            )
        );

    }
}