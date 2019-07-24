<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/21/19
 * Time: 2:35 PM
 */

namespace nacsl\Wordpress;


interface HooksInterfaces
{

    public function hook();

}

interface HooksAdminInterfaces extends HooksInterfaces{}

interface HooksFrontInterfaces extends HooksInterfaces{}