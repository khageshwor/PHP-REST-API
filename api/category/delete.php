<?php 
    //Header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorizatio, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/category.php';

    //Instantiate Databse and connect to Database
    $database = new Database();
    $db = $database->connect();

    //Instantiate Category post object
    $post = new Category($db);

    //Get The raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to Delete
    $post->id = $data->id;

    //Delete Post
    if($post->delete()){
        echo json_encode(
            array('message' => 'Category Deleted')
        );
    }else{
        echo json_encode(
            array('message' => 'Category Not Deleted')
        );
    }
?>