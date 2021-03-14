<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ZinicioController extends AbstractController
{
    /**
     * @var bool
     */
    private $site_temporal;

    /**
     * ZinicioController constructor.
     * @param string $site_temporal
     */
    public function __construct(string $site_temporal)
    {
        $this->site_temporal = $site_temporal;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        /** @var IndexAlameda $indexAlameda */
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();

        return $this->redirectToRoute('reserva_index');

    }

    /**
     * @Route("/ingreso", name="app_ingreso")
     * @param AuthenticationUtils $authenticationUtils
     * @return RedirectResponse
     */
    public function ingreso(AuthenticationUtils $authenticationUtils): RedirectResponse
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/reserva", name="app_reserva")
     * @return RedirectResponse
     */
    public function app_reserva(): RedirectResponse
    {
        return $this->redirectToRoute('reserva_index');
    }







}
