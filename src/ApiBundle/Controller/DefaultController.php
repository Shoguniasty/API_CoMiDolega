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

            return new JsonResponse($this->generateResult());
        }

        if ($request->isMethod('get')) {

            $arr['yourData'] = $this->generateYourData();
            $arr['symptoms'] = $this->generateSymptoms();
            $arr['polling'] = $this->generatePolling();

            return new JsonResponse($arr);
        }

        return true;
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
                    'answerA' => $pool->getAnswerA(),
                    'answerB' => $pool->getAnswerB(),
                    'answerC' => $pool->getAnswerC(),
                    'answerD' => $pool->getAnswerD(),
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

    private function generateYourData()
    {
        $arr = [
            'firstName' => 'Your Name',
            'weight' => 'kg',
            'heigth' => 'cm',
            'gender' => 'male/female',
        ];

        return $arr;
    }

    private function generateResult()
    {
        $result['disease'] = [
            [
                'diagnosis' => 'Grypa',
                'desc' => 'Czym jest grypa? to ble ble ble ble ble'
            ]
        ];

        $result['hints'] = [
            [
                'hint' => 'super super super',
                'level' => 1,
                'txt' => 'Łosz kurwa masakra z tobą!'
            ]
        ];

        $result['summary'] = [
            'score' => 65,
            'healthState' => 'Dobry',
            'bmi' => 27,
            'bmiMessage' => 'costam costam'
        ];

        return $result;
    }
}



