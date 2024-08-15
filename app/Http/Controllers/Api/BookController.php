<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->responser
            ->setData(Book::orderByDesc('updated_at')->get())
            ->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'genre' => ['nullable'],
            'author' => ['nullable'],
        ]);
        if ($validator->fails()) {
            $this->responser
                ->setValidationMessage($validator->messages()->toArray())
                ->setAsValidationFails();
        } else {
            try {
                DB::beginTransaction();
                $book = new Book();
                $book->title = $request->title;
                $book->genre = $request->genre;
                $book->author = $request->author;
                $book->save();
                DB::commit();

                $this->responser
                    ->setData($book)
                    ->setAsSuccess();
            } catch (\Throwable $th) {
                DB::rollBack();

                $this->responser
                    ->setErrorMessage($th->getMessage())
                    ->setAsServerFailure();
            }
        }

        return $this->responser->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if (!(bool)$book) {
            return $this->responser->setAsNotFound()->send();
        }

        return $this->responser->setData($book)->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if (!(bool)$book) {
            return $this->responser
                ->setAsNotFound()
                ->send();
        }

        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'genre' => ['nullable'],
            'author' => ['nullable'],
        ]);
        if ($validator->fails()) {
            $this->responser
                ->setValidationMessage($validator->messages()->toArray())
                ->setAsValidationFails();
        } else {
            try {
                DB::beginTransaction();
                $book->title = $request->title;
                $book->genre = $request->genre;
                $book->author = $request->author;
                $book->save();
                DB::commit();

                $this->responser
                    ->setAsSuccess()
                    ->setData($book);
            } catch (\Throwable $th) {
                DB::rollBack();

                $this->responser
                    ->setAsServerFailure()
                    ->setErrorMessage($th->getMessage());
            }
        }

        return $this->responser->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
