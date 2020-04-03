<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/04/2020
 * Time: 11:13
 */

namespace App\Representation;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

class Users extends MetaData
{
    /**
     * @Type("array<App\Entity\User>")
     * @Serializer\Groups("listUsers")
     */
    public $data;
}