<?php
error_reporting(E_ALL ^ E_DEPRECATED);

class Default_CekController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        
    }
    
    
    public function historyAction()
    {
        // action body
    
    }



    
    public function cekAction()
    {

    }
    
    
    public function adminAction()
    {
    
    }
    
    
    
    public function hasilAction(){
        
        $databaseHost = 'localhost';
        $databaseName = 'data';
        $databaseUsername = 'root';
        $databasePassword = '';
        
        $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
        
   

     
 
    }
    
    public function bayarAction(){
    
        $databaseHost = 'localhost';
        $databaseName = 'data';
        $databaseUsername = 'root';
        $databasePassword = '';
    
        $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
    
    
    
         
    
    }
    

    
    
    
    
    
    
    
    public function konfirmasiAction()
    {
        
    }


    

}

