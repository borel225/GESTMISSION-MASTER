<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'test@example.com',
            'password' => bcrypt('1234567890')
        ]);

       DB::table('lieus')->insert([
        ['id'=>1, 'libelle' => 'Abidjan','type_lieu'=>'ville','parent_id'=>null,'created_at'=>now()],
        ['id'=>2, 'libelle' => 'Yamoussoukro','type_lieu'=>'ville','parent_id'=>null,'created_at'=>now()],
        ['id'=>3, 'libelle' => 'Bouaké','type_lieu'=>'ville','parent_id'=>null,'created_at'=>now()],
        ['id'=>4, 'libelle' => 'Daloa','type_lieu'=>'ville','parent_id'=>null,'created_at'=>now()],
        ['id'=>5, 'libelle' => 'Mali','type_lieu'=>'pays','parent_id'=>null,'created_at'=>now()],

       ]);


       DB::table('fonctions')->insert([
        ['id'=>1, 'libelle' => 'Directeur Adjoint','created_at'=>now()],
        ['id'=>2, 'libelle' => 'chef de service','created_at'=>now()],
        ['id'=>3, 'libelle' => 'chef de cellule développement','created_at'=>now()],
        ['id'=>4, 'libelle' => 'Assistant développeur','created_at'=>now()],
        ['id'=>5, 'libelle' => 'Maintenancier ','created_at'=>now()],

       ]);


       DB::table('services')->insert([
        ['id'=>1, 'libelle' => ' DDRCI','created_at'=>now()],
        ['id'=>2, 'libelle' => 'DDCI','created_at'=>now()],
        ['id'=>3, 'libelle' => 'DCI','created_at'=>now()],
        ['id'=>4, 'libelle' => 'Assistant développeur','created_at'=>now()],
        ['id'=>5, 'libelle' => 'Maintenancier ','created_at'=>now()],

       ]);

       DB::table('agents')->insert([
        ['id'=>1, 'nom' => 'GNAGNE','prenom' => 'MICHEL','matricule' => '100AZ','service_id' => 1,'fonction_id' => 1,'created_at'=>now()],
        ['id'=>2, 'nom' => 'KOFFI','prenom' => 'LOUKOU ALBERT','matricule' => '101AZ','service_id' => 2,'fonction_id' => 2,'created_at'=>now()],
        ['id'=>3, 'nom' => 'SOUMAHORO','prenom' => 'KADY','matricule' => '102AZ','service_id' => 3,'fonction_id' => 3,'created_at'=>now()],
        ['id'=>4, 'nom' => 'BAH','prenom' => 'ZRAN LOUIS','matricule' => '103AZ','service_id' => 1,'fonction_id' => 4,'created_at'=>now()],
        ['id'=>5, 'nom' => 'AKE','prenom' => 'DANHO JULES','matricule' => '104AZ','service_id' => 2,'fonction_id' => 5,'created_at'=>now()],

       ]);

       DB::table('missions')->insert([
        ['id'=>1,'libelle' => 'Test Mission 1','objectif' => 'Test Objectif 1','interet' => 'Test Interet 1','tdr' => 'testfile.pdf','date_depart' => '2024-08-21','date_retour' => '2024-08-22','observation' => 'Test Observation','destination_arrivee_id' => 1,'destination_depart_id' => 2,'created_at'=>now()],
        ['id'=>2,'libelle' => 'Test Mission 2','objectif' => 'Test Objectif 2','interet' => 'Test Interet 2','tdr' => 'testfile.pdf','date_depart' => '2024-09-21','date_retour' => '2024-09-22','observation' => 'Test Observation 2','destination_arrivee_id' => 2,'destination_depart_id' => 3,'created_at'=>now()],
        ['id'=>3,'libelle' => 'Test Mission 3','objectif' => 'Test Objectif 3','interet' => 'Test Interet 3','tdr' => 'testfile.pdf','date_depart' => '2024-10-21','date_retour' => '2024-10-22','observation' => 'Test Observation 3','destination_arrivee_id' => 4,'destination_depart_id' => 5,'created_at'=>now()],
         ]);

    }

}
