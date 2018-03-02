<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller {

	public function redirect() {
		return redirect()->route( 'admin.books.index' );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index( Request $request ) {
//        $keyword = $request->get('search');
//        $perPage = 25;

//        if (!empty($keyword)) {
//            $books = Book::where('title', 'LIKE', "%$keyword%")
//                ->orWhere('content', 'LIKE', "%$keyword%")
//                ->orWhere('category', 'LIKE', "%$keyword%")
//                ->paginate($perPage);
//        } else {
//            $books = Book::paginate($perPage);
		$books = Book::get();

//        }

		return view( 'admin.books.index', compact( 'books' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return view( 'admin.books.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store( Request $request ) {

		$validatedData = $request->validate( [
			'title'   => 'required|max:100',
			'author'  => 'required|max:100',
			'edition' => 'required|max:100',
		] );

		$requestData = $request->only( 'title', 'author', 'edition' );
		try {
			Book::create( $requestData );

			return redirect()->route( 'admin.books.index' )
			                 ->withFlashSuccess( "Book '" . $requestData['title'] . "' added." );
		} catch ( \Exception $e ) {
			if ( $e->getCode() == 23000 ) {
				$msg = 'the book already exists.';
			} else {
				$msg = $e->getMessage();
			}

			$msg = "Unable to create book '" . $requestData['title'] . "': " . $msg;

			Log::error( $msg );
			$request->session()->flash( 'flash_warning', $msg );
		}

		return view( 'admin.books.create' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\View\View
	 */
	public function show( $id ) {
		$book = Book::find( $id );

		if ( ! $book ) {
			return redirect()->route( 'admin.books.index' )
			                 ->withFlashWarning( "Unable to show book: Book does not exist." );
		}

		return view( 'admin.books.show', compact( 'book' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\View\View
	 */
	public function edit( $id ) {
		$book = Book::find( $id );

		if ( ! $book ) {
			return redirect()->route( 'admin.books.index' )
			                 ->withFlashWarning( "Unable to edit: Book does not exist." );
		}

		return view( 'admin.books.edit', compact( 'book' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return mixed
	 */
	public function update( Request $request, $id ) {

		$book = Book::find( $id );

		if ( ! $book ) {
			return redirect()->route( 'admin.books.index' )
			                 ->withFlashWarning( "Unable to update book: Book does not exist." );
		}

		$validatedData = $request->validate( [
			'title'   => 'required|max:100',
			'author'  => 'required|max:100',
			'edition' => 'required|max:100',
		] );

		$oldbook     = clone $book;
		$requestData = $request->only( 'title', 'author', 'edition' );
		try {
			$book->update( $requestData );

			return redirect()->route( 'admin.books.index' )
			                 ->withFlashSuccess( "Book '" . $book->title . "' updated." );
		} catch ( \Exception $e ) {
			if ( $e->getCode() == 23000 ) {
				$msg = 'the book already exists.';
			} else {
				$msg = $e->getMessage();
			}

			$msg = "Unable to update book '" . $oldbook->title . "': " . $msg;

			Log::error( $msg );
			$request->session()->flash( 'flash_warning', $msg );
		}

		return view( 'admin.books.edit', compact( 'book' ) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return mixed
	 */
	public function destroy( $id ) {

		$book = Book::find( $id );
		if ( ! $book ) {
			$msg = 'Unable to delete book with id ' . $id . ' (book not found)';
			session()->flash( 'flash_warning', $msg );

			return;
		}

		try {
			$book->delete();
			session()->flash( 'flash_info', "Book '" . $book->title . "' was deleted." );
		} catch ( \Exception $e ) {

			if ( $e->getCode() == 23000 ) {
				$msg = "Unable to delete book '" . $book->title . "': the book is in use.";
			} else {
				$msg = $e->getMessage();
			}

			Log::error( $msg );
			session()->flash( 'flash_warning', $msg );
		}
	}
}
