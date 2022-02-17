<?php
/**
 * --- FROM CONTEXT ---
 *
 * @var \yii\web\View $this
 * @var string $input
 * @var string $buttonLabelShow
 * @var string $buttonLabelHide
 * @var array $rules
 * @var array|string|null $value
 * @var bool $showPasswordByDefault
 * @var bool $showShowPasswordButton
 */

use eluhr\passwordInput\helpers\PasswordInputHelper;
use yii\helpers\Html;

?>
<div class="password-input-widget" id="<?php echo $this->context->id ?>">
    <?php if ($showShowPasswordButton): ?>
    <div class="input-group">
        <?php endif; ?>
        <?php echo $input ?>
        <?php if ($showShowPasswordButton): ?>
            <span class="input-group-btn">
                <?php
                echo Html::button($showPasswordByDefault ? $buttonLabelHide : $buttonLabelShow, [
                    'class' => 'btn btn-default password-input-toggle-button',
                    'data' => [
                        'password-visible' => $showPasswordByDefault ? '1' : '0',
                        'hidden-text' => $buttonLabelShow,
                        'visible-text' => $buttonLabelHide
                    ]
                ]);
                ?>
            </span>
        <?php endif; ?>
        <?php if ($showShowPasswordButton): ?>
    </div>
<?php endif; ?>
    <div class="password-rule-bars"><?php foreach ($rules as $ruleIndex => $rule) {
            echo Html::tag('div', '', [
                'class' => [
                    'password-rule-bar',
                    PasswordInputHelper::patternMatches($value, $rule['pattern']) ? 'matches' : ''
                ],
                'data' => [
                    'rule-index' => $ruleIndex
                ]
            ]);
        } ?></div>
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
</div>

