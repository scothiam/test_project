<?php

namespace Drupal\o2e_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\o2e_test\Service\StringFormatter;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 */
class O2eTestController extends ControllerBase
{

  /**
   * @var StringFormatter
   */
  private StringFormatter $stringFormatter;

  /**
   * @param \Drupal\o2e_test\Service\StringFormatter $stringFormatter
   */
  public function __construct(StringFormatter $stringFormatter)
  {
     $this->stringFormatter = $stringFormatter;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @return \Drupal\o2e_test\Controller\O2eTestController|static
   */
  public static function create(ContainerInterface $container): O2eTestController
  {
    // grab all the services we want to use
    $stringFormatter = $container->get('o2e_test.string_formatter');

    return new static($stringFormatter);
  }

  public function o2eTest($intOne, $intTwo): array
  {
    return $this->stringFormatter->additionAnswer($intOne, $intTwo);
  }
}
