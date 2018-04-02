<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 12/12/2017
 * Time: 14:55
 */

namespace AppBundle\Security;

use AppBundle\Entity\User;
use CoreBundle\Api\ApiProblem;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class JwtTokenAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var JWTEncoderInterface
     */
    private $jwtEncoder;

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(JWTEncoderInterface $jwtEncoder, EntityManagerInterface $em)
    {

        $this->jwtEncoder = $jwtEncoder;
        $this->em = $em;
    }

    /**
     * @inheritdoc
     */
    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationHeaderTokenExtractor(
            'Bearer',
            'Authorization'
        );

        $token = $extractor->extract($request);

        if (!$token) {
            return null;
        }

        return $token;
    }

    /**
     * @inheritdoc
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            $data = $this->jwtEncoder->decode($credentials);
        } catch (JWTDecodeFailureException $e) {
            throw new CustomUserMessageAuthenticationException('Invalid Token');
        }

        $email = $data['username'];

        return $this->em
            ->getRepository(User::class)
            ->findOneBy(array(
                'email' => $email,
                'verified' => true,
            ));
    }

    /**
     * @inheritdoc
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $apiProblem = new ApiProblem(401);
        // you could translate this
        $apiProblem->set('detail', $exception->getMessageKey());
        return new JsonResponse($apiProblem->toArray(), 401);
    }

    /**
     * @inheritdoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // Do nothing
    }

    /**
     * @inheritdoc
     */
    public function supportsRememberMe()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $apiProblem = new ApiProblem(401);
        // you could translate this
        $message = $authException ? $authException->getMessageKey() : 'Missing credentials';
        $apiProblem->set('detail', $message);
        return new JsonResponse($apiProblem->toArray(), 401);
    }
}