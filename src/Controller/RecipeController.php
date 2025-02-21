<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeController extends AbstractController
{
    #[Route('/recettes', name: 'recipe.index')]
    public function index(Request $request, RecipeRepository $repository): Response
    {
        $recipes = $repository->findAll();
        // dd($recipes);
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
    #[Route('/recettes/{slug}-{id}', name: 'recipe.show', requirements: ['slug' => '[a-z0-9\-]+', 'id' => '\d+'])]
    public function show(Request $request, string $slug, int $id, RecipeRepository $reposotory): Response
    {
        $recipe = $reposotory->find($id);
        // dd($recipe);
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'slug' => $slug,
            'id' => $id,
            'name' => '<strong>Recette ' . $slug . '</strong>',
            'person' => [
                'firstname' => 'John',
                'lastname' => 'Doe',

            ]
        ]);
    }
}
