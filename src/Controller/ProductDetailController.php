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
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\NoFoundProductException;
use Swagger\Annotations as SWG;

class ProductDetailController
{
    /**
     * @Rest\Get(
     *     path = "/product/{id}",
     *     name = "app_product_detail",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     statusCode=200,
     *     serializerGroups={"detail"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Get the details an article.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Products::class, groups={"detail"}))
     *     )
     * )
     * @SWG\Tag(name="Products")
     * @SWG\Parameter(
     *  name="Authorization",
     *  in="header",
     *  required=true,
     *  type="string",
     *  description="Bearer token",
     * )
     * @Security(name="Bearer")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return object|null
     * @throws NoFoundProductException
     */
    public function productDetail(Request $request, EntityManagerInterface $em)
    {
        //recovery of details of the article
        $product = $em->getRepository(Products::class)
        ->find($request->get('id'));

        if ($product == null) {
            $message = 'desoler mais l\'article demandé n\'existe pas';
            throw new NoFoundProductException($message);
        }

        //modification of the src attribute
        (new PictureSrc($request))->pictureSrc($product->getPictures());

        return $product;
    }
}