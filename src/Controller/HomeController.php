<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(RequestStack $requestStack): Response
    {
        $username = $requestStack->getCurrentRequest()->getSession()->get('username');

        if ($username === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/index.html.twig', [
            'username' => $username,
        ]);
    }
}
