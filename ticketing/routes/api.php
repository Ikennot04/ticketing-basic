<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ticket\API\TicketController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::post('/ticket/add', [TicketController::class, 'createTickets']);
Route::get('/tickets', [TicketController::class, 'findAll']);
Route::post('/update/tickets', [TicketController::class, 'updateTicket']);
Route::delete('/delete/tickets/{id}', [TicketController::class, 'destroy']);