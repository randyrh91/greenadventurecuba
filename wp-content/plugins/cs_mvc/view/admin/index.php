<?php
/**
 * Created by PhpStorm.
 * User: pr0x
 * Date: 10/05/2015
 * Time: 1:40
 */
$model = new SigerViewModel();
?>
<h2><?=$model->getPost()->post_title?></h2>
<hr>
<div><?=$model->getPost()->post_content?></div>