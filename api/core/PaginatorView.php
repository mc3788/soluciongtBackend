<?php

use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginator;

class PaginatorView extends LengthAwarePaginator{

	public function toArray()
	{
//		return parent::toArray();
		return [
			'current_page' => $this->currentPage(),
			'from' => $this->firstItem(),
			'last_page' => $this->lastPage(),
			'per_page' => $this->perPage(),
			'to' => $this->lastItem(),
			'total' => $this->total(),
	        'data' => new \Illuminate\Database\Eloquent\Collection( $this->getCollection())
		];
	}




}