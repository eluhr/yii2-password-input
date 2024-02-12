# Yii2 Password Input

### Installation

```bash
composer require eluhr/yii2-password-input
```

### Example usage

![Example Password Input Loop](https://media.giphy.com/media/dN6Pp1RS0YwDgyjLMy/giphy.gif)


```php
<?php
use eluhr\passwordInput\widgets\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();
echo $form->field($model, 'password')->widget(PasswordInput::class, [
    'buttonLabelShow' => \Yii::t('password-input', 'Show'),
    'buttonLabelHide' => \Yii::t('password-input', 'Hide'),
    'layout' => "{input}\n{bars}\n{summary}",
    'loadRulesFromModel' => false,
    'rules' => [
        [
            'text' => 'Must be at least 8 characters long',
            'pattern' => '/[0-9a-zA-Z]{8,}/'
        ],
        [
            'text' => 'Must include at least one number',
            'pattern' => '/\d+/'
        ],
        [
            'text' => 'Must contain the letter "a"',
            'pattern' => '/a/',
            'showAsBar' => false
        ],
        [
            'text' => 'Must not be empty',
            'pattern' => '/.+/',
            'showInSummary' => false
        ]
    ],
    'showPasswordByDefault' => false,
    'showShowPasswordButton' => true
]);
echo Html::submitButton();
ActiveForm::end();
?>
```

### Configuration

For configuration options please refer to the [Wiki](https://github.com/eluhr/yii2-password-input/wiki/Configuration)
