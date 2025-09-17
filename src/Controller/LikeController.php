<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\UserArticleLike;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    #[Route('/like/{id}', name: 'post_like', methods: ['GET'])]
    public function like(Post $post): Response
    {
        $post->setLikesCount($post->getLikesCount() + 1);
        $like = new UserArticleLike();
        $like->setUser($this->getUser());
        $like->setPost($post);
        $this->em->persist($like);
        $this->em->flush();

        return $this->redirectToRoute('blog_post_show', [
'slug' => $post->getSlug()
]);
    }

    #[Route('/top', name: 'post_top', methods: ['GET'])]
    public function top(): Response
    {
        $top = $this->em->getRepository(Post::class)->findTop(20);

        return $this->render('blog/top.html.twig', [
'posts' => $top
]);
    }
}
