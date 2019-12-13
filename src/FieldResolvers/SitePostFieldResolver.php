<?php
namespace PoP\PostsAPI\FieldResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Engine\FieldResolvers\SiteFieldResolverTrait;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\API\TypeResolvers\SiteTypeResolver;
use PoP\Posts\FieldResolvers\AbstractPostFieldResolver;

class SitePostFieldResolver extends AbstractPostFieldResolver
{
    use PostFieldResolverTrait, SiteFieldResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(SiteTypeResolver::class);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'post' => $translationAPI->__('Post with a specific ID', 'posts-api'),
			'posts' => $translationAPI->__('Posts in the site', 'posts-api'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }
}
