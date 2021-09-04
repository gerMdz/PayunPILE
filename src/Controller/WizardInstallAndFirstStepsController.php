<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WizardInstallAndFirstStepsController extends AbstractController
{
    /**
     * @Route("/wizard/install/and/first/steps", name="wizard_install_and_first_steps")
     */
    public function index(): Response
    {
        return $this->render('wizard_install_and_first_steps/index.html.twig', [
            'controller_name' => 'WizardInstallAndFirstStepsController',
        ]);
    }
}
