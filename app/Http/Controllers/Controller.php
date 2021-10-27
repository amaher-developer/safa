<?php

namespace App\Http\Controllers;

use App\Safa\Interfaces\Resources\ResourceInterface;
use App\Safa\Mappers\RepositoryMapper;
use App\Safa\Classes\Constants;
use App\Safa\Interfaces\Classes\ParseInterface;
use App\Safa\Interfaces\Validators\ValidatorInterface;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function items(ParseInterface $parse, ValidatorInterface $validator, ResourceInterface $resource){
        $response['data'] = [];
        if ($this->validateInputs($validator)) {
            $url = Constants::GITHUB_URL.'?'.$this->queryInputs($validator, $resource);
            $result = $parse->output($url);
            $response['data']['items'] = RepositoryMapper::collection($result->items);
            return response()->json($response, 200);
        }
        return response()->json($response, 400);
    }

    private function queryInputs($validator, $resource){
        $q = '';
        if($validator->has(['q'])){
            $q.= '&q='.$resource->get('q');
        }
        if($validator->has(['sort'])){
            $q.= '&sort='.$resource->get('sort');
        }
        if($validator->has(['order'])){
            $q.= '&order='.$resource->get('order');
        }
        if($validator->has(['per_page'])){
            $q.= '&per_page='.$resource->get('per_page');
        }
        if($validator->has(['page'])){
            $q.= '&page='.$resource->get('page');
        }
        return trim($q, '&');
    }

    private function validateInputs($validator)
    {
        if($validator->required(['q'])->string(['sort', 'order', 'per_page', 'page']))
            return true;
        return false;
    }

}
