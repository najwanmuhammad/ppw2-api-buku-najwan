<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index()
    {
        $books = Buku::latest()->paginate(5);
        return new BookResource(true, 'List data buku', $books);
    }

    public function show($id)
    {
        $book = Buku::findOrFail($id);
        return new BookResource(true, 'Book found', $book);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tahun_terbit' => 'required|string'
        ]);

        $decodedArray = json_decode($request, true);

        $new_tahun_terbit = "2024-12-12"; //strtotime ($decodedArray['tahun_terbit']);
        // $validatedData = [
        //     'judul' => $decodedArray['judul'],
        //     'penulis' => $decodedArray['penulis'],
        //     'harga' => $decodedArray['harga'],
        //     'tahun_terbit' => $new_tahun_terbit
        // ];
        echo $decodedArray;
        $book = Buku::create($validatedData);
        // $book->save();
        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully',
        ]);

        // return new BookResource(true, 'Book created successfully', $book);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
           'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tahun_terbit' => 'required|string'
        ]);

        $book = Buku::findOrFail($id);
        $book->update($validatedData);

        return new BookResource(true, 'Book updated successfully', $book);
    }

    public function destroy($id)
    {
        $book = Buku::findOrFail($id);
        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully',
        ]);
    }
}
