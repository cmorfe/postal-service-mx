<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

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
    if (File::missing(storage_path('zip_codes.php')) || true) {
      $zip_codes = File::lines(base_path('CPdescarga.txt'))
        ->take(20)
        ->mapToGroups(
          function (string $line, $key) {
            $zip_code = explode('|', $line);

            if ($key > 1 && count($zip_code) > 1) {
              return [
                $zip_code[0] => [
                  'zip_code'       => $zip_code[0],
                  'locality'       => $zip_code[5],
                  'federal_entity' => [
                    'key'  => $zip_code[7],
                    'name' => $zip_code[4],
                    'code' => $zip_code[9],
                  ],
                  'settlements'    => [
                    [
                      'key'             => $zip_code[12],
                      'name'            => $zip_code[1],
                      'zone_type'       => $zip_code[13],
                      'settlement_type' => [
                        'name' => $zip_code[2],
                      ],
                    ],
                  ],
                  'municipality'   => [
                    'key'  => $zip_code[11],
                    'name' => $zip_code[3],
                  ],
                ],
              ];
            }

            return [];
          }
        )->reject(function ($value, $key) {
          return $key == '';
        });

      File::put(
        storage_path('zip_codes.php'),
        "<?php \$zip_codes = unserialize('" . serialize(
          $zip_codes->toArray()
        ) . "');" . PHP_EOL
      );
    }
  }

}
