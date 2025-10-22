<?php 
  // DataTables server-side processing SQL query
  require( './file/ssp.class.php' );
  ini_set ('memory_limit',  '2048M');
  header('content-type:application/json;charset=utf8');
  //服务器和数据库
  $sql_details = array(
    'host' => 'localhost',
    'user' => 'StructRMDB',
    'pass' => 'StructRMDB@2024',
    'db'   => 'structrmdb'
  );
  // 选择主键
  $primaryKey = 'StruRM_ID';
  // 选择需要显示的列
  $columns = array(
    array( 'db' => 'StruRM_ID', 'dt' => 'StruRM_ID' ),
    array( 'db' => 'ID', 'dt' => 'ID' ),
    array( 'db' => 'Modification', 'dt' => 'Modification' ),
    array( 'db' => 'Species', 'dt' => 'Species' ),
    array( 'db' => 'seqnames', 'dt' => 'seqnames' ),
    array( 'db' => 'start', 'dt' => 'start' ),
    array( 'db' => 'Gene_name', 'dt' => 'Gene_name' ),
    array( 'db' => 'Region', 'dt' => 'Region' ),
    array( 'db' => 'Bio_type', 'dt' => 'Bio_type' ),
    array( 'db' => 'RNA_type', 'dt' => 'RNA_type' ),
    array( 'db' => 'Software', 'dt' => 'Software' ),
    array( 'db' => 'category', 'dt' => 'category' ),
    array( 'db' => 'similarity_score', 'dt' => 'similarity_score' ),
    array( 'db' => 'relative_score', 'dt' => 'relative_score' ),
    array( 'db' => 'forester_distance', 'dt' => 'forester_distance' ),
    array( 'db' => 'smcscore', 'dt' => 'smcscore' ),
    array( 'db' => 'RBP_Num', 'dt' => 'RBP_Num' ),
    array( 'db' => 'miRNA_Num', 'dt' => 'miRNA_Num' ),
    array( 'db' => 'SNP_Num', 'dt' => 'SNP_Num' )
  );

  // 获得前台的选择
  $species=$_GET["species"];
  $modification=$_GET["modification"];
  $software=$_GET["software"];
  $table=$modification."_".$species."_".$software;

  $region=$_GET["gene_region"];
  $StructRM_ID=$_GET["StructRM_ID"];
  $ID=$_GET["ID"];

  // 根据前台的选择显示表格
  $whereAll = "StruRM_ID IS NOT NULL";

  if ($region != null) {
    if ($region == "3' UTR") {
      $region = "3";
      $whereAll = $whereAll." "."AND Region LIKE '%{$region}%'";      
    } elseif ($region == "5' UTR") {
      $region = "5";
      $whereAll = $whereAll." "."AND Region LIKE '%{$region}%'";    
    } else {
      $whereAll = $whereAll." "."AND Region LIKE '%{$region}%'";
    }
  }

  if ($StructRM_ID != null) {
    $whereAll = $whereAll." "."AND StruRM_ID = '{$StructRM_ID}'";
  }

  if ($ID != null) {
    $whereAll = $whereAll." "."AND ID = '{$ID}'";
  }
  $whereAll = $whereAll." "."limit 10000";

  echo json_encode(SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereAll),JSON_PRETTY_PRINT);


?>