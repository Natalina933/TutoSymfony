<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Recipe;

final class RecipeController extends AbstractController
{
    // On utilise l'EntityManager pour persister et supprimer des données
    // En utilisant Doctrine ORM, il est possible d'accéder à l'EntityManager via l'injecteur de dépendances $this->em
    /**
     * Affiche la liste des recettes qui prennent moins de 50 minutes à faire.
     *
     * @param Request $request
     * @param RecipeRepository $repository
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/recettes', name: 'recipe.index')]
    public function index(Request $request, RecipeRepository $repository, EntityManagerInterface $em): Response
    {
        $recipes = $repository->findAll();
        // dd($recipes);
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
    /**
     * Affiche une recette.
     *
     * Vérifie que le slug correspond à la recette demandée, sinon redirige vers l'URL correcte.
     * Si la recette n'est pas trouvée, redirige vers la page d'accueil.
     *
     * @param string $slug Slug de la recette
     * @param int $id Identifiant de la recette
     * @return Response
     */
    #[Route('/recettes/{slug}-{id}', name: 'recipe.show', requirements: ['slug' => '[a-z0-9\-]+', 'id' => '\d+'])]
    public function show(Request $request, string $slug, int $id, RecipeRepository $reposotory): Response
    {
        $recipe = $reposotory->find($id);
        // dd($recipe);
        if (!$recipe) {
            // Si la recette n'est pas trouvée, redirige vers la liste des recettes
            $this->addFlash('error', 'La recette demandée n\'existe pas.');
            return $this->redirectToRoute('recipe.index');
        }

        // Vérifie si le slug correspond à celui de la recette
        if ($recipe->getSlug() !== $slug) {
            // Si le slug ne correspond pas, redirige vers l'URL correcte
            return $this->redirectToRoute('recipe.show', [
                'slug' => $recipe->getSlug(),
                'id' => $recipe->getId()
            ], 301); // 301 est le code pour une redirection permanente
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe
        ]);
    }
}
