<?php

namespace App\Views;

class Baseview 
{

    private $filePath;
    public function __construct()
    {
        $this->filePath = BASE_PATH."resources/views/FILEPATH.php";
    }

    public function render(string $fileName, array $params)
    {
        extract($params);
        ob_start();
        
        $header = str_replace("FILEPATH", "header", $this->filePath);
        $file = str_replace("FILEPATH", $fileName, $this->filePath);
        $footer = str_replace("FILEPATH", "footer", $this->filePath);

        include($header);
        include($file);
        include($footer);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}