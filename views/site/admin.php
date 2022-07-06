<?php
use yii\helpers\Html;

echo('URLS:') . '<br />' . '<br />' ;

foreach($urls as $key => $row){
    echo('Create_at: ');
    echo  $row['create_at'] . '<br />' ; 

    echo('Url: ');
    echo  $row['url'] . '<br />' ; 

    echo('Frequency: ');
    echo  $row['frequency'] . '<br />' ; 

    echo('Count: ');
    echo  $row['count'] . '<br />' ; 

    echo '<br />' ; 
  }

  echo('-------------------------------') . '<br />';
  echo('CHECKS:') . '<br />' . '<br />' ;

  foreach($checks as $key => $row){
    echo('Check date: ');
    echo  $row['date'] . '<br />' ; 

    echo('Url: ');
    echo  $row['url'] . '<br />' ; 

    echo('Code: ');
    echo  $row['code'] . '<br />' ; 

    echo('Try: ');
    echo  $row['try'] . '<br />' ; 

    echo '<br />' ; 
  }
?>
