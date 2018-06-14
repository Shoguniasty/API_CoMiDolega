<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Admin controller.
 * @Security("has_role('ROLE_ADMIN')")
 * @Route("admin/")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_page")
     */
    public function indexAction(Request $request)
    {
        die();
    }
}
