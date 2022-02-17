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
 * @var array $buttonOptions
 */

if ($showShowPasswordButton): ?>
    <div class="input-group">
<?php endif; ?>
<?php echo $input ?>
<?php if ($showShowPasswordButton): ?>
    <span class="input-group-btn"><?php
        echo Html::button($showPasswordByDefault ? $buttonLabelHide : $buttonLabelShow, $buttonOptions);
        ?></span>
<?php endif; ?>
<?php if ($showShowPasswordButton): ?>
    </div>
<?php endif; ?>