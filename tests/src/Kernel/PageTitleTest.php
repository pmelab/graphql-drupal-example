<?php

namespace Drupal\Tests\graphql_example\Kernel;

use Drupal\Tests\graphql_core\Kernel\GraphQLFileTestBase;

/**
 * Test the PageTitle field.
 */
class PageTitleTest extends GraphQLFileTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'graphql_example',
  ];

  /**
   * Test page title queries.
   */
  public function testPageTitle() {
    $result = $this->executeQueryFile('page_title.gql', [
      'path' => '/user/login',
    ]);

    $this->assertEquals([
      'data' => [
        'route' => [
          'pageTitle' => 'Log in',
        ],
      ],
    ], $result, 'Query returns the correct page title');
  }

}
