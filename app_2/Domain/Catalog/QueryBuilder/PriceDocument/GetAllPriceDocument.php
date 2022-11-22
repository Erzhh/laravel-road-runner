<?php
namespace Domain\Catalog\QueryBuilder\PriceDocument;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\PriceDocumentQuery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllPriceDocument extends PriceDocumentQuery {

    public function __construct(
        private RequestParamsDTO $request,
    ){}

    public function run(): LengthAwarePaginator
    {
        $instance = $this->getModel()
                            ->newQuery()
                            ->with($this->request->include)
                            ->when($this->request->search != null,function ($q){
                                $search =  $this->request->search;
                                $q->where('number','like',"%$search%")
                                    ->orWhere('number','like',"$search")
                                    ->orWhere('user_name','like',"%$search%")
                                    ->orWhere('user_name','like',"$search");
                            })
                            ->when($this->request->sort,function($q){
                                $q->orderBy( $this->request->getSort()[0], $this->request->getSort()[1] );
                            })
                            ->orderBy('id','desc')
                            ->paginate($this->request->perPage);

        return $instance;

    }
}
