<?php
	/*
	 *
	 * Base controller
	 * Loads the models and views
	 */
namespace App\Libraries;

	use Twig\Error\LoaderError;
    use Twig\Error\RuntimeError;
    use Twig\Error\SyntaxError;

    class Controller {
		// Load model
		public function model($model)
		{

//			require_once '../App/models/' . $model . '.php';

            $model = 'App\Models\\' . $model;

			return new $model();
		}

		// Load view
		public function view($view, $data = [])
		{
            $loader = new \Twig\Loader\FilesystemLoader('../app/views/');
            $twig = new \Twig\Environment($loader);

            try {
                echo $twig->render($view, $data);
            } catch (\Exception $e) {
                var_dump($e);
                die();
            }
        }
	}