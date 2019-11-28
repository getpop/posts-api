<?php
namespace PoP\PostsAPI\FieldValueResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldValueResolvers\AbstractDBDataFieldValueResolver;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\Posts\FieldResolvers\PostFieldResolver;

class PostFieldValueResolver extends AbstractDBDataFieldValueResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(PostFieldResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'endpoint',
        ];
    }

    public function getSchemaFieldType(FieldResolverInterface $fieldResolver, string $fieldName): ?string
    {
        $types = [
            'endpoint' => SchemaDefinition::TYPE_URL,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($fieldResolver, $fieldName);
    }

    public function getSchemaFieldDescription(FieldResolverInterface $fieldResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
            'endpoint' => $translationAPI->__('Endpoint to fetch the post\'s data', 'pop-posts'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($fieldResolver, $fieldName);
    }

    public function resolveValue(FieldResolverInterface $fieldResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        switch ($fieldName) {
            case 'endpoint':
                return \PoP\API\APIUtils::getEndpoint($fieldResolver->resolveValue($resultItem, 'url', $variables, $expressions, $options));
        }

        return parent::resolveValue($fieldResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
