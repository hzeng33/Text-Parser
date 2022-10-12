<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="UTF-8">
         <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <title>Parser Report Page</title>
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
                width: 75%;
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
    <?php
        $servername="mars.cs.qc.cuny.edu";
        $username="zeha6333";
        $password="23146333";
        $dbname="zeha6333";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
        
        $sourceName = $conn->query("SELECT source_name FROM source INNER JOIN occurrence ON source.source_id = occurrence.source_id LIMIT 1;");
        if(!$sourceName){ die("Invalid query: ". $conn->error);}

        $wordAndFreq = $conn->query("SELECT word, freq FROM occurrence INNER JOIN source ON occurrence.source_id = source.source_id ORDER BY freq DESC");
        if($conn->query($wordAndFreq) === false){ echo "Error: " . $wordAndFreq . "<br>" . $conn->error . "<br>";} 
        //echo $sourceName;
        //echo $wordAndFreq;
        
        if(mysqli_num_rows($sourceName) > 0){
            if($row = $sourceName->fetch_row()) {
                echo "<h1>".$row[0]."</h1>".
                "<table>
                 <tr>
                 <th>Words</th>
                 <th>Frequency</th>
                 <th>Percentage</th>
                 </tr>";
            } 
        } else{
                echo "No records matching your query were found.";
            }   

        $rowCount = mysqli_num_rows($wordAndFreq);
        if(mysqli_num_rows($wordAndFreq) > 0){
            //read data of each row
            while($row = mysqli_fetch_array($wordAndFreq)){
                echo "<tr>";
                echo "<td>". $row["word"]."</td>";
                echo "<td>". $row["freq"]."</td>";
                echo "<td>". round(($row["freq"] / $rowCount * 100), 2)."%"."</td>". 
                    "</tr>";
           }
            
        }else{
            echo "No records matching your query were found.";
        }   
       
         
        $conn->close();
    ?>
            
 </table>   
    
    </body>
</html>
