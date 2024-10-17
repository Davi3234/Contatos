<?php

namespace Src\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use Exception;
use Src\Config\EntityManagerCreator;

/**
 * @template T
 */
abstract class Repository
{

    protected $entityManager;
    protected $qb;

    public function __construct() {
        $this->entityManager = EntityManagerCreator::getInstance()->getEntityManager();
        $this->qb = new QueryBuilder($this->entityManager->getConnection());
    }

    /**
     * Inserindo dado
     * @param T $entity
     * @return void
     * @throws Exception
     */
    public function insert($entity): void
    {
        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir " . get_class($entity) . ": " . $e->getMessage());
        }
    }

    /**
     * Atualizando dado
     * @param T $entity
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function update($entity): void
    {
        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar " . get_class($entity) . ": " . $e->getMessage());
        }
    }

    /**
     * Removendo dado
     * @param T $entity
     * @return void
     * @throws Exception
     */
    public function delete($entity): void
    {
        try {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar " . get_class($entity) . ": " . $e->getMessage());
        }
    }

    /**
     * Buscando todos os registros
     * @return array<T>
     */
    public function searchAll(): array
    {
        return $this->entityManager->getRepository($this->getEntityClass())->findAll();
    }

    /**
     * Buscando todos os registros pela condição
     * @return array<T>
     */
    public function searchAllByCondicao(): array
    {
        return $this->entityManager->createQuery($this->qb->getSQL())->setParameters($this->qb->getParameters())->getResult();
    }

    /**
     * Constroi a query com condições
     * @param array $args
     * @return void
     */
    public function buildQuery(array $args): void {
        $this->qb->select('t')
            ->from($this->getEntityClass(), 't');
    
        foreach ($args as $column => $value) {
            if($value != ""){
                $this->qb->andWhere("t.{$column} = :{$column}");
                $this->qb->setParameter($column, $value);
            }
        }
    }

    /**
     * Buscando por ID
     * @param int $id
     * @return T|null
     */
    public function searchById(int $id)
    {
        return $this->entityManager->getRepository($this->getEntityClass())->find($id);
    }

    /**
     * Método abstrato que deve retornar o nome da classe da entidade
     * @return string
     */
    abstract protected function getEntityClass(): string;
}
