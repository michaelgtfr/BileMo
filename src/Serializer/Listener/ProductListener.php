<?php
/**
 * User: michaelgt
 * Date: 23/02/2020
 */

namespace App\Serializer\Listener;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\Metadata\StaticPropertyMetadata;

class ProductListener implements EventSubscriberInterface
{
    /**
     * allows to add information after serialization
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => Events::POST_SERIALIZE,
                'format' => 'json',
                'class' => 'App\Entity\Products',
                'method' => 'onPostSerialize',
            ]
        ];
    }

    public static function onPostSerialize(ObjectEvent $event)
    {
        $date = new \Datetime();
        // Possibility to modify the table after serialization
        $event->getVisitor()->visitProperty(new StaticPropertyMetadata (
            '', 'delivered_at', null), $date->format('l jS \of F Y h:i:s A')
        );
    }
}
