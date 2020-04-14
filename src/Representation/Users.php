<?php
/**
 * User: michaelgt
 * Date: 03/04/2020
 */

namespace App\Representation;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

/**
 * allows the display of data with information on pagination (metadata).
 *
 * Class Users
 * @package App\Representation
 */
class Users extends MetaData
{
    /**
     * @Type("array<App\Entity\User>")
     * @Serializer\Groups("listUsers")
     */
    public $data;
}
