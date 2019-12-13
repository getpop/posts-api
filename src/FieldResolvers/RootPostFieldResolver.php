<?php
namespace PoP\PostsAPI\FieldResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\API\TypeResolvers\RootTypeResolver;
use PoP\Posts\FieldResolvers\AbstractPostFieldResolver;

class RootPostFieldResolver extends AbstractPostFieldResolver
{
    use PostFieldResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(RootTypeResolver::class);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'post' => $translationAPI->__('Post with a specific ID', 'posts-api'),
			'posts' => $translationAPI->__('Posts in the current site', 'posts-api'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }
}
