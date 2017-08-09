<?php

namespace Drupal\graphql_example\Plugin\GraphQL\Fields;

use Drupal\Core\Url;
use Drupal\graphql_core\GraphQL\FieldPluginBase;
use Symfony\Component\HttpFoundation\Request;
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
 *   multi = false,
 *   types = {"Url"}
 * )
 */
class PageTitle extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function resolveValues($value, array $args, ResolveInfo $info) {
    if ($value instanceof Url) {
      if ($route = \Drupal::service('router.route_provider')->getRouteByName($value->getRouteName())) {
        $request = Request::create($value->toString());
        yield \Drupal::service('title_resolver')->getTitle($request, $route);
      }
    }
  }

}
