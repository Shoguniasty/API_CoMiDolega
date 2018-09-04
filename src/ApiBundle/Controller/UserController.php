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
                return new JsonResponse([
                    'status' => false,
                    'hint' => 'User is exist!'
                ]);
            }

        }

        return new JsonResponse([
            'status' => false
        ]);
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

            if ($pass === $user->getPass()) {
                return new JsonResponse([
                    'status' => true,
                    'user' => [
                        'id' => $user->getId(),
                        'email' => $user->getEmail(),
                        'name' => $user->getName(),
                        'weight' => $user->getWeight(),
                        'height' => $user->getHeight()
                    ]
                ]);
            }else{
                return new JsonResponse([
                    'status' => false
                ]);
            }

        }

        return false;
    }

}



