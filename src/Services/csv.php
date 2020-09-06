<?php


namespace App\Services;


use App\Kernel;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use App\Services\db;
use App\Services\tasks\SetState;
use App\Services\NewProduct;
use App\Services\Helper;
use DocRep;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Class csv
 */

class csv extends SetState
{
    private $RootDir;
    private $file_path;

    public function __construct(Helper $helper){
        $this->RootDir = $helper->getApplicationRootDir();
    }

    public function movecsv() : array
    {
        if($_FILES['file']['type'] == 'text/csv') {
            $target_dir = $this->RootDir . '/public/csv/';
            $file = $_FILES['file']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['file']['tmp_name'];
            $this->file_path = $target_dir.$filename.".".$ext;

            if (file_exists($this->file_path)) {
                parent::setError("Sorry, file already exists.");
            }else{

                $result = move_uploaded_file($temp_name,$this->file_path);
                parent::wait();
            }

            return [
                $filename => $this->file_path
            ];

        }else{
            parent::broken();
            parent::setError('Cant import CSV || $_FILES empty');
            return ['none'=>false];
        }
    }


    public function SetCsv() : void{

        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        $filename = $this->file_path;

        if(isset($filename)){
            $file = fopen($filename, "r");
            $add = new newProduct;
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                var_dump($getData);
                $add
                    ->add_name(addslashes($getData[1]))
                    ->add_category(addslashes($getData[0]))
                    ->findSet_cID()
                    ->add_price($getData[3])
                    ->add_num($getData[2])
                    ->add_img_urls($getData[4])
                    ->AddNewProduct();
            }
            fclose($file);
            parent::done();
        }
    }
}