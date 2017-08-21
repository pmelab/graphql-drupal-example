<?php

namespace Drupal\graphql_example\Plugin\GraphQL\Types;


use Drupal\graphql_core\Annotation\GraphQLType;
use Drupal\graphql_core\GraphQL\TypePluginBase;

/**
 * GraphQL Type for external urls.
 *
 * @GraphQLType(
 *   id = "external_url",
 *   name = "ExternalUrl",
 *   interfaces = {"GenericUrl"}
 * )
 */
class ExternalUrl extends TypePluginBase {

}