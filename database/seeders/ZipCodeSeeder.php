<?php

namespace Database\Seeders;

use App\Models\ZipCode;
use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;
use Str;

class ZipCodeSeeder extends Seeder
{

  /**
   * Run the database seeds.
   *
   * @return void
   * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
   */
  public function run(): void
  {
    $source_path = base_path('CPdescarga.txt');

    File::lines($source_path)
      ->mapToGroups(
        function (string $line) {
          $zip_code = explode('|', Str::ascii($line));

          return $this->buildDataArray($zip_code);
        }
      )->each(
        function (LazyCollection $zip_codes) {
          $zip_code = $zip_codes->first();

          $settlements = $zip_codes->map(
            function (array $zip_code) {
              return $zip_code['settlements'];
            }
          );

          $zip_code['settlements'] = json_encode($settlements->all());

          ZipCode::create($zip_code);
        }
      );
    //dd($zip_codes->first());

  }

  /**
   * @param  array  $zip_code
   *
   * @return array[]
   */
  private function buildDataArray(array $zip_code): array
  {
    return [
      $zip_code[0] => [
        'id'                  => (int)$zip_code[0],
        'zip_code'            => (string)($zip_code[0]),
        'locality'            => strtoupper($zip_code[5]),
        'federal_entity_key'  => (int)$zip_code[7],
        'federal_entity_name' => strtoupper($zip_code[4]),
        'federal_entity_code' => $zip_code[9] == '' ? null : $zip_code[9],
        'settlements'         => [
          'key'             => (int)$zip_code[12],
          'name'            => strtoupper($zip_code[1]),
          'zone_type'       => strtoupper($zip_code[13]),
          'settlement_type' => ['name' => $zip_code[2]],
        ],
        'municipality_key'    => (int)$zip_code[11],
        'municipality_name'   => strtoupper($zip_code[3]),
      ],
    ];
  }

}
