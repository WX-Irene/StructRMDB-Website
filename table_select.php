<?php
ini_set ('memory_limit',  '2048M');

// 获得前台的选择
$species = $_GET["sp"];
$modification = $_GET["mf"];
$software = $_GET["sw"];
$table = $modification."_".$species."_".$software;

try {
	$db =new PDO("mysql:host=localhost; dbname=structrmdb", "StructRMDB", "StructRMDB@2024");
	// 被筛选的数据

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

  $select_query = "SELECT
      Gene_name
  FROM $table
  WHERE $whereAll";
  $select_data = $db->prepare($select_query);
  $select_data->execute();
  $cart = array();

  while ($user = $select_data->fetch(PDO::FETCH_ASSOC)) {
    $cart[] = array(
      'Gene_name' => $user["Gene_name"]
    );
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

$Gene_name_arr = array();
$Gene_name_data = array();

foreach ($cart as $val) {
  $Gene_name_arr[] = $val['Gene_name'];
}

$Gene_name_data = array_unique($Gene_name_arr);

$all_data = array(
  "Gene_name_data" => $Gene_name_data
);

echo json_encode($all_data);

?>