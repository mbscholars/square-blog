<?php


function  cached_url_identifier($id = "blog")
{
    $requests = request()->query();

    /** Preserve order by sorting request*/
    arsort($requests);

    if (empty($requests)) {
        return $id;
    }

    foreach ($requests as $key => $value) {
        $id .= "_{$key}_{$value}";
    }

    return  $id;
}

function appendSortQuery($key)
{
    $query = request()->query();
    $order = request('order');
    $query['sort'] = $key;
    $query['order'] = $order == 'desc' ? 'asc' : 'desc';
    return  $query;
}
