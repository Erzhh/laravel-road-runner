<?php

namespace API\Import\Requests;

use App\Domain\Catalog\Dto\CategoryDTO;
use Core\Request\BaseImportFormRequest;
use Domain\Catalog\Dto\ProductDetailDto;
use Domain\Catalog\Dto\ProductDto;
use Domain\Import\DTO\ProductMergeProductDetailDto;

class OneSImportProductRequest extends BaseImportFormRequest
{

    public function rules()
    {
        return [
            "type"=>"required|string",
            "data"=>"required",
            "data.id"   => 'required|string|max:255',
            "data.guid"   => 'required|uuid',
            'data.name'   => ['required','string','max:255'],
            'data.parent_id'   => ['required','string','max:255'],
            'data.parent_guid'   => ['required','uuid'],
            'data.fullname'   => ['required','string','max:255'],
            'data.name_kz'   => ['nullable','string','max:255'],
            'data.name_ru'   => ['required','string','max:255'],
            'data.vendor_code'   => ['nullable','string','max:255'],
            'data.description'   => ['nullable','string'],
            'data.status'   => ['required','boolean'],
        ];
    }

    public function getDto(){
        return new ProductMergeProductDetailDto([
            'product' => new ProductDto([
                                    'uid'=> $this->input('data.guid'),
                                    'name'=> $this->input('data.name'),
                                    'full_name'=> $this->input('data.fullname'),
                                    'code'=> $this->input('data.id'),
                                    'status'=>$this->input('data.status'),
                                ]),
            'product_detail'=> new ProductDetailDto([
                                    'product_uid'=>  $this->input('data.guid'),
                                    'name_kz'=>  $this->input('data.name_kz'),
                                    'name_ru'=>  $this->input('data.name_ru'),
                                    'description'=>  $this->input('data.description'),
                                    'article'=>  $this->input('data.vendor_code'),
                                ]),
            'parent_id'=>$this->input('data.parent_id'),
            'parent_uid'=>$this->input('data.parent_guid'),
        ]);
    }

}
