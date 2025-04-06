<?php

namespace App\Http\Controllers;

use App\Infrastructure\Persistence\Eloquent\BookModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = BookModel::all();
        \Log::info('Books retrieved:', $books->toArray());
        return response()->json($books);
    }
}
