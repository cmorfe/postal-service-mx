<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;

class LoadPostServiceData extends Command
{

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'post-service-data:load';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Load post service data from file';

  /**
   * Execute the console command.
   *
   * @return void
   * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
   */
  public function handle(): void
  {
    $source_path = base_path('CPdescarga.txt');

    $target_path = storage_path('zip_codes.php');

    if (File::missing($target_path)) {
      $zip_codes = File::lines($source_path)
        ->mapToGroups(
          function (string $line) {
            $zip_code = explode('|', $line);

            return $this->buildDataArray($zip_code);
          }
        )->mapWithKeys(
          function (LazyCollection $zip_codes, $key) {
            $value = $zip_codes->first();

            if ($zip_codes->count() > 1) {
              $value['settlements'] = $zip_codes->map(
                function (array $zip_code) {
                  return $zip_code['settlements'];
                }
              );
            }

            return [$key => $value];
          }
        )->sortKeys();

      $zip_codes = $zip_codes->toJson();

      $contents
        = "<?php \$zip_codes = Illuminate\\Support\\LazyCollection::make(json_decode('$zip_codes'));";

      File::put($target_path, $contents);
    }
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
        'zip_code'       => $zip_code[0],
        'locality'       => strtoupper($zip_code[5]),
        'federal_entity' => [
          'key'  => (int)$zip_code[7],
          'name' => strtoupper($zip_code[4]),
          'code' => $zip_code[9] == '' ? null : $zip_code[9],
        ],
        'settlements'    => [
          'key'             => (int)$zip_code[12],
          'name'            => strtoupper($zip_code[1]),
          'zone_type'       => strtoupper($zip_code[13]),
          'settlement_type' => [
            'name' => $zip_code[2],
          ],
        ],
        'municipality'   => [
          'key'  => (int)$zip_code[11],
          'name' => strtoupper($zip_code[3]),
        ],
      ],
    ];
  }
}
