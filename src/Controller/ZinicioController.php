<?php

namespace App\Controller;

use App\Repository\MetaBaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
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
     * @param MetaBaseRepository $repository
     * @return RedirectResponse
     */
    public function index(MetaBaseRepository $repository): RedirectResponse
    {
        $base = $repository->findOneBy([]);

        if(!$base){
            return $this->redirectToRoute('not_metabase');
        }

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

    /**
     * @Route("/metabase", name="not_metabase")
     */
    public function metabase(): Response
    {

        return $this->render('meta_base/noindex.html.twig', [

        ]);
    }

    /**
     * @Route("/admin", name="admin_ingreso")
     */
    public function admin(): Response
    {

        return $this->redirectToRoute('admin_panel');
    }

}
