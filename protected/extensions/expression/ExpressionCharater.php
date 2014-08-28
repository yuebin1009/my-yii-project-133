<?php
class ExpressionCharater extends Expression 
{ 
 function interpreter($str) 
 { 
  return strtoupper($str); 
 } 
}