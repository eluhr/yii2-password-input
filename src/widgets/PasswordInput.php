<?php

namespace eluhr\passwordInput\widgets;

use eluhr\passwordInput\assets\PasswordInputAsset;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JqueryAsset;
use yii\widgets\InputWidget;

/**
 * --- PROPERTIES ---
 *
 * @author Elias Luhr
 */
class PasswordInput extends InputWidget
{

    /**
     * List of patterns
     * @var array
     */
    public $rules = [];

    /**
     * Addon button value when password is hidden
     * @var string
     */
    public $buttonLabelShow = 'Show';

    /**
     * Addon button value when password is visible
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

    public function init()
    {
        parent::init();
        Html::addCssClass($this->options,'password-input');
    }

    public function run()
    {
        $this->registerAssets();
        return $this->render('password-input', [
            'input' => $this->renderInputHtml($this->showPasswordByDefault ? 'text' : 'password'),
            'buttonLabelShow' => $this->buttonLabelShow,
            'buttonLabelHide' => $this->buttonLabelHide,
            'rules' => $this->rules,
            'value' => $this->getValue(),
            'showPasswordByDefault' => $this->showPasswordByDefault,
            'showShowPasswordButton' => $this->showShowPasswordButton
        ]);
    }

    protected function registerAssets()
    {
        PasswordInputAsset::register($this->view);
        $rules = Json::encode($this->rules);
        $this->view->registerJs("$('#$this->id input.password-input').passwordInput({rules: $rules})");
    }

    /**
     * @return array|string|null
     */
    protected function getValue() {
        if ($this->hasModel()) {
            return Html::getAttributeValue($this->model, $this->attribute);
        }
        return $this->value;
    }
}
