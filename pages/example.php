<?php
    include("class.ipdetails.php");
    $ip = $_SERVER['REMOTE_ADDR'];  
#echo $ip;    
    $ip = "189.27.16.98";
    $ipdetails = new ipdetails($ip); 
    $ipdetails->scan();
    echo "<b>IP:</b>        ".$ip                        ."<br />"; 
    echo "<b>País:</b>      ".$ipdetails->get_country()  ."<br />";
    echo "<b>Estado:</b>    ".$ipdetails->get_region()   ."<br />";
    echo "<b>Cidade:</b>    ".$ipdetails->get_city()     ."<br />";
    echo "<b>Latitude:</b>  ".$ipdetails->get_latitude() ."<br />";
    echo "<b>Longitude:</b> ".$ipdetails->get_longitude()."<br />";
    echo "<b>Código país:</b> ".$ipdetails->get_countrycode()."<br />";
    echo "<b>Código continente:</b> ".$ipdetails->get_continentcode()."<br />";
    echo "<b>Código moeda:</b> ".$ipdetails->get_currencycode()."<br />";
    echo "<b>Símbolo moeda:</b> ".htmlspecialchars_decode($ipdetails->get_currencysymbol())."<br />";
    echo "<b>Cotação moeda (dólar):</b> ".$ipdetails->get_currencyconverter()."<br />";    
?>