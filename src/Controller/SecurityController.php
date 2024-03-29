<?php

namespace App\Controller;

use App\Entity\MetaBase;
use App\Entity\User;
use App\Form\Model\UserRegistrationFormModel;
use App\Form\Model\VoluntarioReservaRegistrationFormModel;
use App\Form\UserRegistrationFormType;
use App\Form\VoluntarioReservaRegistrationFormType;
use App\Repository\MetaBaseRepository;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private MetaBaseRepository $metaBaseRepository;

    /**
     * SecurityController constructor.
     * @param MetaBaseRepository $metaBaseRepository
     */
    public function __construct(MetaBaseRepository $metaBaseRepository)
    {
        $this->metaBaseRepository = $metaBaseRepository;
    }

    /**
     * @Route("/admin/ingreso", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $em = $this->getDoctrine()->getManager();
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );
    }

    /**
     * @Route("/admin/logout", name="app_logout")
     */
    public function logout()
    {
        throw new LogicException(
            'This method can be blank - it will be intercepted by the logout key on your firewall.'
        );
    }

    /**
     * @Route("/admin/registro", name="app_registro")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $authenticatorHandler
     * @param LoginFormAuthenticator $formAuthenticator
     * @return Response
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $authenticatorHandler,
        LoginFormAuthenticator $formAuthenticator
    ) {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UserRegistrationFormModel $userModel */
            $userModel = $form->getData();
            $user = new User();
            $user->setEmail($userModel->email);
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $userModel->plainPassword)
            );
            $user->setRoles(['ROLE_USER']);
            if ($form['roles']->getData()) {
                $user->setRoles([$form['roles']->getData()]);
            }
            $user->setRoles(['ROLE_USER']);
            $user->setPrimerNombre($userModel->primerNombre);
            if (true === $userModel->aceptaTerminos) {
                $user->aceptaTerminos();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $authenticatorHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );

        }


//        if ($request->isMethod('POST')) {
//            $user = new User();
//            $user->setEmail($request->request->get('email'));
//            $user->setPrimerNombre($request->request->get('primernombre'));
//            $user->setPassword($passwordEncoder->encodePassword(
//                $user,
//                $request->request->get('password')
//            ));
//            $user->setRoles(['ROLE_USER']);
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//
//            return $authenticatorHandler->authenticateUserAndHandleSuccess(
//                $user,
//                $request,
//                $formAuthenticator,
//                'main'
//            );
//        }

        return $this->render(
            'security/register.html.twig',
            [
                'regristroForm' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/admin/registro_voluntario_reserva", name="app_registro_voluntario_reserva")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $userRepository
     * @param MetaBaseRepository $metaBaseRepository
     * @return Response
     */
    public function registerVoluntarioReserva(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        MetaBaseRepository $metaBaseRepository
    ): Response {

        $form = $this->createForm(VoluntarioReservaRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var VoluntarioReservaRegistrationFormModel $userModel */
            $userModel = $form->getData();
            $user = new User();
            $email = strtolower($userModel->primerNombre).'@'.$this->getDomain();
            $isUser = $userRepository->findBy(['email' => $email]);
            if ($isUser) {
                $this->addFlash('success', sprintf('El usuario %s ya existe', $user->getEmail()));

                return $this->redirectToRoute('app_registro_voluntario_reserva');
            }
            $user->setEmail($email);
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $this->getDomain().'!')
            );
            $user->setRoles(['ROLE_USER']);

            $user->setRoles(['ROLE_RESERVA']);
            $user->setPrimerNombre($userModel->primerNombre);

            $user->aceptaTerminos();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Se agregó correctamente al usuario '.$user->getEmail());

            return $this->redirectToRoute('app_registro_voluntario_reserva');

        }


        return $this->render(
            'security/registerVoluntarioReserva.html.twig',
            [
                'regristroForm' => $form->createView(),
            ]
        );
    }


    /**
     * @return mixed|string|null
     */
    private function getDomain()
    {
        /** @var MetaBase $meta_correo */
        $meta_correo = $this->metaBaseRepository->findOneBy(['base' => 'index']);

        if (filter_var($meta_correo->getEmailBase(), FILTER_VALIDATE_EMAIL)) {
            // split on @ and return last value of array (the domain)
            $array = explode('@', (string)$meta_correo->getEmailBase());
            return array_pop($array);
        }

        return '@sitio.com';
    }
}
