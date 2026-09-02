<?php

namespace App\Services;

use App\Models\Option;
use App\Models\Payload;
use App\Models\Section;

class FormImporter
{
    // function helper untuk mencari json dan menyesuaikan untuk menjadi sebuah dynamic form
    public function import()
    {
        $json = file_get_contents(
            storage_path('app/feeds/form.json')
        );

        $data = json_decode($json, true);

        // membaca file json dan masukan ke section 
        foreach ($data as $section) {
            Section::updateOrCreate(
                [
                    'id' => $section['id'],
                ],
                [
                    'name' => $section['name'],
                ]
            );

            // membaca data dan masukan data payloads
            foreach ($section['payloads'] as $payload) {
              Payload::updateOrCreate(
                [
                  'id'=> $payload['id'],
                ],
                [
                  'section_id' => $section['id'],
                  'label' => $payload['label'],
                  'type' => $payload['type'],
                  'sub_type' => $payload['sub_type'] ?? null,
                  'description' => $payload['description'] ?? null,
                ]
              );

              foreach($payload['options'] as $option) {
                Option::updateOrCreate(
                  [
                    'id'=>$option['id'],
                  ],
                  [
                    'payload_id'=>$payload['id'],
                    'label'=>$option['label'],
                    'value'=>$option['value'] ?? null,
                  ],
                );
              }
            }
        }

        return $data;
    }
}