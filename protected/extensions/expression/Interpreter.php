<?php
class Interpreter 
{ 
 function execute($string) 
 { 
  $expression = null; 
  for($i = 0;$i<strlen($string);$i++) { 
  $temp = $string[$i]; 
  switch(true) 
  { 
   case is_numeric($temp): $expression = new ExpressionNum(); break; 
   default: $expression = new ExpressionCharater(); break;
  } 
  echo $expression->interpreter($temp); 
  } 
 } 
}