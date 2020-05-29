<?php
namespace ItAces\Web\Fields;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class ImageCollectionField extends FileCollectionField
{
    
    protected function getHtmlType()
    {
        return 'image_collection';
    }
}
