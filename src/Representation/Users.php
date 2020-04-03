<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/04/2020
 * Time: 11:13
 */

namespace App\Representation;


use JMS\Serializer\Annotation\Type;
use Pagerfanta\Pagerfanta;
use JMS\Serializer\Annotation as Serializer;

class Users
{
    /**
     * @Type("array<App\Entity\User>")
     * @Serializer\Groups("listUsers")
     */
    public $data;

    /**
     * @Serializer\Groups("listUsers")
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