<?php

namespace API\Import\Requests;

use App\Domain\Catalog\Dto\CategoryDTO;
use Core\Request\BaseImportFormRequest;

class OnesImportCategoriesRequest extends BaseImportFormRequest
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
            'data.status'   => ['required','boolean'],
        ];
    }

    public function getDto(){
        return new  CategoryDTO([
            'id'          => $this->input('data.id'),
            'guid'   => $this->input('data.guid'),
            'name'      => $this->input('data.name'),
            'parent_id'          => $this->input('data.parent_id'),
            'parent_guid'          => $this->input('data.parent_guid'),
            'status'          => $this->input('data.status'),
        ]);
    }

}
