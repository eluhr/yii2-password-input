<?php

use yii\helpers\Html;

/**
 * --- FROM CONTEXT ---
 *
 * @var \yii\web\View $this
 * @var string $input
 * @var string $buttonLabelShow
 * @var string $buttonLabelHide
 * @var bool $showPasswordByDefault
 * @var bool $showShowPasswordButton
 */

if ($showShowPasswordButton): ?>
    <div class="input-group">
<?php endif; ?>
<?php echo $input ?>
<?php if ($showShowPasswordButton): ?>
    <span class="input-group-btn"><?php
        echo Html::button($showPasswordByDefault ? $buttonLabelHide : $buttonLabelShow, [
            'class' => 'btn btn-default password-input-toggle-button',
            'data' => [
                'password-visible' => $showPasswordByDefault ? '1' : '0',
                'hidden-text' => $buttonLabelShow,
                'visible-text' => $buttonLabelHide
            ]
        ]);
        ?></span>
<?php endif; ?>
<?php if ($showShowPasswordButton): ?>
    </div>
<?php endif; ?>