<?php

namespace App\Repository;

use App\Entity\Playlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Playlist>
 */
class PlaylistRepository extends ServiceEntityRepository
{
    /**
     * 
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playlist::class);
    }

    /**
     * 
     * @param Playlist $entity
     * @param bool $flush
     * @return void
     */
    public function add(Playlist $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * 
     * @param Playlist $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Playlist $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * Retourne toutes les playlists triées sur le nom de la playlist
     * @param string $ordre
     * @return Playlist[]
     */
    public function findAllOrderByName(string $ordre): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.formations', 'f')
            ->groupBy('p.id')
            ->orderBy('p.name', $ordre)
            ->getQuery()
            ->getResult();
    }

    /**
     * Enregistrements dont un champ contient une valeur
     * ou tous les enregistrements si la valeur est vide
     * @param string $champ
     * @param string $valeur
     * @param string $table si $champ dans une autre table
     * @return Playlist[]
     */
    public function findByContainValue(string $champ, string $valeur, string $table = ""): array
    {
        if ($valeur === "") {
            return $this->findAllOrderByName('ASC');
        }

        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.formations', 'f');

        if ($table === "") {
            $qb->where('p.' . $champ . ' LIKE :valeur')
                ->setParameter('valeur', '%' . $valeur . '%');
        } else {
            $qb->leftJoin('f.categories', 'c')
                ->where('c.' . $champ . ' LIKE :valeur')
                ->setParameter('valeur', '%' . $valeur . '%');
        }

        return $qb->groupBy('p.id')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function countByPlaylist(int $playlistId): int
{
    return $this->createQueryBuilder('f')
        ->select('count(f.id)')
        ->where('f.playlist = :playlistId')
        ->setParameter('playlistId', $playlistId)
        ->getQuery()
        ->getSingleScalarResult();
}

}
