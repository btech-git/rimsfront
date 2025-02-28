<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="language" content="en" />
        <link rel="icon" type="image/png" href="/app/images/favicon.png" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/memo.css" />
    </head>

    <body>
        <?php echo $content; ?>
    </body>
</html>
