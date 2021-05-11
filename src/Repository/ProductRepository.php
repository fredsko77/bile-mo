<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findProductWithStock()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.stock > 0');
    }

    /**
     * @return Product[]
     */
    public function findAllAvailable(): array
    {
        return $this->findProductWithStock()
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param string $fullname
     * @return Product[] Returns an array of Product objects
     */
    public function findByFullname(string $fullname = ''): array
    {
        return $this->findProductWithStock()
            ->andWhere("CONCAT(p.name, ' ', p.brand) LIKE '%{$fullname}%'")
            ->orderBy('p.created_at', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $page
     * @param int $items_per_page
     *
     * @return Product[]
     */
    public function paginate(int $page = 0, int $items_per_page = 25): array
    {
        $starter = ($page * $items_per_page);

        return $this->findProductWithStock()
            ->orderBy('p.created_at', 'ASC')
            ->setFirstResult($starter)
            ->setMaxResults($items_per_page)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */

    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('p.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    // public function findOneBySomeField($value): ?Product
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
}
