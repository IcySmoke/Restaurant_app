<?php

namespace App\Controller\Menu;

use App\Entity\Menu\Allergen;
use App\Form\Menu\AllergenType;
use App\Repository\Menu\AllergenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/allergen')]
class AllergenController extends AbstractController
{
    #[Route('/', name: 'app_menu_allergen_index', methods: ['GET'])]
    public function index(AllergenRepository $allergenRepository): Response
    {
        return $this->render('menu/allergen/index.html.twig', [
            'allergens' => $allergenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_menu_allergen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AllergenRepository $allergenRepository): Response
    {
        $allergen = new Allergen();
        $form = $this->createForm(AllergenType::class, $allergen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allergenRepository->add($allergen, true);

            return $this->redirectToRoute('app_menu_allergen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/allergen/new.html.twig', [
            'allergen' => $allergen,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_menu_allergen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Allergen $allergen, AllergenRepository $allergenRepository): Response
    {
        $form = $this->createForm(AllergenType::class, $allergen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allergenRepository->add($allergen, true);

            return $this->redirectToRoute('app_menu_allergen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/allergen/edit.html.twig', [
            'allergen' => $allergen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_allergen_delete', methods: ['POST'])]
    public function delete(Request $request, Allergen $allergen, AllergenRepository $allergenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allergen->getId(), $request->request->get('_token'))) {
            $allergenRepository->remove($allergen, true);
        }

        return $this->redirectToRoute('app_menu_allergen_index', [], Response::HTTP_SEE_OTHER);
    }
}
