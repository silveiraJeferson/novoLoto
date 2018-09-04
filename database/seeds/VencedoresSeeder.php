<?php

use Illuminate\Database\Seeder;
use App\Concurso;
class VencedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('concursos')->truncate();
        
        foreach (range(1, 10) as $i){            
            Concurso::create([                
                'concurso' => $i,
                'dezenas' => $this->getDezenas()                
            ]);
        }       
    }
    public function getDezenas(){
        $array = [];
        foreach(range(0,14) as $i){                   
            do{
                $numero = rand(1,25);
                $flag = $this->repeat($array, $numero);
            }while($flag);
//            --------------------------incrementando tabela votos
            DB::table('votos')->where('numero', $numero)->increment('votos');
            $array[] = $numero;            
        }
        sort($array);
        return json_encode($array);
    }
    public function repeat($array, $numero){
        foreach($array as $dezena){
            if($dezena == $numero){
                return  true;
            }
        }
        return false;
    }
}
