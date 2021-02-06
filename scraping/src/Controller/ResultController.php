<?php


class ResultController extends AbstractController
{
    public function showAll(Historic $historic)
    {
        $manager = new ResultModel();
        $results = $manager->getListResult($historic);
        echo $this->twig->render('admin/historic/single-historic.html.twig', [
            'results' => $results,
        ]);
    }
}