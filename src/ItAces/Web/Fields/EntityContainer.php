<?php
namespace ItAces\Web\Fields;

use ItAces\ORM\Entities\Entity;
use ItAces\ORM\DevelopmentException;
use ItAces\Utility\Helper;

/**
 *
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class EntityContainer extends FieldContainer
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\Web\Fields\FieldContainer::addEntity()
     */
    public function addEntity(Entity $entity)
    {
        throw new DevelopmentException('Method unsupported. Use the addCollection method or the FieldContainer class instead.');
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\Web\Fields\FieldContainer::addCollection()
     */
    public function addCollection(array $data)
    {
        foreach ($data as $index => $entity) {
            $className = get_class($entity);
            $classMetadata = $this->em->getClassMetadata($className);
            $this->entities[$index] = $this->wrapEntity($classMetadata, $entity, $index);
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\Web\Fields\FieldContainer::readRequest()
     */
    public static function readRequest(array $request, array &$storedFiles = null) : array
    {
        $map = [];

        foreach ($request as $classUrlName => $data) {
            if (!is_array($data)) {
                continue;
            }
            
            $className = Helper::classFromUlr($classUrlName);
            
            if (!array_key_exists($className, $map)) {
                $map[$className] = [];
            }
            
            foreach ($data as $value) {
                $map[$className][] = self::readEntity($className, $value, $storedFiles);
            }
        }

        return $map;
    }
    
}
