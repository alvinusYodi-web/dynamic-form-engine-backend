<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Models\Answer;
use App\Models\RiskEvent;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

  // mengambil struktur form dari database dan mengembalikanya melalui API
  public function index()
  {
      $sections = Section::with('payloads.options')
          ->get()
          ->map(function ($section) {
              return [
                  'id' => $section->id,
                  'name' => $section->name,
                  'payloads' => $section->payloads->map(function ($payload) {
                      return [
                          'id' => $payload->id,
                          'label' => $payload->label,
                          'type' => $payload->type,
                          'sub_type' => $payload->sub_type,
                          'description' => $payload->description,
                          'options' => $payload->options->map(function ($option) {
                              return [
                                  'id' => $option->id,
                                  'label' => $option->label,
                                  'value' => $option->value,
                              ];
                          }),
                      ];
                  }),
              ];
          });

      return response()->json($sections);
  }

  // Memvalidasi dan menyimpan jawaban form beserta pilihanan yang di pilih
  public function store(StoreFormRequest $request)
  {
      $data = $request->validated();

      $riskEvent = DB::transaction(function () use ($data) {

          $riskEvent = RiskEvent::create();

          foreach ($data['answers'] as $answerData) {
              $answer = Answer::create([
                  'risk_event_id' => $riskEvent->id,
                  'payload_id' => $answerData['payload_id'],
                  'value' => $answerData['value'] ?? null,
              ]);

              if (!empty($answerData['option_ids'])) {
                  $answer->options()->attach(
                      $answerData['option_ids']
                  );
              }
          }

          return $riskEvent;
      });

      return response()->json([
          'message' => 'Form berhasil disubmit',
          'data' => $riskEvent,
      ], 201);
  }
  
}