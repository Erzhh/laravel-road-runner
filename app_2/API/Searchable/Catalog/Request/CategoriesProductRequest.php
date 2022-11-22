<?php

namespace API\Searchable\Catalog\Request;

use Core\Request\BaseRequestParams;
use Domain\Catalog\Dto\ProductStockDto;
use Domain\Searchable\Catalog\Dto\CategoryProductDto;

class CategoriesProductRequest extends BaseRequestParams
{
    protected function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->merge( ['categories' => $this->query('categories')
                                                ?explode(',', $this->query('categories'))
                                                :[]
                        ] );
        $this->merge( ['search' => $this->query('search')] );
    }

    public function rules()
    {
        return [
            parent::rules(),
            'categories'   => ['array','nullable'],
            'categories.*'   => ['integer'],
            'search'   => ['nullable','string','min:3']
        ];
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getDto(): CategoryProductDto
    {
        return new CategoryProductDto([
            'categories' => $this->get('categories'),
            'search' => $this->get('search'),
        ]);
    }

}
