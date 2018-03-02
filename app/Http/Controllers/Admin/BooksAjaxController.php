<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BookAjax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BooksAjaxController extends Controller {

	/**
	 * Return DataTable ajax
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function getDatatable() {
		return DataTables::of( BookAjax::get() )
		                 ->escapeColumns( [ 'title', 'author', 'edition' ] )
		                 ->addColumn( 'actions', function ( $book ) {
			                 return $book->action_buttons;
		                 } )
		                 ->make( true );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index( Request $request ) {
		return view( 'admin.booksajax.index' );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return view( 'admin.booksajax.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store( Request $request ) {

		$requestData = $request->only( 'title', 'author', 'edition' );

		$validator = Validator::make( $requestData, [
			'title'   => 'required|max:100',
			'author'  => 'required|max:100',
			'edition' => 'required|max:100',
		] );

		if ( $validator->fails() ) {
			$msg = $validator->errors()->first();
			$request->session()->flash( 'flash_warning', $msg );

			return response()->json( [ 'status' => 422 ] );
		}

		$status = 200;
		try {
			BookAjax::create( $requestData );
			$msg = "Book '" . $requestData['title'] . "'' added.";
			$request->session()->flash( 'flash_success', $msg );
		} catch ( \Exception $e ) {
			if ( $e->getCode() == 23000 ) {
				$msg = 'the book already exists.';
			} else {
				$msg = $e->getMessage();
			}

			$msg    = "Unable to create book '" . $requestData['title'] . "': " . $msg;
			$status = 400;
			Log::error( $msg );
			$request->session()->flash( 'flash_warning', $msg );
		}

		return response()->json( [ 'status' => $status ] );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\View\View
	 */
	public function show( $id ) {
		$book = BookAjax::find( $id );

		if ( ! $book ) {
			return redirect()->route( 'admin.booksajax.index' )
			                 ->withFlashWarning( "Unable to show book: Book does not exist." );
		}

		return view( 'admin.booksajax.show', compact( 'book' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\View\View
	 */
	public function edit( $id ) {
		$book = BookAjax::find( $id );

		if ( ! $book ) {
			return redirect()->route( 'admin.booksajax.index' )
			                 ->withFlashWarning( "Unable to edit: Book does not exist." );
		}

		return view( 'admin.booksajax.edit', compact( 'book' ) );
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

		$book = BookAjax::find( $id );

		if ( ! $book ) {
			$msg = 'Unable to update book: Book does not exist.';
			$request->session()->flash( 'flash_warning', $msg );

			return response()->json( [ 'status' => 404 ] );
		}

		$requestData = $request->only( 'title', 'author', 'edition' );
		$validator   = Validator::make( $requestData, [
			'title'   => 'required|max:100',
			'author'  => 'required|max:100',
			'edition' => 'required|max:100',
		] );

		if ( $validator->fails() ) {
			$msg = $validator->errors()->first();
			$request->session()->flash( 'flash_warning', $msg );

			return response()->json( [ 'status' => 422 ] );
		}

		$status  = 200;
		$oldbook = clone $book;
		try {
			$book->update( $requestData );
			$msg = "Book '" . $oldbook->title . "'' updated.";
			$request->session()->flash( 'flash_success', $msg );
		} catch ( \Exception $e ) {
			if ( $e->getCode() == 23000 ) {
				$msg = 'the book already exists.';
			} else {
				$msg = $e->getMessage();
			}

			$msg = "Unable to update book '" . $oldbook->title . "': " . $msg;

			Log::error( $msg );
			$status  = 400;
			$request->session()->flash( 'flash_warning', $msg );
		}

		return response()->json( [ 'status' => $status ] );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return mixed
	 */
	public function destroy( $id ) {

		$book = BookAjax::find( $id );
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
