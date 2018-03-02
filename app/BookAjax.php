<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAjax extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookajax';

	/**
	 * The database primary key value.
	 *
	 * @var string
	 */
//    protected $primaryKey = 'id';

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'title', 'author', 'edition' ];

	public function getViewButtonAttribute() {
		return '<a href="' . route( 'admin.booksajax.show', $this ) . '" class="btn btn-info btn-sm"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>';
	}

	public function getEditButtonAttribute() {
		return '<a href="' . route( 'admin.booksajax.edit', $this ) . '" class="btn btn-primary btn-sm"><i class="fa fa-pen-square" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>';
	}

	public function getDeleteButtonAttribute() {
		return '<a href="' . route( 'admin.booksajax.destroy', $this ) . '"
                 data-method="delete"  
                 data-trans-title="Are you sure you want to delete book:"     
                 data-trans-text="' . $this->title . '"
                 class="btn btn-sm btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>';
	}

	public function getActionButtonsAttribute() {
		return $this->view_button . '&nbsp;' . $this->edit_button . '&nbsp;' . $this->delete_button;
	}

}
