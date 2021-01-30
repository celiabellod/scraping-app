<?php


class HistoricController {

    public function newScraping(Extraction $extraction) {

        $client = \Symfony\Component\Panther\Client::createChromeClient();

        $client->request('GET', $extraction->getDataPath());

        $crawler = $client->waitFor($extraction->getPrimaryContainer());
        $crawler->filter($extraction->getDataPath())->text();

        //enregistree les données recu en db
        //faire passer un objet d'un page a une autre
        $screenshot = $client->takeScreenshot('screen.png');
    }
}