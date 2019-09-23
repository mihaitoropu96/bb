<?php


	class Pages extends \App\Libraries\Controller {


		public function __construct()
		{
			$this->postModel = $this->model('Post');
		}

		public function index()
		{
			if (isLoggedIn()) {
				redirect('posts');
			}

			$posts = $this->postModel->getPosts();
			$data = [
				'title' => 'Welcome',
				'posts' => $posts,
			];

			$this->view('pages/index', $data);
		}

		public function about()
		{
			$this->view('pages/about', ['title' => 'About Us']);
		}
	}