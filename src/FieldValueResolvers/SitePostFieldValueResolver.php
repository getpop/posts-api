<?php
namespace PoP\PostsAPI\FieldValueResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Engine\FieldValueResolvers\SiteFieldValueResolverTrait;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\API\FieldResolver_Sites;
use PoP\Posts\FieldValueResolvers\AbstractPostFieldValueResolver;

class SitePostFieldValueResolver extends AbstractPostFieldValueResolver
{
    use PostFieldValueResolverTrait, SiteFieldValueResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(FieldResolver_Sites::class);
    }

    public function getSchemaFieldDescription(FieldResolverInterface $fieldResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'post' => $translationAPI->__('ID of the post', 'posts-api'),
			'posts' => $translationAPI->__('IDs of the posts in the site', 'posts-api'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($fieldResolver, $fieldName);
    }
}
