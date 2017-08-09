<?php

namespace Drupal\graphql_example\Plugin\GraphQL\Fields;

use Drupal\graphql_core\GraphQL\FieldPluginBase;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Youshido\GraphQL\Execution\ResolveInfo;

/**
 * A simple field that returns the page title.
 *
 * For simplicity reasons, this example does not utilize dependency injection.
 *
 * @GraphQLField(
 *   id = "page_title",
 *   type = "String",
 *   name = "pageTitle",
 *   nullable = true,
 *   multi = false
 * )
 */
class PageTitle extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function resolveValues($value, array $args, ResolveInfo $info) {
    // Get the current Druapl request.
    $request = \Drupal::request();

    // Get the request route.
    if ($route = $request->attributes->get(RouteObjectInterface::ROUTE_OBJECT)) {

      // If there is a route, yield the generated title.
      yield \Drupal::service('title_resolver')->getTitle($request, $route);
    }
  }

}
