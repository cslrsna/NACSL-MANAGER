<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/27/19
 * Time: 4:11 PM
 */

namespace nacsl\App\Models;

use nacsl\App\Helpers\CustomsDataInterface;

abstract class MboxGroupesAddress implements CustomsDataInterface
{
    public static function data()
    {
        return array(
            'id'        => "address_groupe",
            'title'     => "Adresse du groupe",
            'screen'    => CptGroupes::getName(),
            'context'   => "normal",
            'priority'  => "high",
            'form'      => array(
                [
                    'label' => "Groupe",
                    'key'   => "_email_groupe",
                    'type'  => "email",
                    'name'  => "groupe",
                ],
            )
        );

    }
}