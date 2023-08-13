<?php

if (! function_exists('getPaginationLinks')) {
     function getPaginationLinks($data)
    {
        $links = [
            'items'     =>  $data->count(),
            'current_page'  =>  $data->currentPage(),
            'last_page' =>  $data->lastPage(),
            'next_page' =>  $data->nextPageUrl(),
            'per_page'  =>  $data->perPage(),
            'total'     =>  $data->total(),
        ];

        return $links;
    }
}
