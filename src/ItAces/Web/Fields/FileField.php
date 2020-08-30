<?php
namespace VVK\Web\Fields;

use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\Facades\Storage;
use VVK\ORM\Entities\Entity;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class FileField extends ReferenceField
{
    
    /**
     * 
     * @var string
     */
    public $url;
    
    /**
     *
     * @var string
     */
    public $path;
    
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
            /**
             * 
             * @var \VVK\Types\FileType $file
             */
            $file = $entity->{$fieldName};

            if ($file) {
                $instance->path = $file->getPath();
                $instance->url = Storage::url($instance->path);
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
        return 'file';
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \VVK\Web\Fields\MetaField::getDefaultSortable()
     */
    protected function getDefaultSortable()
    {
        return 'false';
    }

}
