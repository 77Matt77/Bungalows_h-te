<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

// class LoginAuthenticator extends AbstractLoginFormAuthenticator
// {
//     use TargetPathTrait;

//     public const LOGIN_ROUTE = 'vers_authenticator_login';

//     public function __construct(private UrlGeneratorInterface $urlGenerator)
//     {
//         $this->urlGenerator = $urlGenerator;
//     }

//     public function authenticate(Request $request): Passport
//     {
//         $email = $request->request->get('email', '');

//         $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

//         return new Passport(
//             new UserBadge($email),
//             new PasswordCredentials($request->request->get('password', '')),
//             [
//                 new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
//                 new RememberMeBadge(),
//             ]
//         );
//     }

//     public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
//     {
//         if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
//             return new RedirectResponse($targetPath);
//         }
//         $user = $token->getUser();
//         $roles = $user->getRoles();

//         if (in_array('ROLE_ADMIN', $roles))
//         {
//             return new RedirectResponse($this->urlGenerator->generate('admin_home_index'));
//         }
//         if (in_array('ROLE_USER', $roles))
//         {
//             return new RedirectResponse($this->urlGenerator->generate('user_home_index'));
//         }
        
        
//     }

//     protected function getLoginUrl(Request $request): string
//     {
//         return $this->urlGenerator->generate(self::LOGIN_ROUTE);
//     }

//     public function onLogoutSuccess(Request $request): RedirectResponse
//     {
//         // Redirigez l'utilisateur vers la page d'accueil après la déconnexion
//         return new RedirectResponse($this->urlGenerator->generate('vers_accueil_index'));
//     }
    
// }







class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'vers_authenticator_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        $user = $token->getUser();
        if ($user instanceof UserInterface) {
            $roles = $user->getRoles();
            if (in_array('ROLE_ADMIN', $roles)) {
                return new RedirectResponse($this->urlGenerator->generate('admin_home_index'));
            } elseif (in_array('ROLE_USER', $roles)) {
                return new RedirectResponse($this->urlGenerator->generate('user_home_index'));
            }
        }
        // Renvoyer une réponse par défaut ici
        return new RedirectResponse($this->urlGenerator->generate('vers_accueil_index'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }

    public function onLogoutSuccess(Request $request): RedirectResponse
    {
        return new RedirectResponse($this->urlGenerator->generate('vers_accueil_index'));
    }
}




