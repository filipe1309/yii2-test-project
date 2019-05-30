<?php

namespace app\commands;

use yii\console\Controller;

class UpdateController extends Controller
{
    public function actionIndex()
    {
        echo "SGCI Update Script\n";
        $start = microtime(true);
        // 10000090000 - 740 s
        for ($i = 0; $i < 100000900; $i++) {}
        $this->updateSenior();
        $this->updateLattes();
        $time_elapsed_secs = microtime(true) - $start;
        echo 'Time: ' . $time_elapsed_secs . ' seconds' . PHP_EOL;
    }
    
    public function actionTest()
    {
        echo "Updanting Test\n";
    }
    
    public function updateLattes()
    {
        echo "Updanting Lattes\n";
    }
    
    public function updateSenior()
    {
        echo "Updanting Senior\n";
    }
}
