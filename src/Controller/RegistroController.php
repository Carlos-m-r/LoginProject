<?php

namespace App\Controller;

use App\Form\RegistroType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function registro(Request $request): Response
    {
        $form = $this->createForm(RegistroType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Usuario registrado correctamente. Ya puedes iniciar sesión.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registro/index.html.twig', [
            'form' => $form,
        ]);
    }
}
