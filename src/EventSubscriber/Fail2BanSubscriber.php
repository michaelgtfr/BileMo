<?php
/**
 * User: michaelgt
 * Date: 10/04/2020
 */

namespace App\EventSubscriber;

use Predis\ClientInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\AuthenticationEvents;

/**
 * provides protection against brute force attacks using the redis cache
 * retrieve or create a variable (key/value) in the cache and increments it if an authentication fails.
 *
 * Class Fail2BanSubscriber
 * @package App\EventSubscriber
 */
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

    public function onAuthenticationFailure(): void
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
