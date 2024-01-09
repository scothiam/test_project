<?php

namespace Drupal\o2e_test\Service;

/**
 *
 */
class StringFormatter
{

  /**
   * @var \Drupal\o2e_test\Service\Adder
   */
  protected Adder $adder;

  /**
   * @param \Drupal\o2e_test\Service\Adder $adder
   */
  public function __construct(Adder $adder)
  {
    $this->adder = $adder;
  }

  /**
   *
   * Return a translatable, answer response
   *
   * @param int $intOne
   * @param int $intTwo
   *
   * @return array
   */
  public function additionAnswer(int $intOne, int $intTwo) : array
  {

    // do the math
    $sum = $this->adder->addition($intOne, $intTwo);

    return [
      '#type' => 'markup',
      '#markup' => t('The product of @num1 and @num2 is @sum',
        ['@num1' => $intOne, '@num2' => $intTwo, '@sum' => $sum]),
    ];
  }
}
