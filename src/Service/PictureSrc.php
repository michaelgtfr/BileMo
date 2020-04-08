<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 24/02/2020
 * Time: 09:21
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class PictureSrc
{
    private $host;
    private $pictureSrc;

    /**
     * allows the creation of a link to a product image
     *
     * PictureSrc constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        //PICTURE_SRC configuration is in the .env file
        $this->pictureSrc = $request->server->get('PICTURE_SRC');
        $this->host = $request->headers->get('host');
    }

    public function pictureSrc($picture)
    {
        foreach ($picture as &$value) {
            $link = $this->host.''. $this->pictureSrc.''. $value->getName(). '.' .$value->getExtension();
            $value->setSrc($link);
        }
        return $picture;
    }
}