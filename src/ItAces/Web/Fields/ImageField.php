<?php
namespace ItAces\Web\Fields;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class ImageField extends FileField
{
    
    /**
     *
     * {@inheritDoc}
     * @see \ItAces\Web\Fields\MetaField::getHtmlType()
     */
    protected function getHtmlType()
    {
        return 'image';
    }

}
