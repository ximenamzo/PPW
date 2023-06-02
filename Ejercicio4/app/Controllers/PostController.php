<?php

    namespace Controllers;

    use Models\posts;
    use Models\user;
    use Models\comments;
	use Models\interactions;

    use Controllers\auth\LoginController as LoginController;

    class PostController{
		private $userId;
		private $title;
		private $body;
		private $active=1;

		public function __construct(){
			$ua = new LoginController();
			$ua->sessionValidate();
			$this->userId = $ua->id;
		}

        public function getPost($limit="", $pid = ""){
			$posts = new posts();
			$resultP = $posts->select(['a.id', 'a.title', 'a.body', 'a.active',
									   'date_format(a.created_at,"%d/%m/%Y") as fecha', 
									   'b.name'])
						     ->join('user b', 'a.userId = b.id')
						     ->where($pid != "" ? [['a.id', $pid],['a.active', 1]] : [['a.active', 1]])
						     ->orderBy([['a.created_at', 'DESC']])
						     ->limit($limit)
						     ->get();
			if($pid!="" || $limit==1){
				$comments = new comments();
				$resultC = $comments->select(['id'])
									->count()
									->where([['postId',json_decode($resultP)[0]->id]])
									->get();
				$interacts = new interactions();
				$resultL = $interacts->select(['id'])
									 ->count()
									 ->where([['postId',json_decode($resultP)[0]->id],['tipo',1]])
									 ->get();
				$resultML = $interacts->select(['id'])
									  ->count()
									  ->where([['postId',json_decode($resultP)[0]->id],['tipo',1],
									  		   ['userId',$this->userId]])
									  ->get();
				$resultLo = $interacts->select(['id'])
									  ->count()
									  ->where([['postId',json_decode($resultP)[0]->id],['tipo',2]])
									  ->get();
				 $resultMLo = $interacts->select(['id'])
									   ->count()
									   ->where([['postId',json_decode($resultP)[0]->id],['tipo',2],
												  ['userId',$this->userId]])
									   ->get();
				$resultH = $interacts->select(['id'])
									  ->count()
									  ->where([['postId',json_decode($resultP)[0]->id],['tipo',3]])
									  ->get();
				 $resultMH = $interacts->select(['id'])
									   ->count()
									   ->where([['postId',json_decode($resultP)[0]->id],['tipo',3],
												  ['userId',$this->userId]])
									   ->get();
				$result = json_encode(array_merge(
							json_decode($resultP),
							json_decode($resultC),
							json_decode($resultL),
							json_decode($resultML),
							json_decode($resultLo),
							json_decode($resultMLo),
							json_decode($resultH),
							json_decode($resultMH)));
			}else{
				$result = $resultP;
			}
			return $result;
		}

		public function newPost($datos){
			$posts = new posts();
			$posts->valores = [$datos['uid'], $datos['title'], $datos['body']];
			$result=$posts->create();
			return;
			die;
		}

		public function editPost($datos){
			$posts = new posts();
			$posts->valores = ['userId'=>$datos['userId'], 
			                   'title'=>$datos['title'], 
							   'body'=>$datos['body']];
			$result=$posts->updatepost($datos['pid']);
			return;
			die;
		}

		public function getMyPosts($uid){
			$posts = new posts();
			$result = $posts->where([['userId', $this->userId]])
							->orderBy([['created_at', 'DESC']])
							->get();
			return $result;
		}

		public function togglePostActive($pid){
			$post = new posts();
			$result = $post->where([['id', $pid]])
						   ->update([['active', 'not active']]);
		}

		public function deletePost($limit="", $pid = ""){
			$posts = new posts();
			$result = $posts->where([['id', $pid]])
							->limit($limit)
							->delete();
			return $result;
			die;
		}

		public function getPostComments($pid){
            $comment = new comments();
            //$result = $comment->where([['postId', $pid]])->get();
			$result = $comment->select(['name', 'comment'])
							  ->where([['postId', $pid]])
							  ->orderBy([['created_at', 'DESC']])
							  ->get();
            return $result;
        }

		public function saveComment($datos){
			$comment = new comments();
			$user = new user();
			$u = $user->select(['name','email'])->where([['id',$this->userId]])->get();
			$u = json_decode($u);
			$comment->valores = [$datos['pid'],$u[0]->name,$u[0]->email,$datos['comment']];
			print_r($comment->create());
		}

		// I N T E R A C C I O N E S
		public function toggleInteraction($uid, $pid, $num){
			$like = new interactions();
			$like_exists = $like->select(['id', 'tipo'])
								->where([['postId',$pid],['userId',$uid]])
								->get();
			if(count(json_decode($like_exists)) == 0){
				$like->valores = [$uid,$pid,$num];
				$like->create();
			}else{
				$likeData = json_decode($like_exists)[0];
				$tipo = $likeData->tipo;
				if ($tipo != $num) {
					$like->where([['postId', $pid], ['userId', $uid]])->update([['tipo', $num]]);
				} else {
					$like->where([['postId', $pid], ['userId', $uid]])->delete();
				}
            }
			return $like->count()->where([['postId',$pid]])->get();
		}
    }