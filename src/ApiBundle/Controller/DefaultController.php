<?php

namespace ApiBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/")
 */
class DefaultController extends FOSRestController
{
    /**
     * @Route("health/")
     * @Method({"GET", "POST"})
     * @param Request $request the request object
     */
    public function symptomsAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $json = $request->getContent();
            $json = json_decode($json);

            if ($json->user_id) {
                return new JsonResponse($this->generateResult());
            }else{
                return new JsonResponse([
                    'status' => false
                ]);
            }
        }

        if ($request->isMethod('get')) {

            $arr['symptoms'] = $this->generateSymptoms();
            $arr['polling'] = $this->generatePolling();

            $response = new JsonResponse($arr);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', 'http://comidolega.net');
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

            return $response;
        }
    }

    private function checkSymptoms($json)
    {
        // @todo
    }

    private function checkBmi($height, $weight)
    {
        $height = 178;
        $weight = 86;
        $bmi = $weight / ($height * $height);
        $bmi = $bmi * 10000;

        $msg = '';

        if ($bmi < "16") {
            $msg = "Jesteś wygłodzony.";
        } else if ($bmi > "16" && $bmi < "17") {
            $msg = "Jesteś wychudzony.";
        } else if ($bmi > "17.01" && $bmi < "18.5") {
            $msg = "Masz niedowagę.";
        } else if ($bmi > "18.51" && $bmi < "25") {
            $msg = "Twoja waga jest prawidłowa.";
        } else if ($bmi > "25.01" && $bmi < "30") {
            $msg = "Masz nadwagę.";
        } else if ($bmi > "30.01" && $bmi < "35") {
            $msg = "Masz otyłość I stopnia.";
        } else if ($bmi > "35.01" && $bmi < "40") {
            $msg = "Masz otyłość II stopnia.";
        } else {
            $msg = "Masz otyłość III stopnia";
        }

        $arr = [
            'bmi' => $bmi,
            'msg' => $msg
        ];

        return $arr;
    }

    private function generatePolling()
    {
        $em = $this->getDoctrine()->getManager();
        $pooling = $em->getRepository('AppBundle:Polling')->findAll();

        $arr = [];

        foreach ($pooling as $pool) {
            $arr[] =
                [
                    'id' => $pool->getId(),
                    'question' => $pool->getQuestion(),
                    'a' => $pool->getAnswerA(),
                    'b' => $pool->getAnswerB(),
                    'c' => $pool->getAnswerC(),
                    'd' => $pool->getAnswerD(),
                ];
        }

        return $arr;
    }

    private function generateSymptoms()
    {
        $em = $this->getDoctrine()->getManager();
        $symptoms = $em->getRepository('AppBundle:Symptoms')->findAll();

        $arr = [];

        foreach ($symptoms as $symptom) {
            $arr[] =
                [
                    'id' => $symptom->getId(),
                    'name' => $symptom->getName(),
                ];
        }

        return $arr;
    }

    private function generateResult()
    {
        return [
            'status' => true,
            'result' => 'Chora głowa, niestety brak możliwości wyleczenia ALE podsuwamy ci propozycję placówek w okolicy',
            'hint' => 'Śpij więcej, uprawiaj sport itd',
            'doctors' => [
                [
                    'name' => 'Doktor jakistam',
                    'street' => 'Jakastam 15',
                    'code' => '31-150',
                    'city' => 'Krakow'
                ]
            ]
        ];
    }
}



