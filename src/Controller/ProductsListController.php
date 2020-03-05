<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/03/2020
 * Time: 20:29
 */

namespace App\Controller;


use App\Entity\Products;
use App\Exception\NoFoundProductException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class ProductsListController extends AbstractFOSRestController
{
    /**
     * @Get(
     *     path = "/products",
     *     name = "app_products_list",
     *)
     * @View(
     *     statusCode=201,
     *     serializerGroups={"list"}
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get list of Products.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Products::class, groups={"list"}))
     *     )
     * )
     * @SWG\Tag(name="Products")
     * @Security(name="Bearer")
     * @return object[]
     * @throws NoFoundProductException
     */

    public function productsList()
    {
        $listProducts = $this->getDoctrine()->getRepository(Products::class)
            ->findAll();

        if($listProducts == null)
        {
            $message = 'desoler mais il n\'y a pas d\'article';

            throw new NoFoundProductException($message);
        }

        return $listProducts;
    }
}