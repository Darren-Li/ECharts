<?php

// Connect to MySQL
$link = mysql_connect( 'localhost','root', '' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'echarts', $link );
if ( !$db ) {
  die ( 'Error selecting database \'echarts\' : ' . mysql_error() );
}

// Fetch the data
$query = "select source, target, value from sankey_data";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "source": "' . $row['source'] . '",' . "\n";
  echo '  "target": "' . $row['target'] . '",' . "\n";
  echo '  "value": "' . $row['value'] . '"' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close($link);
?>