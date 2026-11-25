<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController
{
    private const USERS = [
        'admin'  => 'admin',
        'user25' => '2025',
        'user56' => '2026',
    ];

    #[Route('/', name: 'app_inicio')]
    #[Route('/login', name: 'app_login')]
    public function login(Request $request, RequestStack $requestStack): Response
    {
        $session = $requestStack->getCurrentRequest()->getSession();

        if ($session->get('username') !== null) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $username = $data['username'];
            $password = $data['password'];

            if (isset(self::USERS[$username]) && self::USERS[$username] === $password) {
                $session->set('username', $username);

                return $this->redirectToRoute('app_home');
            }

            $form->addError(new FormError('Datos incorrectos.'));
        }

        return $this->render('login/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(RequestStack $requestStack): Response
    {
        $requestStack->getCurrentRequest()->getSession()->clear();

        $this->addFlash('info', 'Sesión cerrada correctamente.');

        return $this->redirectToRoute('app_login');
    }
}
