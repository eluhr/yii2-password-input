<?php
/**
 * --- FROM CONTEXT ---
 *
 * @var array $rules
 * @var array|string|null $value
 */

use eluhr\passwordInput\helpers\PasswordInputHelper;
use yii\helpers\Html;

?>
<div class="password-rule-bars"><?php foreach ($rules as $ruleIndex => $rule) {
        if ($rule['showAsBar'] ?? true) {
            echo Html::tag('div', '', [
                'class' => [
                    'password-rule-bar',
                    PasswordInputHelper::patternMatches($value, $rule['pattern']) ? 'matches' : ''
                ],
                'data' => [
                    'rule-index' => $ruleIndex
                ]
            ]);
        }
    } ?></div>
