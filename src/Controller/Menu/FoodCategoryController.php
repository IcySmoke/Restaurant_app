<?php

namespace App\Controller\Menu;

use App\Entity\Menu\FoodCategory;
use App\Form\Menu\FoodCategoryType;
use App\Repository\Menu\FoodCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodCategoryController extends AbstractController
{
    #[Route('/admin/menu/food/category', name: 'app_menu_food_category_index', methods: ['GET'])]
    public function index(FoodCategoryRepository $foodCategoryRepository): Response
    {
        return $this->render('menu/food_category/index.html.twig', [
            'food_categories' => $foodCategoryRepository->findAll(),
        ]);
    }

    #[Route('/admin/menu/food/category/new', name: 'app_menu_food_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FoodCategoryRepository $foodCategoryRepository): Response
    {
        $foodCategory = new FoodCategory();
        $form = $this->createForm(FoodCategoryType::class, $foodCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodCategoryRepository->add($foodCategory, true);

            return $this->redirectToRoute('app_menu_food_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/food_category/new.html.twig', [
            'food_category' => $foodCategory,
            'form' => $form,
        ]);
    }

//    #[Route('/{id}', name: 'app_menu_food_category_show', methods: ['GET'])]
//    public function show(FoodCategory $foodCategory): Response
//    {
//        return $this->render('menu/food_category/show.html.twig', [
//            'food_category' => $foodCategory,
//        ]);
//    }

    #[Route('/admin/menu/food/category/edit/{id}', name: 'app_menu_food_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FoodCategory $foodCategory, FoodCategoryRepository $foodCategoryRepository): Response
    {
        $form = $this->createForm(FoodCategoryType::class, $foodCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodCategoryRepository->add($foodCategory, true);

            return $this->redirectToRoute('app_menu_food_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/food_category/edit.html.twig', [
            'food_category' => $foodCategory,
            'form' => $form,
        ]);
    }
}
