<?php

namespace App\Controller\Menu;

use App\Entity\Menu\Allergens;
use App\Form\Menu\AllergensType;
use App\Repository\Menu\AllergensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/allergens')]
class AllergensController extends AbstractController
{
    #[Route('/', name: 'app_menu_allergens_index', methods: ['GET'])]
    public function index(AllergensRepository $allergensRepository): Response
    {
        return $this->render('menu/allergens/index.html.twig', [
            'allergens' => $allergensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_menu_allergens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AllergensRepository $allergensRepository): Response
    {
        $allergen = new Allergens();
        $form = $this->createForm(AllergensType::class, $allergen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allergensRepository->add($allergen, true);

            return $this->redirectToRoute('app_menu_allergens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/allergens/new.html.twig', [
            'allergen' => $allergen,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_menu_allergens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Allergens $allergen, AllergensRepository $allergensRepository): Response
    {
        $form = $this->createForm(AllergensType::class, $allergen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allergensRepository->add($allergen, true);

            return $this->redirectToRoute('app_menu_allergens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/allergens/edit.html.twig', [
            'allergen' => $allergen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_allergens_delete', methods: ['POST'])]
    public function delete(Request $request, Allergens $allergen, AllergensRepository $allergensRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allergen->getId(), $request->request->get('_token'))) {
            $allergensRepository->remove($allergen, true);
        }

        return $this->redirectToRoute('app_menu_allergens_index', [], Response::HTTP_SEE_OTHER);
    }
}
