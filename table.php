<?php 
  // DataTables server-side processing SQL query
  require( './file/ssp.class.php' );
  ini_set ('memory_limit',  '2048M');
  //服务器和数据库
  $sql_details = array(
    'host' => 'localhost',
    'user' => 'StructRMDB',
    'pass' => 'StructRMDB@2024',
    'db'   => 'structrmdb'
  );
  //选择数据库中的表格
  $species = $_GET["sp"];
  $modification = $_GET["mf"];
  $software = $_GET["sw"];
  $table = $modification."_".$species."_".$software;
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
    array( 'db' => 'SNP_Num', 'dt' => 'SNP_Num' ),
    array( 'db' => 'jbrowse', 'dt' => 'jbrowse' )
  );

  // 获得前台的选择
  $Software=$_GET["sw"];
  $rt=$_GET["rt"];
  $Classification=$_GET["Classification"];
  $gn=$_GET["gn"];
  $gr=$_GET["gr"];
  $gt=$_GET["gt"];

  // 根据前台的选择显示表格
  $whereAll = "StruRM_ID IS NOT NULL".$_GET["similarity_val"].$_GET["relative_val"].$_GET["distance_val"].$_GET["smc_val"];

  if($Software!="all"){
    $whereAll = $whereAll." "."AND Software LIKE '%{$Software}%'";  
  };

  if($rt!="all"){
    $whereAll = $whereAll." "."AND RNA_type LIKE '%{$rt}%'";  
  };

  if (!empty($Classification)) {
    $whereAll .= " AND (" . implode(" OR ", $Classification) . ")";
  }

  if($gn!="" or $gn != null){
    $whereAll = $whereAll." "."AND Gene_name IN ('".implode("','", $gn)."')";  
  };

  if (!empty($gr)) {
    $whereAll .= " AND (" . implode(" OR ", $gr) . ")";
  }

  if (!empty($gt)) {
    $whereAll .= " AND (" . implode(" OR ", $gt) . ")";
  }

  echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereAll )
  );


?>