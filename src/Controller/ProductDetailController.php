<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/02/2020
 * Time: 20:50
 */

namespace App\Controller;


use App\Entity\Products;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class ProductDetailController
{
    /**
     * @Get(
     *     path = "/product/{id}",
     *     name = "app_product_detail",
     *     requirements = {"id"="\d+"}
     * )
     * @View(statusCode=201)
     */
    public function productDetail()
    {
        $products = new Products();
        $products->setName('dfdsds');
        $products->setContent('sfdsfsqfdddsfqsfdqf');

        return $products;
    }
}