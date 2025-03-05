<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class RecipeController extends AbstractController
{
    /**
     * Affiche la liste des recettes qui prennent moins de 50 minutes à faire.
     */
    #[Route('/recettes', name: 'recipe.index')]
    public function index(RecipeRepository $repository): Response
    {
        // Récupère les recettes qui prennent moins de 50 minutes à faire
        $recipes = $repository->findRecipesByDuration(50);
        // dd($repository->findTotalDuration());
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * Ajoute une nouvelle recette à la base de données.
     */
    #[Route('/recettes/ajouter', name: 'recipe.add')]
    public function add(EntityManagerInterface $em): Response
    {
        $recipe = new Recipe();
        $recipe->setTitle('Pizza');
        $recipe->setSlug('pizza');
        $recipe->setContent('Une pizza maison');
        $recipe->setDuration(30);
        $recipe->setCreatedAt(new \DateTimeImmutable());
        $recipe->setUpdatedAt(new \DateTimeImmutable());

        $em->persist($recipe);
        $em->flush();

        return $this->redirectToRoute('recipe.index');
    }

    /**
     * Supprime une recette de la base de données.
     */
    #[Route('/recettes/supprimer/{id}', name: 'recipe.delete')]
    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $recipe = $em->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException('Recette non trouvée');
        }

        $em->remove($recipe);
        $em->flush();

        return $this->redirectToRoute('recipe.index');
    }

    /**
     * Affiche une recette.
     */
    #[Route('/recettes/{slug}-{id}', name: 'recipe.show', requirements: ['slug' => '[a-z0-9\-]+', 'id' => '\d+'])]
    public function show(string $slug, int $id, RecipeRepository $repository): Response
    {
        $recipe = $repository->find($id);

        if (!$recipe) {
            $this->addFlash('error', 'La recette demandée n\'existe pas.');
            return $this->redirectToRoute('recipe.index');
        }

        if ($recipe->getSlug() !== $slug) {
            return $this->redirectToRoute('recipe.show', [
                'slug' => $recipe->getSlug(),
                'id' => $recipe->getId()
            ], 301);
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe
        ]);
    }
}
