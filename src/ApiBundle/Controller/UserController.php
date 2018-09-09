<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Usersapi;
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
class UserController extends FOSRestController
{
    /**
     * @Route("register/")
     * @Method({"POST"})
     * @param Request $request the request object
     */
    public function registerAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $json = $request->getContent();
            $json = json_decode($json);

            $name = $json->name;
            $email = $json->email;
            $pass = $json->pass;
            $weight = $json->weight;
            $height = $json->height;

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('AppBundle:Usersapi')->findOneBy([
                'email' => $email
            ]);

            if (!$user) {
                $newUser = new Usersapi();
                $newUser->setName($name);
                $newUser->setEmail($email);
                $newUser->setPass($pass);
                $newUser->setWeight($weight);
                $newUser->setHeight($height);

                $em->persist($newUser);
                $em->flush();

                return new JsonResponse([
                    'status' => true,
                    'user' => [
                        'id' => $newUser->getId(),
                        'email' => $newUser->getEmail(),
                        'name' => $newUser->getName(),
                        'weight' => $newUser->getWeight(),
                        'height' => $newUser->getHeight()
                    ]
                ]);
            }else{
                $response = new JsonResponse([
                    'status' => false,
                    'hint' => 'User is exist!'
                ]);

                $response->headers->set('Content-Type', 'application/json');
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

                return $response;

            }

        }

        $response = new JsonResponse([
            'status' => false
        ]);

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

        return $response;
    }

    /**
     * @Route("login/")
     * @Method({"POST"})
     * @param Request $request the request object
     */
    public function loginAction(Request $request)
    {
        if ($request->isMethod('post')) {

            $json = $request->getContent();
            $json = json_decode($json);

            $email = $json->email;
            $pass = $json->pass;

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('AppBundle:Usersapi')->findOneBy([
                'email' => $email
            ]);

            if ($pass == $user->getPass()) {
                $response = new JsonResponse([
                    'status' => true,
                    'user' => [
                        'id' => $user->getId(),
                        'email' => $user->getEmail(),
                        'name' => $user->getName(),
                        'weight' => $user->getWeight(),
                        'height' => $user->getHeight()
                    ]
                ]);

                $response->headers->set('Content-Type', 'application/json');
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

                return $response;

            }else{
                $response = new JsonResponse([
                    'status' => false
                ]);

                $response->headers->set('Content-Type', 'application/json');
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

                return $response;

            }

        }

        if ($request->isMethod('get')) {
            $response = new JsonResponse([
                'status' => false
            ]);

            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

            return $response;

        }
    }

}



