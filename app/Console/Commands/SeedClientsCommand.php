<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SeedClientsCommand extends Command
{
    protected $signature = 'seed:clients {total=100}';

    protected $description = 'Popula a tabela clients com muitos registros fake';

    public function handle()
    {
        $faker = Faker::create('pt_BR');

        $total = (int) $this->argument('total');
        $batchSize = 100;

        $this->info("🔄 Iniciando inserção de {$total} registros...");

        $states = ['SP', 'RJ', 'MG', 'BA', 'RS', 'SC', 'PR', 'GO', 'PE', 'CE', 'DF'];

        for ($i = 0; $i < $total; $i += $batchSize) {

            $batch = [];

            for ($j = 0; $j < $batchSize && ($i + $j) < $total; $j++) {

                $state = $faker->randomElement($states);

                $batch[] = [
                    'name' => $faker->company,
                    'email' => $faker->unique()->companyEmail,
                    'phone' => preg_replace('/\D/', '', $faker->phoneNumber),
                    'cpf' => null,
                    'cnpj' => self::generateCnpj(),
                    'cep' => preg_replace('/\D/', '', $faker->postcode),
                    'state' => $state,
                    'city' => $faker->city,
                    'street' => $faker->streetName,
                    'number' => (string) $faker->buildingNumber,
                    'complement' => $faker->optional()->secondaryAddress,
                    'agreed' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('clients')->insert($batch);

            $this->info("✔ Inseridos " . min($i + $batchSize, $total) . " registros...");
        }

        $this->info("🎉 Finalizado! Total de registros inseridos: {$total}");

        return 0;
    }

    /**
     * Gera CNPJ válido
     */
    private static function generateCnpj()
    {
        $n = [];

        for ($i = 0; $i < 12; $i++) {
            $n[$i] = rand(0, 9);
        }

        $d1 = 0;
        $p = 5;
        for ($i = 0; $i < 12; $i++) {
            $d1 += $n[$i] * $p;
            $p = ($p == 2) ? 9 : $p - 1;
        }
        $d1 = ($d1 % 11 < 2) ? 0 : 11 - ($d1 % 11);

        $d2 = 0;
        $p = 6;
        for ($i = 0; $i < 12; $i++) {
            $d2 += $n[$i] * $p;
            $p = ($p == 2) ? 9 : $p - 1;
        }
        $d2 += $d1 * 2;
        $d2 = ($d2 % 11 < 2) ? 0 : 11 - ($d2 % 11);

        return implode('', $n) . $d1 . $d2;
    }
}
