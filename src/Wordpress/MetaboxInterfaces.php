<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/26/19
 * Time: 7:44 PM
 */

namespace nacsl\Wordpress;


interface MetaboxInterfaces extends HooksAdminInterfaces
{

    public function init();
    public function view($post);
    public function save($postID);

}