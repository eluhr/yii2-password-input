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
     *          'pattern' => '/\d+/',
     *          'showInSummary' => true, // If the value is not set at all, it will be displayed
     *          'showAsBar' => false // If the value is not set at all, it will be displayed
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
     * Layout of the widget component
     *
     * {input}: The actual input group
     * {bars}: Rule bars. One per rule
     * {summary}: List of rule texts
     *
     * @var string
     */
    public $layout = "{input}\n{bars}\n{summary}";

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
            'content' => $this->content()
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
     *
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

    protected function content()
    {
        $rules = $this->rules();
        $value = $this->value();
        $layoutTokens = [
            '{input}' => $this->render('_input', [
                'showShowPasswordButton' => $this->showShowPasswordButton,
                'input' => $this->renderInputHtml($this->showPasswordByDefault ? 'text' : 'password'),
                'showPasswordByDefault' => $this->showPasswordByDefault,
                'buttonLabelHide' => $this->buttonLabelHide,
                'buttonLabelShow' => $this->buttonLabelShow
            ]),
            '{bars}' => $this->render('_bars', [
                'rules' => $rules,
                'value' => $value
            ]),
            '{summary}' => $this->render('_summary', [
                'rules' => $rules,
                'value' => $value
            ])
        ];
        return str_replace(array_keys($layoutTokens), array_values($layoutTokens), $this->layout);
    }

    /**
     * @return array|string|null
     */
    protected function value()
    {
        if ($this->hasModel()) {
            return Html::getAttributeValue($this->model, $this->attribute);
        }
        return $this->value;
    }
}
