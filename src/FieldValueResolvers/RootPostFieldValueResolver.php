<?php
namespace PoP\PostsAPI\FieldValueResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\API\FieldResolvers\RootFieldResolver;
use PoP\Posts\FieldValueResolvers\AbstractPostFieldValueResolver;

class RootPostFieldValueResolver extends AbstractPostFieldValueResolver
{
    use PostFieldValueResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(RootFieldResolver::class);
    }

    public function getSchemaFieldDescription(FieldResolverInterface $fieldResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'post' => $translationAPI->__('ID of the post', 'posts-api'),
			'posts' => $translationAPI->__('IDs of the posts in the current site', 'posts-api'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($fieldResolver, $fieldName);
    }
}
