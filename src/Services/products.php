<?php


namespace App\Services;

use App\Repository\product_rep as rep;
use App\Services\db as db;
use Symfony\Component\Config\Definition\Exception\Exception;


class products
{

    private $GetProdById = [];
    private $ImgUrls = [];


    public function __set($property, $value){
        $this->$property = $value;
    }

    public function __get($property){
        return $this->$property;
    }

    public function reload(string $url){
        header( "Location: http://127.0.0.1:8000/$url" );
        die;
    }

    public function items_list(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();
        $query = "SELECT * FROM products";
        $result = mysqli_query($mysqli, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }

    public function cat_list(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();
        $query = "SELECT * FROM category";
        $result = mysqli_query($mysqli, $query);

        $category = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $category[] = $row;
        }

        return $category;
    }

    public function delete_product(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        if(isset($_GET['prod_id']))
        {
            $id = mysqli_real_escape_string($mysqli, $_GET['prod_id']);
            $query ="DELETE FROM products WHERE id = '$id'";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload('main');
        }
    }

    public function delete_category(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        if(isset($_GET['cat_id']))
        {
            $id = mysqli_real_escape_string($mysqli, $_GET['cat_id']);
            $query ="DELETE FROM category WHERE category_id = '$id'";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload('main');
        }
    }


    public function add_category(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        if(isset($_GET['add_cat']))
        {
            $product_rep = new rep;
            $cat_id = 0;
            $cat_name = mysqli_real_escape_string($mysqli, $_GET['cat_name']);
            $query ="INSERT INTO category VALUES ($cat_id, '$cat_name')";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            $cat_id++;
            products::reload('main');
        }
    }

    public function getImgUrls($p_id, $urls){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        if(isset($_GET['imgurls'])) {

            $project_path = getenv('OLDPWD');
            $path = "$project_path/public/img";

            if (!file_exists($path)) {
                mkdir($path, 0700);
            }

            $orig = '/orig';
            $urlhead = implode($orig, $urls);
            $urlspit = preg_split('/\s+/', $urlhead);

            $type = [
                'image/gif' => 'gif',
                'image/jpeg' => 'jpeg',
                'image/png' => 'png',
                'image/svg+xml' => 'svg',
                'image/tiff' => 'tiff',
                'image/webp' => 'webp'
            ];

            for($i=0; $i < count($urls) - 1; $i++){
                if (get_headers($urlspit[$i]) != null){
                    $header[$i] = get_headers($urlspit[$i], 1);
                }

                if ($header[$i]['Content-Type'] != null){
                    $head_type[$i] = $header[$i]['Content-Type'];
                }else{
                    throw new Exception('Error! Header Content Type Not Found');
                }

                $typeofimage = $head_type[$i];

                $date = date('h:i:s');
                $foto_name = 'img__' . $header[$i]['Content-Length'];
                $saveTo = './img/'. $foto_name . '_' . '.'. $type[$typeofimage];
                $fp = fopen($saveTo, 'w+');

                if($fp === false){
                    echo ('Could not open: ' . $saveTo);
                }


                $query ="INSERT INTO fotos VALUES (0, $p_id , '$foto_name', '$saveTo')";
                $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11');

                curl_setopt($ch, CURLOPT_URL, $urlspit[$i]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FILE, $fp);

                if(!curl_exec($ch)){
                    curl_close($ch);
                    fclose($fp);
                    return false;
                }

                fflush($fp);
                fclose($fp);
                curl_close($ch);

            }
        }

    }

    public function add_product(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        if(isset($_GET['add']))
        {
            $product_rep = new rep;

            $c_id = mysqli_real_escape_string($mysqli, $_GET['category_id']);
            $p_name = mysqli_real_escape_string($mysqli, $_GET['name']);
            $p_category = mysqli_real_escape_string($mysqli, $_GET['category']);
            $p_num = mysqli_real_escape_string($mysqli, $_GET['number']);
            $p_price = mysqli_real_escape_string($mysqli, $_GET['price']);
            $p_id = 0;
            $query ="INSERT INTO products VALUES ($p_id, $c_id, '$p_category', '$p_name', $p_num, $p_price)";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            $p_id++;

            $query2 = "SELECT id FROM products where name= '$p_name'";
            $result2 = mysqli_query($mysqli, $query2);
            $getFotoId = mysqli_fetch_assoc($result2);

            $urls = explode('/orig', $_GET['imgurls']);
            $this->getImgUrls($getFotoId["id"], $urls);
            products::reload('main');
        }
    }


    public function update_product(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        if(isset($_GET['update']))
        {
            $product_rep = new rep;
            $p_id = mysqli_real_escape_string($mysqli, $_GET['update']);
            $c_id = mysqli_real_escape_string($mysqli, $_GET['category_id']);
            $p_name = mysqli_real_escape_string($mysqli, $_GET['name']);
            $p_category = mysqli_real_escape_string($mysqli, $_GET['category']);
            $p_num = mysqli_real_escape_string($mysqli, $_GET['number']);
            $p_price = mysqli_real_escape_string($mysqli, $_GET['price']);
            $query ="UPDATE products SET category_id = $c_id, name = '$p_name', category = '$p_category', num = $p_num, price = $p_price where id= '$p_id';";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload('main');
        }
    }

    public function getProductById(int $product_id) : array {
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();

        $query = "SELECT * FROM products where id= '$product_id'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error());

        if(!$result) {
            die('MySQL Error: ' . mysqli_error());
        }

        else {
            $product = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $this->GetProdById = $row;
            }
            return $product;
        }

    }
    public function img_list(){
        $instance = db::getInstance();
        $mysqli = $instance->getConnection();
        $query = "SELECT * FROM fotos";
        $result = mysqli_query($mysqli, $query);

        while ($row[] = mysqli_fetch_assoc($result)) {
            $this->ImgUrls = $row;
        }
    }


}
