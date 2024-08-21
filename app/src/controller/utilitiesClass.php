<?php 
class Utilities{



    public function show404(){

        http_response_code(404);
        echo "<h1 style='text-align:center;margin:10rem;font-size:5rem'>page not found</h1>";
        die();

    }

}
