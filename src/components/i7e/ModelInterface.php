<?php

namespace components\i7e;

interface ModelInterface
{

    public  function getList(
        $select = [],
        $conditions = [],
        $order = null,
        $limit = null
    );
    public  function getOne();
    public  function create($date);
    public  function update($date);
    public  function delete();


}