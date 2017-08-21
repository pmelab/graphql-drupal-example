<?php

namespace Drupal\graphql_example\Plugin\GraphQL\Interfaces;

use Drupal\Core\Url;
use Drupal\graphql_core\Annotation\GraphQLInterface;
use Drupal\graphql_core\GraphQL\InterfacePluginBase;

/**
 * Common interface for internal and external Urls.
 *
 * For simplicity reasons, this example does not utilize dependency injection.
 *
 * @GraphQLInterface(
 *   id = "generic_url",
 *   name = "GenericUrl"
 * )
 */
class GenericUrl extends InterfacePluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveType($object) {
    if ($object instanceof Url) {
      /** @var \Drupal\graphql_core\GraphQLSchemaManagerInterface $schemaManager */
      $schemaManager = \Drupal::service('graphql_core.schema_manager');
      if ($object->isExternal()) {
        return $schemaManager->findByName('ExternalUrl', [
          GRAPHQL_CORE_TYPE_PLUGIN,
        ]);
      }
      else {
        return $schemaManager->findByName('Url', [
          GRAPHQL_CORE_TYPE_PLUGIN,
        ]);
      }
    }
  }

}
