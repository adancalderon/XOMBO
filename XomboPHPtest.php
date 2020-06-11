<!--/****-->
<!-- Adan David Sierra Calderon -->
<!-- Date: June 11, 2020-->
<!-- This webpage is for applicants to the "Software Development" role at XOMBO.

In order to assess your ability to interact with 3rd-party APIs using PHP, please complete the following tasks:

1.Create a PHP script.
2.Have the script initiate an HTTP(S) request to at least one RESTful API. For the purposes of this assignment, you may use the following REST resource(s) or use one of your choosing:
https://jsonplaceholder.typicode.com/photos
https://jsonplaceholder.typicode.com/users
http://dummy.restapiexample.com/
3.Decode the result you receive from the API (i.e. json_decode for JSON or if the API uses XML you will probably need to convert it to a PHP data structure using a library).
4.Output significant data from the result(s) data structure as a simple HTML webpage (i.e. a series of photos or a list of employees).-->
<!--****/-->


<?php        // PHP Script Creation

function getFromApi($url){ // GET method to access all employees data using rest /employees

    $channel = curl_init($url); // this starts a new cURL session


    //set-up URL with according options
    curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($channel, CURLOPT_HEADER, 0);

    $data = curl_exec($channel); //passes URL to the browser


    curl_close($channel); //closes cURL resources

    $object = json_decode($data);  //decoding json string

    //var_dump($object);

    $content_array = $object->data; //access data property from object

    //var_dump($content);

    foreach ($content_array as $value) { // for every value in content "print/echo result"

        //format every field
        echo "<b>Employee Name: </b>" ."<i>". $value->employee_name."</i>"; // access employee name
        echo "<br>";
        echo "<ul>";
        echo "<li> Employee Salary: " . $value->employee_salary. "</li>"; //access employee salary
        echo "<br>";
        echo "<li> Employee Age: " . $value->employee_age. "</li>";     // access employee age
        echo "<br>";
        echo "<li> Profile Picture: " . $value->profile_image. "</li>"; // access profile image
        echo "</ul>";
        echo "<br>";
        echo "<br>";                    // leave some space for every entry in the array
        echo "<br>";
    }
}

function postToApi($url){       // POST method to API creating an employee data using rest /employee

    $channel = curl_init();   //initiate cURL session


    //Set-up Curl session with appropiate options
    curl_setopt($channel, CURLOPT_URL,$url);
    curl_setopt($channel, CURLOPT_POST,1);

    //Value to be posted with this Json format:{"name":"test","salary":"123","age":"23"}
    //provided by: http://dummy.restapiexample.com/create

    curl_setopt($channel, CURLOPT_POSTFIELDS,"{\"name\":\"Adan Calderon\",\"salary\":\"1000000\",\"age\":\"23\"}");

    curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);

    $server_output = curl_exec($channel);    //response from the server once executed

    //var_dump($server_output);

    curl_close($channel);   // close cURL session like any stream of data

    echo $server_output; // Output if the post was successful and if it was, show posted details

    //We could handle errors below here in case there was a unsuccessful post
}

$restApi1 = "http://dummy.restapiexample.com/api/v1/employees";  //API URL to GET from
$restApi2 = "http://dummy.restapiexample.com/api/v1/create"; // API URL to POST to

getFromApi($restApi1); //calling GET method from the API
postToApi($restApi2);//calling POST method to the API


//End of PHP Script
?>
