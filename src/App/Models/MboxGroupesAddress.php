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

/**
 * Class MboxGroupesAddress
 * @package nacsl\App\Models
 */
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
                    'label' => __("No. civique", Config::TEXTDOMAINE),
                    'key'   => "_civique",
                    'type'  => "number",
                    'name'  => "civique",
                ],
                [
                    'label' => __("Local", Config::TEXTDOMAINE),
                    'key'   => "_local",
                    'type'  => "text",
                    'name'  => "local",
                ],
                [
                    'label' => __("Rue", Config::TEXTDOMAINE),
                    'key'   => "_rue",
                    'type'  => "text",
                    'name'  => "rue",
                ],
            )
        );

    }
}