<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * LivreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LivreRepository extends EntityRepository
{
    public function FindById($id)
    {
        $queryBuilder = $this->createQueryBuilder('l');
        $queryBuilder->where('l.id = :id')
            ->setParameter('id',$id);
        return $queryBuilder;
    }
}
