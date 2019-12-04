<?php
namespace PoP\PostsAPI\FieldValueResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Engine\FieldValueResolvers\SiteFieldValueResolverTrait;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\API\TypeResolvers\SiteTypeResolver;
use PoP\Posts\FieldValueResolvers\AbstractPostFieldValueResolver;

class SitePostFieldValueResolver extends AbstractPostFieldValueResolver
{
    use PostFieldValueResolverTrait, SiteFieldValueResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(SiteTypeResolver::class);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'post' => $translationAPI->__('ID of the post', 'posts-api'),
			'posts' => $translationAPI->__('IDs of the posts in the site', 'posts-api'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }
}
