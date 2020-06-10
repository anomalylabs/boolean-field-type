<?php

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;
use Anomaly\BooleanFieldType\BooleanFieldType;

class BooleanFieldTypeTest extends TestCase
{

    public function testGetValidationValue()
    {
        $fieldType = app(BooleanFieldType::class)
            ->setField('boolean');

        $this->assertTrue($fieldType->getValidationValue() === null);
    }

    public function testGetPostValue()
    {
        $fieldType = app(BooleanFieldType::class)
            ->setField('boolean');

        request()->request->set('boolean', true);

        $this->assertTrue($fieldType->getPostValue());

        request()->request->set('boolean', 'no');

        $this->assertTrue($fieldType->getPostValue() === false);

        request()->request->remove('boolean');
    }

    public function testGetInputView()
    {
        $fieldType = app(BooleanFieldType::class)
            ->setField('boolean');

        $this->assertTrue($fieldType->getInputView() === 'anomaly.field_type.boolean::switch');

        $fieldType->setInputView('test_view');

        $this->assertTrue($fieldType->getInputView() === 'test_view');
    }

    public function testGetAjaxInput()
    {
        $fieldType = app(BooleanFieldType::class)
            ->setField('boolean');

        $this->assertTrue($fieldType->getAjaxInput() instanceof View);
    }

    public function testClass()
    {
        $fieldType = app(BooleanFieldType::class)
            ->setField('boolean');

        $this->assertTrue(Str::contains($fieldType->class('foo bar'), 'input'));
    }

    public function testAttributes()
    {
        $fieldType = app(BooleanFieldType::class)
            ->setValue(true)
            ->setField('boolean');

        $attributes = $fieldType->attributes();

        $this->assertTrue(Arr::get($attributes, 'checked') === 'checked');
    }
}
