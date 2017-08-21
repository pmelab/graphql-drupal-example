<?php

namespace Drupal\graphql_example\Plugin\GraphQL\Fields;

use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Url;
use Youshido\GraphQL\Execution\ResolveInfo;
use Drupal\graphql_core\Plugin\GraphQL\Fields\Route;

/**
 * Retrieve a url object based on an internal path or external url.
 *
 * @GraphQLField(
 *   id = "example_url_route",
 *   name = "route",
 *   type = "GenericUrl",
 *   nullable = true,
 *   arguments = {
 *     "path" = "String"
 *   },
 *   weight = 1
 * )
 */
class ExampleRoute extends Route {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveInfo $info) {
    if (UrlHelper::isExternal($args['path'])) {
      yield Url::fromUri($args['path']);
    }
    else {
      foreach (parent::resolveValues($value, $args, $info) as $item) {
        yield $item;
      }
    }
  }

}
