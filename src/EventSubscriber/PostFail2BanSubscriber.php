<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 10/04/2020
 * Time: 05:50
 */

namespace App\EventSubscriber;


use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Predis\ClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;

class PostFail2BanSubscriber implements EventSubscriberInterface
{
    public const MAX_LOGIN_FAILURE_ATTEMPTS = 10;
    private const PRIORIY = 10;

    // @see https://symfony.com/doc/current/reference/configuration/security.html#check-path
    private const LOGIN_ROUTE = 'app_login'; // route page login html
    private const LOGIN_API_ROUTE = 'api_login_check'; //route page login api json

    private $router;
    private $logger;
    private $redis;

    public function __construct(RouterInterface $router, LoggerInterface $logger, ClientInterface $sncRedisDefault)
    {
        $this->router = $router;
        $this->logger = $logger;
        $this->redis = $sncRedisDefault;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['checkLoginBan', self::PRIORIY]
        ];
    }

    /**
     * The parameters type is "GetResponseEvent" before Symfony 5.
     * @param RequestEvent $event
     */
    public function checkLoginBan(RequestEvent $event): void
    {
        // Only post routes, first check is for typehint on $this->router
        $request = $event->getRequest();
        if (!$this->router instanceof Router || !$request->isMethod(Request::METHOD_POST)) {
            return;
        }

        $ip = $request->getClientIp() ?? '';
        $key = Fail2BanSubscriber::KEY_PREFIX.$ip;

        // Only for the login check route
        $route = $this->router->matchRequest($request)['_route'] ?? '';
        if (self::LOGIN_ROUTE !== $route and self::LOGIN_API_ROUTE !== $route) {
            return;
        }

        $this->maxFailureAttempts($ip, $key, $event);
    }

    public function maxFailureAttempts($ip, $key, RequestEvent $event)



    {
        if ((int) $this->redis->get($key) >= self::MAX_LOGIN_FAILURE_ATTEMPTS) {
            $this->logger->critical(sprintf('IP %s banned due to %d login attempts failures.',
                $ip, self::MAX_LOGIN_FAILURE_ATTEMPTS));

            $data = [
                'status'  => '429 TOO MANY REQUEST',
                'message' => 'desoler mais vous avez passé la limit de connection',
                'temps restant' => 'vous pourez réessayer dans '. $this->redis->ttl($key) .' secondes',
            ];

            $response = new JWTAuthenticationFailureResponse($data, JsonResponse::HTTP_TOO_MANY_REQUESTS);

            $event->setResponse($response);
        }
    }
}