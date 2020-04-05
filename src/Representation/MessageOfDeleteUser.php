<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/04/2020
 * Time: 19:00
 */

namespace App\Representation;


use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

class MessageOfDeleteUser
{
    /**
     * @Serializer\Groups("deleteUser")
     */
    public $message;

    /**
     * @Type("array<App\Entity\User>")
     * @Serializer\Groups("deleteUser")
     */
    public $dataDeleted;


    public function __construct($dataDeleted)
    {
        $this->dataDeleted [] = $dataDeleted;

        $this->message = "votre utilisateur  été supprimer";
    }

}