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
      Region,
      RNA_type,
      category
  FROM $table
  WHERE $whereAll";
  $select_data = $db->prepare($select_query);
  $select_data->execute();
  $cart = array();

  while ($user = $select_data->fetch(PDO::FETCH_ASSOC)) {
    $cart[] = array(
      'Region' => $user["Region"],
      'RNA_type' => $user["RNA_type"],
      'category' => $user["category"]
    );
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

$region_arr = array();
$type_arr = array();
$category_arr = array();

foreach ($cart as $val) {
  $region_arr[] = $val['Region'];
  $type_arr[] = $val['RNA_type'];
  $category_arr[] = $val['category'];
}

$region_all = array("3'UTR","5'UTR","Exon","Intron");
$region_str = implode(',', $region_arr);
$region_count = array();
foreach ($region_all as $val) {
  $region_count[$val] = substr_count($region_str, $val);
}

$type_all = array("pre-RNA","mature-RNA");
$type_str = implode(',', $type_arr);
$type_count = array();
foreach ($type_all as $val) {
  $type_count[$val] = substr_count($type_str, $val);
}

$category_all = array("10%","50%","other","No_alteration");
$category_str = implode(',', $category_arr);
$category_count = array();
foreach ($category_all as $val) {
  $category_count[$val] = substr_count($category_str, $val);
}

$all_count = array(
  "region" => $region_count,
  "RNA_type" => $type_count,
  "category" => $category_count
);

echo json_encode($all_count);
?>