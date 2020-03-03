<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/02/2020
 * Time: 20:50
 */

namespace App\Controller;

use App\Entity\Products;
use App\Service\PictureSrc;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\NoFoundProductException;
use Swagger\Annotations as SWG;

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
     * )
     *@SWG\Response(
     *     response=200,
     *     description="Get the details an article.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Products::class, groups={"detail"}))
     *     )
     * )
     *@SWG\Tag(name="Products")
     *@Security(name="Bearer")
     *
     * @param Request $request
     * @return object|null
     * @throws NoFoundProductException
     */
    public function productDetail(Request $request)
    {
        //recovery of details of the article
        $products = $this->getDoctrine()->getRepository(Products::class)
        ->find($request->get('id'));

        if($products == null)
        {
            $message = 'desoler mais l\'article demandé n\'existe pas';

            throw new NoFoundProductException($message);
        }

        //modification of the src attribute
        (new PictureSrc($request))->pictureSrc($products->getPictures());

        return $products;
    }
}