<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Traits\GetOne;


class BookController extends Controller
{

    use GetOne;

    /**
     * Display a listing of the resource.
     */
    public function getBooks()
    {
        $data = Book::all();

        return jsonResponse($data, 'list of all the books', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createBook(Request $request)
    {

        if ($request->image_path) {
            $newImageName = time() . '-' . $request->title . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('BookImages'), $newImageName);
        }

        $data = Book::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'image_path' => $newImageName ?? null
        ]);



        return jsonResponse($data, 'Book has been created sucesfully', 201);
    }

    /*** Display the specified resource.*/
    public function showBook($id)
    {
        $data = $this->GetOne(Book::class, $id);

        return jsonResponse($data, 'Book was found', 200);
    }

    /*** Update the specified resource in storage.*/
    public function updateBook(Request $request, $id)
    {
        $data = $this->GetOne(Book::class, $id);

        if ($request->hasFile('image_path')) {
            if ($data->image_path) {
                $filePath = public_path('BookImages/' . $data->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Upload new image
            $newImageName = time() . '-' . $request->title . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('BookImages'), $newImageName);

            $data->image_path = $newImageName;
        }

        $data->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'image_path' => $data->image_path ?? null
        ]);

        return jsonResponse($data, 'Data was updated', 201);
    }

    /*** Delete the specified resource in storage.*/

    public function deleteBook($id)
    {
        $data = $this->GetOne(Book::class, $id);

        Book::destroy($id);
        return jsonResponse($data, 'Book was deleted', 200);
    }
}
