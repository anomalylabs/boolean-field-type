<?php

namespace Anomaly\BooleanFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class BooleanFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class BooleanFieldType extends FieldType
{

    /**
     * The database column type.
     *
     * @var string
     */
    public $columnType = 'boolean';

    /**
     * The input view.
     *
     * @var null|string
     */
    protected $inputView = null;

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.boolean::filter';

    /**
     * The config array.
     *
     * @var array
     */
    public $config = [
        'default_value' => false,
        'on_color'      => 'success',
        'off_color'     => 'danger',
    ];

    /**
     * Get the validation value.
     *
     * @param  null $default
     * @return bool
     */
    public function getValidationValue($default = null)
    {
        return $this->getPostValue() === true ?: null;
    }

    /**
     * Get the post value.
     *
     * @param  null $default
     * @return bool
     */
    public function getPostValue($default = null)
    {
        return filter_var(parent::getPostValue($default), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Return the input view.
     *
     * @return string
     */
    public function getInputView()
    {
        if ($view = parent::getInputView()) {
            return $view;
        }

        return 'anomaly.field_type.boolean::' . $this->mode();
    }

    /**
     * Return the input mode.
     *
     * @return string
     */
    public function mode()
    {
        return $this->config('mode') ?: config('anomaly.field_type.boolean::input.mode', 'switch');
    }

    /**
     * Render the input.
     *
     * @return View
     */
    public function getAjaxInput()
    {
        return view('anomaly.field_type.boolean::ajax', ['fieldType' => $this]);
    }

    /**
     * Return class HTML.
     *
     * @param string $class
     * @return null|string
     */
    public function class($class = null)
    {
        return trim(implode(' ', array_filter([
            $class,
            $this->getClass(),
            //$this->config('mode') == 'dropdown' ? 'custom-select form-control' : null
        ])));
    }

    /**
     * Return merged attributes.
     *
     * @param array $attributes
     */
    public function attributes(array $attributes = [])
    {
        if (filter_var($this->getValue(), FILTER_VALIDATE_BOOLEAN)) {
            self::mergeAttributeDefaults(['checked' => 'checked'], $attributes);
        }

        return array_merge(parent::attributes(), [
            //
        ], $attributes);
    }
}
