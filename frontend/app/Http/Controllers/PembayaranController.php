<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembayaranController extends Controller
{
  //
  public static function getPayments()
  {
    $token = TokenController::get();
    if ($token) {
      $response = Http::withHeaders([
        'X-API-TOKEN' => $token
      ])->get('http://localhost:3000/api/pembayaran/admin');

      return $response->json();
    }
  }
}
