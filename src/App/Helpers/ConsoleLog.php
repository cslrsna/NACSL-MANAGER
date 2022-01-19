<?php
namespace nacsl\App\Helpers;


class ConsoleLog
{
    private $class;
    private $fn;
    private $json;
    
    public function __construct($class, $fn, $output)
    {
        $this->json = \json_encode($output);
        $this->class = $class;
        $this->fn = $fn;
        add_action( 'wp_footer', array($this, 'getJson') );
    }

    public function getJson()
    {
        echo <<<EOT
<script>console.log("NACSL-MANAGER | {$this->class} {$this->fn}():", {$this->json} ); </script>
EOT;
    }   

}
