<?php


namespace App\Services;

use App\Repository\product_rep as rep;
use App\Services\db as db;
use Symfony\Component\Config\Definition\Exception\Exception;

class products
{

    private $GetProdById = [];
    private $ImgUrls = [];

    public function __get($property){
        return $this->$property;
    }

    public function connect(){
        $db = new db;
        return $db->connect();
    }

    public function reload(string $url){
        header( "Location: http://127.0.0.1:8000/$url" );
        die;
    }

    public function items_list(){
        $mysqli = $this->connect();
        $query = "SELECT * FROM products";
        $result = mysqli_query($mysqli, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }

    public function cat_list(){
        $mysqli = $this->connect();
        $query = "SELECT * FROM category";
        $result = mysqli_query($mysqli, $query);

        $category = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $category[] = $row;
        }

        return $category;
    }

    public function delete_product(){

        $mysqli = $this->connect();

        if(isset($_GET['prod_id']))
        {
            $id = mysqli_real_escape_string($mysqli, $_GET['prod_id']);
            $query ="DELETE FROM products WHERE id = '$id'";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload('main');
        }
    }

    public function delete_category(){

        $mysqli = $this->connect();

        if(isset($_GET['cat_id']))
        {
            $id = mysqli_real_escape_string($mysqli, $_GET['cat_id']);
            $query ="DELETE FROM category WHERE category_id = '$id'";
            $result = mysqli_query($mysqli, $query) or die("Ошибка " . mysqli_error($mysqli));
            products::reload('main');
        }
    }


    public function add_category(){

        $mysqli = $this->connect();

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

    public function add_product(){

        $mysqli = $this->connect();

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
            products::reload('main');
        }
    }

    public function update_product(){

        $mysqli = $this->connect();

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

        $mysqli = $this->connect();

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

    public function getImgUrls(){
        if(isset($_GET['imgurls'])) {

            $project_path = getenv('OLDPWD');
            $path = "$project_path/public/img";

            if (!file_exists($path)) {
                mkdir($path, 0700);
            }

            $urls = explode('/orig', $_GET['imgurls']);

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
                $saveTo = './img/'. 'img__' . $header[$i]['Content-Length'] . '_' . $date . '.'. $type[$typeofimage];
                $fp = fopen($saveTo, 'w+');

                if($fp === false){
                    echo ('Could not open: ' . $saveTo);
                }

                $ch = curl_init($urlspit[$i]);
                $options = array(CURLOPT_URL => $urlspit[$i],
                    CURLOPT_HEADER => false,
                );
                curl_setopt_array($ch, $options);
                curl_exec($ch);

                if(curl_errno($ch)){
                    echo (curl_error($ch));
                }
                $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                if($statusCode == 200){
                    echo 'Downloaded!';
                } else{
                    echo "Status Code: " . $statusCode;
                }
            }
        }

    }
}
