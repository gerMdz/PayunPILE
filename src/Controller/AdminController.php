<?php

namespace App\Controller;

use App\Repository\MetaBaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/panel", name="admin_panel")
     * @param MetaBaseRepository $metaBaseRepository
     * @return Response
     */
    public function index(MetaBaseRepository $metaBaseRepository): Response
    {
            return $this->render('admin/index.html.twig', [
                'meta_bases' => $metaBaseRepository->findAll(),
            ]);
    }
}
