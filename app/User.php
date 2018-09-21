<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
  
class User extends Model {

	protected $table = 'user';
	protected $primaryKey = 'id';

	protected $fillable = ['*'];
	public $timestamps = false;
}
?>