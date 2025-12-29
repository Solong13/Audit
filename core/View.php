<?php 

namespace Core;

class View 
{
    public function render(string $template, array $data = []) 
    {
        $viewFile = __DIR__ . "/../src/templates/" . $template . ".php";

        if (!file_exists($viewFile)) {
            throw new \Exception("View '{$template}' not found");
        }

		extract($data);
		ob_start();
        include_once (__DIR__ . '/../src/templates/header.php');
        include $viewFile;
        include_once (__DIR__ . '/../src/templates/footer.php');
		return ob_get_clean();

    }

}
