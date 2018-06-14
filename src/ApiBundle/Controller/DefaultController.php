<?php

namespace ApiBundle\Controller;

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
     * @Route("symptoms/")
     * @Method({"GET", "POST"})
     * @param Request $request the request object
     */
    public function symptomsAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $json = $request->getContent();
            $json = json_decode($json);

            dump($json);
            die();

//            foreach ($json->symptoms as $symptom) {
//                dump($symptom);
//            }

            return new JsonResponse(array('zdrowie' => ''));

        }

        if ($request->isMethod('get')) {

            $view = ['costam'];
            return new JsonResponse(array('name' => 'MyName'));
        }

        die();
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
        echo "Twoje BMI wynosi $bmi.<br>";
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

        return $msg;
    }
}



