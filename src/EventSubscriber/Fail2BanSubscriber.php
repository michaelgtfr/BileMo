<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/04/2020
 * Time: 05:44
 */

namespace App\EventSubscriber;


use Predis\ClientInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\AuthenticationEvents;

class Fail2BanSubscriber implements EventSubscriberInterface
{
    public const KEY_PREFIX = 'login_failures_';
    public const FAIL_TTL_HOUR = 0.1; //cache expiration in hours

    protected $redis;
    protected $requestStack;

    public function __construct(RequestStack $requestStack, ClientInterface $sncRedisDefault)
    {
        $this->redis = $sncRedisDefault;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onAuthenticationFailure',
        ];
    }

    private function getRequest(): Request
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request instanceof Request) {
            throw new \RuntimeException('No request.');
        }

        return $request;
    }

    /**
     * Client IP shouldn't be empty but better to test. We don't need the event as we
     * don't use the username that caused the failure. If you want it, pass the
     * argument "AuthenticationFailureEvent" to this function like below.
     */
    public function onAuthenticationFailure(/*AuthenticationFailureEvent $authenticationFailureEvent*/): void
    {
        $ip = $this->getRequest()->getClientIp();
        if (!$ip) {
            return;
        }

        $key = self::KEY_PREFIX.$ip;
        $this->redis->incr($key); // increment the failed login counter for this ip
        $this->redis->expire($key, self::FAIL_TTL_HOUR*3600); // refresh the cache key TTL
    }
}