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
 *   types = {"GenericUrl"}
 * )
 */
class PageTitle extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function resolveValues($value, array $args, ResolveInfo $info) {
    if ($value instanceof Url) {
      if ($value->isRouted() && $route = \Drupal::service('router.route_provider')->getRouteByName($value->getRouteName())) {
        $request = Request::create($value->toString());
        yield \Drupal::service('title_resolver')->getTitle($request, $route);
      }
      else {
        $content = (string) \Drupal::httpClient()
          ->get($value->toString())
          ->getBody();
        $doc = new \DOMDocument();
        $doc->loadHTML($content);
        $xpath = new \DOMXPath($doc);
        $title = $xpath->query('//title')->item(0)->textContent;
        yield (string) $title;
      }
    }
  }

}
