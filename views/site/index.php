<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
// The message
/*$message = "Line 1\nLine 2\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
mail('filipe1309d@gmail.com', 'My Subject', $message);*/
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
<?php       
        use webvimark\modules\UserManagement\components\GhostMenu;
        use webvimark\modules\UserManagement\UserManagementModule;
        
        echo GhostMenu::widget([
            'encodeLabels'=>false,
            'activateParents'=>true,
            'items' => [
                [
                    'label' => 'Backend routes',
                    'items'=>UserManagementModule::menuItems()
                ],
                [
                    'label' => 'Frontend routes',
                    'items'=>[
                        ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                        ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                        ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                        ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                        ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                        ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
                    ],
                ],
            ],
        ]);
?>
    </div>
</div>
