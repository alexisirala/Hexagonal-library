<?php

namespace App\Http\Controllers\Api;

use App\Application\Book\BookService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(): JsonResponse
    {
        try {
            $books = $this->bookService->getAllBooks();

            if (empty($books)) {
                return response()->json(['message' => 'No existen libros'], Response::HTTP_OK);
            }

            // Convertir cada libro a array de forma más segura
            $booksArray = [];
            foreach ($books as $book) {
                $booksArray[] = $book->toArray();
            }

            return response()->json($booksArray);
        } catch (\Exception $e) {
            \Log::error('Error in index method: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch books', 'details' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $book = $this->bookService->getBookById($id);
            
            if (!$book) {
                return response()->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($book->toArray());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch book'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|unique:books,isbn|max:13',
                'quantity' => 'required|integer|min:0'
            ]);

            $book = $this->bookService->createBook(
                $validated['title'],
                $validated['author'],
                $validated['isbn'],
                $validated['quantity']
            );

            return response()->json($book, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create book'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|max:13|unique:books,isbn,' . $id . ',id',
                'quantity' => 'required|integer|min:0'
            ]);

            $book = $this->bookService->updateBook(
                $id,
                $validated['title'],
                $validated['author'],
                $validated['isbn'],
                $validated['quantity']
            );

            if (!$book) {
                return response()->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update book'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $deleted = $this->bookService->deleteBook($id);

            if (!$deleted) {
                return response()->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete book'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function borrow(string $id): JsonResponse
    {
        try {
            $book = $this->bookService->getBookById($id);

            if (!$book) {
                return response()->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
            }

            if ($book->quantity <= 0) {
                return response()->json(['error' => 'No copies available to borrow'], Response::HTTP_BAD_REQUEST);
            }

            $book = $this->bookService->updateBookQuantity($id, $book->quantity - 1);

            return response()->json(['message' => 'Book borrowed successfully', 'book' => $book]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to borrow book'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function return(string $id): JsonResponse
    {
        try {
            $book = $this->bookService->getBookById($id);

            if (!$book) {
                return response()->json(['error' => 'Book not found'], Response::HTTP_NOT_FOUND);
            }

            $book = $this->bookService->updateBookQuantity($id, $book->quantity + 1);

            return response()->json(['message' => 'Book returned successfully', 'book' => $book]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to return book'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}