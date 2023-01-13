<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Main backend application asset bundle.
 */
class TagsInputAsset extends AssetBundle
{
    public $basePath = '@webroot/tags_input';
    public $baseUrl = '@web/tags_input';
    public $css = [
        'bootstrap-tagsinput.css',
    ];
    public $js = [
        'bootstrap-tagsinput.js'
    ];
    public $depends = [
        JqueryAsset::class
    ];
}
