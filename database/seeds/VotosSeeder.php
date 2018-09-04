<?php

use Illuminate\Database\Seeder;
use App\Voto;
class VotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votos')->truncate();
        
        foreach (range(1, 25) as $i){
            
            Voto::create([
                'numero' => $i,
                'votos' => 0
                
            ]);
        }
    }
    public function seed(){
        $this->run();
    }
}
