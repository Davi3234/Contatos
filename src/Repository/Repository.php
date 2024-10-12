<?php

namespace Src\Repository;

use Exception;
use Src\Config\EntityManagerCreator;

/**
 * @template T
 */
abstract class Repository
{

    public function __construct(protected $entityManager = EntityManagerCreator::getInstance()->getEntityManager()) {}

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
