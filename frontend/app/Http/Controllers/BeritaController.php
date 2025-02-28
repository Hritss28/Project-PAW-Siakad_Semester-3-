<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BeritaController extends Controller
{
  //
  public static function getNews()
  {
    $token = TokenController::get();
    if ($token) {
      $response = Http::withHeaders([
        'X-API-TOKEN' => $token
      ])->get('http://localhost:3000/api/berita');

      return $response->json();
    }
  }
}
