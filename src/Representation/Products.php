<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/03/2020
 * Time: 17:13
 */

namespace App\Representation;

use JMS\Serializer\Annotation\Type;
use Pagerfanta\Pagerfanta;
use JMS\Serializer\Annotation as Serializer;

class Products
{
    /**
     * @Type("array<App\Entity\Products>")m
     * @Serializer\Groups("list")
     */
    public $data;

    /**
     * @Serializer\Groups("list")
     */
    public $meta;

    public function __construct(Pagerfanta $data)
    {
        $this->data = $data->getCurrentPageResults();

        $this->addMeta('limit', $data->getMaxPerPage());
        $this->addMeta('current_items', count($data->getCurrentPageResults()));
        $this->addMeta('total_items', $data->getNbResults());
        $this->addMeta('offset', $data->getCurrentPageOffsetStart());
    }

    public function addMeta($name, $value)
    {
        if (isset($this->meta[$name])) {
            throw new \LogicException(sprintf('This meta already exists. You are trying to override this meta, use the setMeta method instead for the %s meta.', $name));
        }

        $this->setMeta($name, $value);
    }

    public function setMeta($name, $value)
    {
        $this->meta[$name] = $value;
    }
}