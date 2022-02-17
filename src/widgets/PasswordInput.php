<?php

namespace eluhr\passwordInput\widgets;

use eluhr\passwordInput\assets\PasswordInputAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\RegularExpressionValidator;
use yii\widgets\InputWidget;

/**
 * --- PROPERTIES ---
 *
 * @author Elias Luhr
 */
class PasswordInput extends InputWidget
{

    /**
     * These rules are not used in any form in model validation.
     * They are used exclusively in the display of this widget.
     *
     * List of patterns
     *
     * ```php
     *  [
     *      [
     *          'text' => 'Must include at least one number',
     *          'pattern' => '/\d+/'
     *      ]
     *  ]
     * ```
     *
     * @var array
     */
    public $rules = [];

    /**
     * Addon button value when password is hidden
     *
     * @var string
     */
    public $buttonLabelShow = 'Show';

    /**
     * Addon button value when password is visible
     *
     * @var string
     */
    public $buttonLabelHide = 'Hide';

    /**
     * @var bool
     */
    public $showPasswordByDefault = false;

    /**
     * @var bool
     */
    public $showShowPasswordButton = true;

    /**
     * Load rules based on yii\validators\RegularExpressionValidator from model rules.
     * This only works when you use this input with the $model and $attribute value
     *
     * @var bool
     */
    public $loadRulesFromModel = false;

    /**
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'password-input');
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->registerAssets();
        return $this->render('password-input', [
            'input' => $this->renderInputHtml($this->showPasswordByDefault ? 'text' : 'password'),
            'buttonLabelShow' => $this->buttonLabelShow,
            'buttonLabelHide' => $this->buttonLabelHide,
            'rules' => $this->rules(),
            'value' => $this->getValue(),
            'showPasswordByDefault' => $this->showPasswordByDefault,
            'showShowPasswordButton' => $this->showShowPasswordButton
        ]);
    }

    /**
     * @return void
     */
    protected function registerAssets()
    {
        PasswordInputAsset::register($this->view);
        $rules = Json::encode($this->rules());
        $this->view->registerJs("$('#$this->id input.password-input').passwordInput({rules: $rules})");
    }

    /**
     * This method merges given rules from $rules and model rules
     * @return array
     */
    protected function rules()
    {
        $rules = $this->rules;
        $modelRules = [];
        if ($this->loadRulesFromModel && !empty($this->model)) {
            foreach ($this->model->getActiveValidators($this->attribute) as $validator) {
                if ($validator instanceof RegularExpressionValidator) {
                    $modelRules[] = [
                        'text' => $validator->message,
                        'pattern' => $validator->pattern
                    ];
                }
            }
        }
        return array_merge($rules, $modelRules);
    }

    /**
     * @return array|string|null
     */
    protected function getValue()
    {
        if ($this->hasModel()) {
            return Html::getAttributeValue($this->model, $this->attribute);
        }
        return $this->value;
    }
}
