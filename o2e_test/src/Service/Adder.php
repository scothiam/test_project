<?php

namespace Drupal\o2e_test\Service;

/**
 *
 */
class Adder {

  /**
   * @param int $intOne
   * @param int $intTwo
   *
   * @return int
   */
  public function addition(int $intOne, int $intTwo): int {
    return $intOne + $intTwo;
  }
}
