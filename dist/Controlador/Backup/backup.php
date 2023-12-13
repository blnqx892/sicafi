<?php
session_start();
$host="localhost";
$username="root";
$password="";
$database_name="sicafi";

$conn=mysqli_connect($host,$username,$password,$database_name);

$tables=array();
$sql="SHOW TABLES";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_row($result)){
    $tables[]=$row[0];
}

$backupSQL="SET FOREIGN_KEY_CHECKS=0;"."\n\n";
foreach($tables as $table){
    $query="SHOW CREATE TABLE $table";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_row($result);
    $backupSQL.='DROP TABLE IF EXISTS '.$table.' CASCADE;';
    $backupSQL.="\n\n".$row[1].";\n\n";

    $query="SELECT * FROM $table";
    $result=mysqli_query($conn,$query);

    $columnCount=mysqli_num_fields($result);

    for($i=0;$i<$columnCount;$i++){
        while($row=mysqli_fetch_row($result)){
            $backupSQL.="INSERT INTO $table VALUES(";
                for($j=0;$j<$columnCount;$j++){
                    $row[$j]=$row[$j];

                    if(isset($row[$j])){
                        $backupSQL.='"'.$row[$j].'"';
                    }else{
                        $backupSQL.='""';
                    }
                    if($j<($columnCount-1)){
                        $backupSQL.=',';
                    }
                }
                $backupSQL.=");\n";
}
}
$backupSQL.="\n\n";
}
$backupSQL.="SET FOREIGN_KEY_CHECKS=1;"."\n\n";
if(!empty($backupSQL)){
  $ruta="db/";
$backup_file_name=$ruta.$database_name.date("_Y-m-d").'.sql';
$fileHandler=fopen($backup_file_name,'w+');
$number_of_lines=fwrite($fileHandler,$backupSQL);
fclose($fileHandler);
echo"
    <script language='javascript'>
    alert('Se genero un respaldo con exito')
    type: 'danger'
    window.location='../../Back.php'
    </script>";
}

?>
