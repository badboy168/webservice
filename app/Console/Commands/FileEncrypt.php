<?php

namespace App\Console\Commands;

use App\Common\PHPFileEncode;
use Illuminate\Console\Command;
use SebastianBergmann\CodeCoverage\Report\PHP;

class FileEncrypt extends Command
{

    private $filePath = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fileEncrypt:encode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    function getFilePath()
    {

        $common = app_path("Common");
        $cross = app_path("Http/Middleware/CrossHttp.php");
        $controller = app_path("Http/Controllers/Api");
        $appModule = app_path("Modules/App/Http/Controllers");

        array_push($this->filePath, $common);
        array_push($this->filePath, $cross);
        array_push($this->filePath, $controller);
        array_push($this->filePath, $appModule);
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->getFilePath();
        $fileEncode = new PHPFileEncode();
//        var_dump($fileEncode);
        echo "是否对以下目录进行加密:".PHP_EOL;
        $index = 0;
        foreach ($this->filePath as $item)
        {
            $index ++;
            $fileEncode->addPath($item);
            echo "{[$index]} {$item}".PHP_EOL;
        }
//
//        $fileEncode->run();

        echo "请输入Y/n进行操作: ";

        $result = fgetc(STDIN);
        if(strtolower($result) == 'y')
        {
            $fileEncode->run();
        }

    }
}
