<?php
/**
 * Created by PhpStorm.
 * User: torop
 * Date: 9/22/2019
 * Time: 9:12 PM
 */

namespace App\Tables;


use App\Libraries\Database;
use App\Models\Post;
use App\Models\User;

class PostsTable extends BaseRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
        parent::__construct(Post::class, $this->db);
    }


    /**
     * @return Post[]
     */
    public function getPosts()
    {
        $this->db->query("SELECT *,
								  post.id as PostId,
								  user.id as UserId 
								  FROM post
								  INNER JOIN user
								  ON post.user_id = user.id
								  ORDER BY post.created_at DESC 
								  ");

        $results = $this->db->resultSet();
        $userTable = new UsersTable();


        $posts = [];
        foreach ($results as $result) {
            /** @var Post $post
             */
            $post = new Post();
            $user = new User();
            $post->setTitle($result->title);
            $post->setBody($result->body);
            $post->setCreatedAt($result->created_at);
            $id = (int)$result->user_id;
            $user = $userTable->getUserById(55);
            $post->setUser($user);
            $posts[] = $post;
        }

        return $posts;
    }

    public function addPost($data)
    {
        $columnsToInsert = [];
        $valuesToInsert = [];
        foreach ($data as $key => $column) {
            $columnsToInsert[] = $key;
            $valuesToInsert[] = $column;
        }
        $this->db->query(sprintf('INSERT INTO %s (%s) VALUES  (:%s)', 'posts', implode(',', $columnsToInsert), implode(',:', $valuesToInsert)));

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':created_at', new \DateTime());

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM post WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function updatePost($data)
    {

        $this->db->query('UPDATE post SET title = :title, body = :body WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM post WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}