<?php


namespace App\UI\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $user     = $this->em->getRepository(User::class)->findOneBy(['username'=>$username]);

        if ($user === null) {
            // user not found
            // throw exception or return error or however you handle it
        }

        if (! $this->encoder->isPasswordValid($user, $password)) {
            // invalid password
            // throw exception, or return error, or however you handle it
        }

//        $error = $authenticationUtils->getLastAuthenticationError();
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        return new JsonResponse(
//            ['last_username' => $lastUsername,
//            'error' => $error]
//        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}