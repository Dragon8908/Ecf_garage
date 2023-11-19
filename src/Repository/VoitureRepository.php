<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Data\FiltreData;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function save(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSearch(FiltreData $search): array
    {
        $query = $this->getSearchQuery($search)->getQuery();

        return $query->getResult();
    }

    /**
     *
     * @param FiltreData $search
     * @return integer[]
     */
    public function findMinMax(FiltreData $search): array
    {
        $results = $this->getSearchQuery($search, true, true)
            ->select('MIN(cars.prix) as prixmin', 'MAX(cars.prix) as prixmax',
                     'MIN(cars.km) as kmmin', 'MAX(cars.km) as kmmax', 
                     'MIN(cars.annee) as anneemin', 'MAX(cars.annee) as anneemax')

            ->getQuery()
            ->getScalarResult();

        return [
            $results[0]['prixmin'] ?: 0,
            $results[0]['prixmax'] ?: 0,
            $results[0]['kmmin'] ?: 0,
            $results[0]['kmmax'] ?: 0,
            $results[0]['anneemin'] ?: 0,
            $results[0]['anneemax'] ?: 0,
        ];
    }
    
    /**
     *
     * @param FiltreData $search
     * @param bool $ignorePrice
     * @param bool $ignoreKm
     *  @param bool $ignoreYear
     * @return QueryBuilder
     */
    private function getSearchQuery(FiltreData $search, $ignorePrice = false, $ignoreKm = false, $ignoreYear = false): QueryBuilder
    {
        $qb = $this->createQueryBuilder('cars');
    
        if (!empty($search->prixmin) && !$ignorePrice) {
            $qb = $qb
                ->andWhere('cars.prix >= :prixmin')
                ->setParameter('prixmin', $search->prixmin);
        }
    
        if (!empty($search->prixmax) && !$ignorePrice) {
            $qb = $qb
                ->andWhere('cars.prix <= :prixmax')
                ->setParameter('prixmax', $search->prixmax);
        }
        if (!empty($search->kmmin) && !$ignoreKm) {
            $qb = $qb
                ->andWhere('cars.km >= :kmmin')
                ->setParameter('kmmin', $search->kmmin);
        }
    
        if (!empty($search->kmmax) && !$ignoreKm) {
            $qb = $qb
                ->andWhere('cars.km <= :kmmax')
                ->setParameter('kmmax', $search->kmmax);
        }
        
        if (!empty($search->anneemin) && !$ignoreYear) {
            $qb = $qb
                ->andWhere('cars.annee >= :anneemin')
                ->setParameter('anneemin', $search->anneemin);
        }
    
        if (!empty($search->anneemax) && !$ignoreYear) {
            $qb = $qb
                ->andWhere('cars.annee <= :anneemax')
                ->setParameter('anneemax', $search->anneemax);
        }
        return $qb;
    }
}
