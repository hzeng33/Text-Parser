<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="UTF-8">
         <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <title>Information Page</title>
         <style>
            body {
                background-image:url(background.jpg);
                background-size: cover;
            }

            h1{
                color: darkslategrey;
                text-align: center;
          }

            table{
                width: 90%;
                border: 2px solid black;
                margin-left: auto;
                margin-right: auto;
            }

            th,td{
                padding: 5px;
                text-align: center;
                border-bottom: 2px solid #DDD;
                background-color: lightblue
            }
        </style>
    </head>
    <body>
        <h1>Source Information</h1>
        <table>
            <tr>
                 <th>Source ID</th>
                 <th>Source Name</th>
                 <th>Source URL</th>
                 <th>Source's Begin</th>
                 <th>Source's End</th>
                 <th>Parsed Timestamp</th>
                 <th>Words</th>
            </tr>
   <?php
        $servername="mars.cs.qc.cuny.edu";
        $username="zeha6333";
        $password="23146333";
        $dbname="zeha6333";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
       
        $result = $conn->query("SELECT * FROM source");
        
        if(!$result){ die("Invalid query: ". $conn->error);}
         
        //read data of each row
        while($row = $result->fetch_assoc()){
           echo "
              <tr>
                  <td>". $row["source_id"]."</td>
                  <td>". $row["source_name"]."</td>
                  <td> <a href=\"". $row["source_url"]."\">Text link</a></td>
                  <td>". $row["source_begin"]."</td>
                  <td>". $row["source_end"]."</td>
                  <td>". $row["parsed_dtm"]."</td>
                  <td><a href=\"https://venus.cs.qc.cuny.edu/~zeha6333/cs355/report.php\">Word link</a></td>
              </tr> ";   
         }
         
        $conn->close();
         
    ?>
            
 </table>   
    
    </body>
</html>

