<?php
ini_set ('memory_limit',  '2048M');

// 获得前台的选择
$sp = $_GET["sp"];
$mf = $_GET["mf"];
$table = $sp."_".$mf;
$table;

try {
  $db =new PDO("mysql:host=localhost; dbname=structrmdb", "StructRMDB", "StructRMDB@2024");

  // 根据前台的选择显示表格
  $whereAll = "StructRMID IS NOT NULL";

  $select_query = "SELECT
      Gene_name,
      Gene_id,
      seqnames
  FROM $table
  WHERE $whereAll";
  $select_data = $db->prepare($select_query);
  $select_data->execute();
  $cart = array();

  while ($user = $select_data->fetch(PDO::FETCH_ASSOC)) {
    $cart[] = array(
      'Gene_name' => $user["Gene_name"],
      'Gene_id' => $user["Gene_id"],
      'seqnames' => $user["seqnames"]
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

$Gene_id_arr = array();
$Gene_id_data = array();
foreach ($cart as $val) {
  $Gene_id_arr[] = $val['Gene_id'];
}
$Gene_id_data = array_unique($Gene_id_arr);

$Region_arr = array();
$Region_data = array();
foreach ($cart as $val) {
  $Region_arr[] = $val['seqnames'].':200000..500000';
}
$Region_data = array_unique($Region_arr);
sort($Region_data);

$all_data = array(
  "Region_data" => $Region_data,
  "Gene_name" => $Gene_name_data,
  "Gene_id" => $Gene_id_data
);

echo json_encode($all_data);
?>