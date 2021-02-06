<?php


class ResultController extends AbstractController
{
    public function _getList(Historic $historic)
    {
        $manager = new ResultModel();
        $results = $manager->getListResult($historic);
        return $results;
    }
}