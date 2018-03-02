<?php

$this->get( '/', 'Admin\BooksController@redirect' );

//$this->get( '/', function () {
//	return view( 'welcome' );
//} );

//Auth::routes();

//$this->get( '/home', 'HomeController@index' )->name( 'home' );

//$this->group( [ 'middleware' => [ 'auth' ], 'prefix' => 'admin', 'as' => 'admin.' ], function () {
//	$this->resource( 'books', 'Admin\BooksController' );
//} );

$this->group( [ 'prefix' => 'admin', 'as' => 'admin.' ], function () {
	$this->resource( 'books', 'Admin\BooksController' );

	$this->get( 'booksajax/datatable', 'Admin\BooksAjaxController@getDatatable' )->name( 'booksajaxdatatable' );
	$this->resource( 'booksajax', 'Admin\BooksAjaxController' );
} );