<?php
/**
 * User: michaelgt
 * Date: 20/02/2020
 */

namespace App\Controller;

use App\Entity\Products;
use App\Exception\NoFoundAppException;
use App\Service\PictureSrc;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class ProductDetailController
{
    /**
     * allows the customer to retrieve the detail of a product.
     *
     * @Rest\Get(
     *     path = "api/product/{id}",
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
     *  default="BEARER TOKEN",
     *  type="string",
     *  description="Bearer token",
     * )
     * @Security(name="Bearer")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return object|null
     * @throws NoFoundAppException
     */
    public function productDetail(Request $request, EntityManagerInterface $em)
    {
        //recovery of details of the article
        $product = $em->getRepository(Products::class)
        ->find($request->get('id'));

        if ($product == null) {
            $message = 'désolé mais le produit demandé n\'existe pas';
            throw new NoFoundAppException($message);
        }

        //modification of the src attribute
        (new PictureSrc($request))->pictureSrc($product->getPictures());

        return $product;
    }
}
