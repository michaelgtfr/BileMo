<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/03/2020
 * Time: 17:13
 */

namespace App\Representation;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

class Products extends MetaData
{
    /**
     * @Type("array<App\Entity\Products>")
     * @Serializer\Groups("list")
     */
    public $data;
}