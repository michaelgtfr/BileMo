<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/02/2020
 * Time: 20:50
 */

namespace App\Controller;

use App\Entity\Products;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\NoFoundProductException;

class ProductDetailController extends AbstractFOSRestController
{
    /**
     * @Get(
     *     path = "/product/{id}",
     *     name = "app_product_detail",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode=201,
     *     serializerGroups={"detail"}
     *     )
     */
    public function productDetail(Request $request)
    {
        $products = $this->getDoctrine()->getRepository(Products::class)
        ->find($request->get('id'));

        if($products == null)
        {
            $message = 'desoler mais l\'article demandé n\'existe pas';

            throw new NoFoundProductException($message);
        }

        return $products;
    }
}