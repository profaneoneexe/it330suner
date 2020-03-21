<!doctype html>
<?php
    $servername = "it330sunerserver.mysql.database.azure.com";
    $username= "MarkAnthony@it330sunerservers";
    $password= "Freestyle07";
    $dbname= "mydb";
    $s_id= "";
    $s_fname= "";
    $s_lname= "";
    $s_address= "";
    $s_email= "";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    //CONNECT
 //CONNECT
    try{
        $conn =mysqli_connect($servername,$username,$password,$dbname);
    
    }catch (MySQLi_Sql_Exception $ex) {
        echo("error in connecting");

    }
    

    function getData(){

        $data = array();
        $data[0] = $_POST['s_id'];
        $data[1] = $_POST['s_fname'];
        $data[2] = $_POST['s_lname'];
        $data[3] = $_POST['s_address'];
        $data[4] = $_POST['s_email'];
        return $data;
        
    }
    //search
    if(isset($_POST['search']))
    {
        $info = getData();
        $search_query="Select * FROM `tbl_student` WHERE s_id = '$info[0]'";
        $search_result=mysqli_query($conn, $search_query);

            if($search_result)
                {
                    if(mysqli_num_rows($search_result))
                        {
                            while($rows = mysqli_fetch_array($search_result))
                                {

                                    $s_id = $rows['s_id'];
                                    $s_fname = $rows['s_fname'];
                                    $s_lname = $rows['s_lname'];
                                    $s_address = $rows['s_address'];
                                    $s_email = $rows['s_email'];
                                }
                        }else {
                            echo("no data");
                        }
                }else{
                    echo("result error");
                }
    }

    //insert
    
    if(isset($_POST['insert'])){
        $info = getData();
        $insert_query="INSERT INTO `tbl_student` (`s_fname`, `s_lname`, `s_address`,`s_email`) VALUES ('$info[1]', '$info[2]', '$info[3]', '$info[4]')";

        try{
                $insert_result=mysqli_query($conn, $insert_query);
                if($insert_result)
                {
                    if(mysqli_affected_rows($conn)>0){
                        echo("data inserted sucessfully");
                    }else{
                        echo("data not inserted");
                    }
                }
    }catch(Exception $ex){
        echo("error inserted".$ex->getMessage());
    }

    }

    //delete

    if(isset($_POST['delete'])){
        $info = getData();
        $delete_query="DELETE FROM `tbl_student` WHERE s_id= '$info[0]'";

        try{
                $delete_result=mysqli_query($conn, $delete_query);
                if($delete_result)
                {
                    if(mysqli_affected_rows($conn)>0){
                        echo("data deleted sucessfully");
                    }else{
                        echo("error");
                    }
                }
    }catch(Exception $ex){
        echo("error in delete".$ex->getMessage());
    }

    }

    //update

    if(isset($_POST['update'])){
        $info = getData();
        $update_query="UPDATE `tbl_student` SET `s_fname`='$info[1]', `s_lname`= '$info[2]', `s_address`= '$info[3]', `s_email`= '$info[4]' WHERE s_id = '$info[0]'";

        try{
                $update_result=mysqli_query($conn, $update_query);
                if($update_result)
                {
                    if(mysqli_affected_rows($conn)>0){
                        echo("data updated sucessfully");
                    }else{
                        echo("error");
                    }
                }
    }catch(Exception $ex){
        echo("error in update".$ex->getMessage());
    }

    }

?>

<html>
    <head>
    <meta charset="utf-8">
        <title>Untitled Document</title>
        </head>

    <body>
        <form method = "post" action="app.php">
            <input type="number" name= "s_id" placeholder = "ID" value="<?php echo($s_id)?>"><br><br>
            <input type="text" name= "s_fname" placeholder = "FIRST NAME" value="<?php echo($s_fname)?>"><br><br>
            <input type="text" name= "s_lname" placeholder = "LAST NAME" value="<?php echo($s_lname)?>"><br><br>
            <input type="text" name= "s_address" placeholder = "ADDRESS" value="<?php echo($s_address)?>"><br><br>
            <input type="text" name= "s_email" placeholder = "youjizz2020@rocketmail.com" value="<?php echo($s_email)?>"><br><br>
            <br><br>

            <div>
                <input type="submit" name="insert" value="Add">
                <input type="submit" name="delete" value="Delete">
                <input type="submit" name="update" value="Update">
                <input type="submit" name="search" value="Find" >

            </div>
            </form>
    </body>
</html>
