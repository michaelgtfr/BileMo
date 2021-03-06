<?php
/**
 * User: michaelgt
 * Date: 06/03/2020
 */

namespace App\Representation;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

/**
 * allows the display of data with information on pagination (metadata).
 *
 * Class Products
 * @package App\Representation
 */
class Products extends MetaData
{
    /**
     * @Type("array<App\Entity\Products>")
     * @Serializer\Groups("list")
     */
    public $data;
}
