<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'books', function ( Blueprint $table ) {
			$table->increments( 'id' );
//			$table->text( 'content' );
			$table->string( 'title', 100 );
			$table->string( 'author', 100 );
			$table->string( 'edition', 100 );
			$table->timestamps();

			$table->unique(array('title', 'author', 'edition'));
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'books' );
	}
}
