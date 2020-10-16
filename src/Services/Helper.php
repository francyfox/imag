<?php

// app/src/Service/Helper.php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Helper{

    private $params;
    private static $RootPath;
    private $em;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
        self::$RootPath = $params;
    }

    /**
     *
     * e.g "/var/www/vhosts/myapplication"
     *
     * @return type
     */
    public function getApplicationRootDir(){
        return $this->params->get('kernel.project_dir');
    }

    public static function _getApplicationRootDir(){
        return self::$RootPath->get('kernel.project_dir');;
    }

    /**
     * This method returns the value of the defined parameter.
     *
     * @return type
     */
    public function getParameter($parameterName){
        return $this->params->get($parameterName);
    }
}
