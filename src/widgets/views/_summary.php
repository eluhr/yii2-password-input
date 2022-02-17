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
<ul class="password-rule-texts"><?php foreach ($rules as $ruleIndex => $rule) {
        echo Html::tag('li', $rule['text'], [
            'class' => [
                'password-rule-text',
                PasswordInputHelper::patternMatches($value, $rule['pattern']) ? 'matches' : ''
            ],
            'data' => [
                'rule-index' => $ruleIndex
            ]
        ]);
    } ?>
</ul>
