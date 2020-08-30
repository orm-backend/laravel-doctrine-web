<?php
namespace VVK\Web\Fields;

use Doctrine\ORM\Mapping\ClassMetadata;
use VVK\ORM\Entities\Entity;
use VVK\Utility\Helper;
use VVK\Utility\Str;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class ReferenceField extends MetaField
{
    
    /**
     * 
     * @var string
     */
    public $refClassUrlName;
    
    /**
     *
     * @var string
     */
    public $refClassAlias;

    /**
     *
     * @var string
     */
    public $valueName;
    
    /**
     * 
     * @param \Doctrine\ORM\Mapping\ClassMetadata $classMetadata
     * @param string $fieldName
     * @param \VVK\ORM\Entities\Entity $entity
     * @param int $index
     * @return \VVK\Web\Fields\MetaField
     */
    public static function getInstance(ClassMetadata $classMetadata, string $fieldName, Entity $entity = null, int $index = null)
    {
        $instance = parent::getInstance($classMetadata, $fieldName, $entity, $index);
        $associationMapping = $classMetadata->getAssociationMapping($fieldName);
        $instance->refClassUrlName = Helper::classToUrl($associationMapping['targetEntity']);
        $instance->refClassAlias = lcfirst((new \ReflectionClass($associationMapping['targetEntity']))->getShortName());
        
        if ($entity && array_search($fieldName, FieldContainer::FORBIDDEN_FIELDS) === false) {
            /**
             * 
             * @var \VVK\ORM\Entities\Entity $reference
             */
            $reference = $classMetadata->getFieldValue($entity, $fieldName);
            
            if ($reference) {
                $instance->value = $reference->getId();
                /**
                 * 
                 * @var \Doctrine\ORM\EntityManager $em
                 */
                $em = app('em');
                $refClassMetadata = $em->getClassMetadata($associationMapping['targetEntity']);
                
                if ($refClassMetadata->hasField('name')) {
                    $instance->valueName = Str::limit( $refClassMetadata->getFieldValue($reference, 'name'), 50 );
                } else if ($refClassMetadata->hasField('email')) {
                    $instance->valueName = $refClassMetadata->getFieldValue($reference, 'email');
                } else if ($refClassMetadata->hasField('phone')) {
                    $instance->valueName = $refClassMetadata->getFieldValue($reference, 'phone');
                } else {
                    $instance->valueName = $instance->value;
                }
            }
        }
        
        return $instance;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VVK\Web\Fields\MetaField::getHtmlType()
     */
    protected function getHtmlType()
    {
        return 'reference';
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \VVK\Web\Fields\MetaField::getDefaultSortable()
     */
    protected function getDefaultSortable()
    {
        return 'true';
    }

}
