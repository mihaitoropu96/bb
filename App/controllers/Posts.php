<?php

namespace App\Controllers;

use App\config\appconfig;
use App\Libraries\Controller;
use App\Tables\PostsTable;

class Posts extends Controller
{
    protected $postsTable;

	public function __construct()
	{
	    $this->postsTable = new PostsTable();
//		if (!\isLoggedIn()) {
//			redirect('users/login');
//		}

		$this->postModel = $this->model('Post');
		$this->userModel = $this->model('User');
	}

	public function index()
	{
        //dd(json_encode(appconfig::SERVICES));
		// Get posts
        try {
            $posts = $this->postsTable->find(2);
           // dd($posts);
            $data = [
                'posts' => $posts,
                'services' => appconfig::SERVICES
            ];
        } catch (\Exception $e) {
            $data['error_message'] = 'Post dosent have user';
        }

		$this->view('posts/index.html', $data);
	}

	public function add()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Sanitize the post
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title' => trim($_POST['title']),
				'body' => trim($_POST['body']),
				'user_id' => 'MIGUEL',
				'title_err' => '',
				'body_err' => '',
			];

			// Validate data
			if (empty($data['title'])) {
				$data['title_err'] = 'Please enter title';
			}
			if (empty($data['body'])) {
				$data['body_err'] = 'Please body text';
			}

			// Make sure no errors
			if (empty($data['title_err']) && empty($data['body_err'])) {
				// Validated
				if ($this->postModel->addPost($data)) {
					flash('post_message', 'Post added');
					redirect('posts');
				} else {
					die('Something went wrong');
				}
			} else {
				// Load the view with errors
				$this->view('posts/add', $data);
			}
		} else {
			$data = [
				'title' => '',
				'body' => '',
			];

			$this->view('posts/add', $data);
		}
	}

	public function show($id)
	{
		$post = $this->postModel->getPostById($id);
		$user = $this->userModel->getUserById($post->user_id);

		$data = [
			'post' => $post,
			'user' => $user,
		];

		$this->view('posts/show', $data);
	}

	public function edit($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Sanitize the post
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'id' => $id,
				'title' => trim($_POST['title']),
				'body' => trim($_POST['body']),
				'user_id' => $_SESSION['user_id'],
				'title_err' => '',
				'body_err' => '',
			];

			// Validate data
			if (empty($data['title'])) {
				$data['title_err'] = 'Please enter title';
			}
			if (empty($data['body'])) {
				$data['body_err'] = 'Please body text';
			}

			// Make sure no errors
			if (empty($data['title_err']) && empty($data['body_err'])) {
				// Validated
				if ($this->postModel->updatePost($data)) {
					flash('post_message', 'Post updated');
					redirect('posts');
				} else {
					die('Something went wrong');
				}
			} else {
				// Load the view with errors
				$this->view('posts/edit', $data);
			}
		} else {
			$post = $this->postModel->getPostById($id);

			// Check for owner
			if ($post->user_id != $_SESSION['user_id']) {
				redirect('posts');
			}
			$data = [
				'id' => $id,
				'title' => $post->title,
				'body' => $post->body,
			];

			$this->view('posts/edit', $data);
		}
	}

	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$post = $this->postModel->getPostById($id);

			// Check for owner
			if ($post->user_id != $_SESSION['user_id']) {
				redirect('posts');
			}

			if ($this->postModel->deletePost($id)) {
				flash('post_message', 'Post Removed');
				redirect('posts');
			} else {
				die('Something went wrong!');
			}
		} else {
			redirect('posts');
		}
	}
}

