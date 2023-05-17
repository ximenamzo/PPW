<?php

    namespace Controllers;

    use Models\posts;
    use Controllers\auth\LoginController as LoginController;

    class PostController{
		private $userId;
		private $title;
		private $body;

		public function __construct(){
			$ua = new LoginController();
			$ua->sessionValidate();
			$this->userId = $ua->id;
		}

        public function getPost($limit="", $pid = ""){
			$posts = new posts();
			$result = $posts->select(['a.id', 'a.title', 'a.body', 'date_format(a.created_at,"%d/%m/%Y") as fecha', 'b.name'])
						    ->join('user b', 'a.userId = b.id')
						    ->where($pid != "" ? [['a.id', $pid]] : [])
						    ->orderBy([['a.created_at', 'DESC']])
						    ->limit($limit)
						    ->get();
            return $result;
		}

		public function newPost($datos){
			$posts = new posts();
			$posts->valores = [$datos['uid'], $datos['title'], $datos['body']];
			$result=$posts->create();
			return;
			die;
		}

		public function getMyPosts($uid){
			$posts = new posts();
			$result = $posts->where([['userId', $this->userId]])->get();
			return $result;
		}

		public function deletePost($limit="", $pid = ""){
			$posts = new posts();
			$result = $posts->where([['id', $pid]])
							->limit($limit)
							->delete();
			return $result;
			die;
		}

    }