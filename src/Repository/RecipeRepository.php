<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @return Recipe[] Retourne un tableau pour récupérer une liste d'objets de recette basés sur un ingrédient
     */
    // public function findRecipesByIngredient($ingredient): array
    // {
    //     return $this->createQueryBuilder('r')
    //         ->join('r.ingredients', 'i')
    //         ->andWhere('i.name = :ingredient')
    //         ->setParameter('ingredient', $ingredient)
    //         ->orderBy('r.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    /**
     * @param mixed $id
     * @return Recipe|null Retourne une recette basée sur son identifiant
     */
    public function findRecipeById($id): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    /**
     * @return Recipe[] Retourne un tableau pour récupérer une liste d'objets de recette basés sur la durée
     */
    public function findRecipesByDuration(int $duration): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.duration <= :duration')
            ->setParameter('duration', $duration)
            ->orderBy('r.duration', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findTotalDuration(): int
    {
        return $this->createQueryBuilder('r')
            ->select('SUM(r.duration) as totalDuration')
            ->getQuery()
            ->getsingleScalarResult()
        ;
    }
}
