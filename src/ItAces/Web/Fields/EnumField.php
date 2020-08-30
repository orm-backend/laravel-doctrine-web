<?php
namespace VVK\Web\Fields;

use Doctrine\ORM\Mapping\ClassMetadata;
use VVK\ORM\Entities\Entity;
use VVK\Utility\Str;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class EnumField extends MetaField
{
    /**
     * 
     * @var array
     */
    public $options = [];
    
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
        
        if ($entity && array_search($fieldName, FieldContainer::FORBIDDEN_FIELDS) === false) {
            $instance->value = $classMetadata->getFieldValue($entity, $instance->name);
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
        return 'radio';
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

    public function initOptions(string $enumType)
    {
        $names = (new $enumType)->getAllowedValues();
        
        foreach ($names as $name) {
            $this->options[$name] = Str::pluralCamelWords(ucfirst($name), 1);
        }
    }
    
}
