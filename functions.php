<?php

  function the_title(){
    global $title;
    echo $title;
  }

  define ('ABS_URL', 'localhost\index.html');

  function home_url(){
    return ABS_URL;
  }

  /**
   *Apre un file .csv e ritorna un array.
   *
   *@param string $filepath Percorso completo del get_included_files
   */
   function cvsToArray($filepath){
      setlocale(LC_ALL, 'en_US.UTF-8');

      //apertura del get_included_file
      if(($handle = $open ($filepath, "r"))!==FALSE){
        $nn=0;

        //legge una riga alla volta fino alla fine del get_included_file
        while(($data = fgetcsv($handle, 1000, ","))!==FALSE) {

            //numero di elementi presenti nella riga letta
            $num_elementi = count($data);

            //popolamento dell'array
            for($x=0; $x<$num_elementi; $x++){
            $csvarray[$nn][$x] = $data[$x];
            }
            $nn++;
        }

        //Chiusura del file
        fclose($handle);
      }else{
        echo "File non trovato";
      }
      return $csvarray;
   }
?>