<?php
namespace Drupal\recipe\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Annotation\ViewsFilter;
use Drupal\views\Plugin\views\filter\FilterPluginBase;

/**
 * Relative date filter.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("custom_filter")
 */
class CustomViewsFilter extends FilterPluginBase
{

  const OPTION_ALL = 'All';

  const OPTION_ONE = 0; // represents first of two possible values of field one

  CONST OPTION_TWO = 1; // represents the second possible value of field one

  CONST OPTION_THREE = 2; // represents different field query-join altogether

  CONST FIELD_ONE = 'node__field_one';

  CONST FIELD_TWO = 'node__field_two';

  /**
   * Form with all possible filter values.
   */
  protected function valueForm(&$form, FormStateInterface $form_state)
  {
    $form['value'] = [
      '#tree' => TRUE,
      'custom_options' => [
        '#type' => 'select',
        '#title' => $this->t('Custom Filter Example'),
        '#options' => [
          $this::OPTION_ALL => $this
            ->t('All (do not adjust or add a query)'),
          $this::OPTION_ONE => $this
            ->t('Option1 (query 1 with var 1)'),
          $this::OPTION_TWO => $this
            ->t('Option2 (query 1 with var 2)'),
          $this::OPTION_THREE => $this
            ->t('Option3 (query 2 with preset var)'),
        ],
        // is logic around default really needed?
        '#default_value' => !empty($this->value['custom_options'])
          ? $this->value['custom_options']
          : $this::OPTION_ALL,
      ]
    ];
  }

  /**
   * Adds conditions to the query based on the selected filter option.
   */
  public function query()
  {
    $selectedValue = $this->value['custom_options'];

    // do nothing if custom_option is 'all' or 'All'
    if (is_numeric($selectedValue)) {
      $this->ensureMyTable();
      $query = $this->query;

      // based on the input, adjust which table we'll join
      $table = ($selectedValue == $this::OPTION_THREE )
        ? 'node__'.$this::FIELD_ONE
        : 'node__'.$this::FIELD_TWO;

      // based on the input, adjust the condition
      $condition = ($selectedValue == $this::OPTION_THREE )
        ? $this::FIELD_ONE.'_value = 1'
        : $this::FIELD_TWO.'_value = '.$selectedValue; // 0 or 1

      $definition = [
        'table' => $table,
        'field' => 'entity_id',
        'left_table' => 'node_field_data',
        'left_field' => 'nid',
      ];

      // can/should I use DI instead of ::service?
      $join = \Drupal::service('plugin.manager.views.join')
        ->createInstance('standard', $definition);
      $query->addRelationship($table, $join, 'node_field_data');
      $query->addWhereExpression(0, $condition);
    }
  }

  /**
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup|string
   */
  public function adminSummary() {
    if ($this->isAGroup()) {
      return $this->t('grouped');
    }
    if (!empty($this->options['exposed'])) {
      return $this->t('exposed') . ', ' . $this->t('default state') . ': ' . $this->value['custom_options'];
    }
    else {
      return $this->t('default state') . ': ' . $this->value['custom_options'];
    }
  }
}
