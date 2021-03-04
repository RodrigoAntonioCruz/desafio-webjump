<?php
 
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Dashboard extends Controller
{
	public function __construct(Request $request, Response $response)
	{
		parent::__construct($request, $response);
	}

    public function index()
    {
        $pageContent = file_get_contents('../resources/views/dashboard.html');

        $this->response->setContent($pageContent);
        $this->response->send();
    }
}