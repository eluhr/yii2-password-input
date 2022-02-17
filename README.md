# Yii2 Password Input

### Installation

```bash
composer require eluhr/yii2-password-input
```

### Example usage

```php
<?php
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
        ]
    ],
    'showPasswordByDefault' => false,
    'showShowPasswordButton' => true
]);
echo Html::submitButton();
ActiveForm::end();
?>
```
