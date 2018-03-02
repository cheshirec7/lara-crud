<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookAjaxTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'bookajax', function ( Blueprint $table ) {
			$table->increments( 'id' );
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
		Schema::drop( 'bookajax' );
	}
}
