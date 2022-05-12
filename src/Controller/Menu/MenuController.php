<?php

namespace App\Controller\Menu;

use App\Entity\Menu\Menu;
use App\Form\Menu\MenuType;
use App\Repository\Menu\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/admin/food', name: 'app_menu_menu_index', methods: ['GET'])]
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('menu/menu/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

    #[Route('/admin/food/new', name: 'app_menu_menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MenuRepository $menuRepository): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuRepository->add($menu, true);

            return $this->redirectToRoute('app_menu_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

//    #[Route('/{id}', name: 'app_menu_menu_show', methods: ['GET'])]
//    public function show(Menu $menu): Response
//    {
//        return $this->render('menu/menu/show.html.twig', [
//            'menu' => $menu,
//        ]);
//    }

    #[Route('/admin/food/edit/{id}', name: 'app_menu_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Menu $menu, MenuRepository $menuRepository): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuRepository->add($menu, true);

            return $this->redirectToRoute('app_menu_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }
}
