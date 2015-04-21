<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 4;
	}
    
    public function load(ObjectManager $manager)
	{
        	$faker = \Faker\Factory::create('pl_PL');

        	for ($i = 0; $i < 500; $i++) {
        		$comment = new Comment();
                $comment->setContent($faker->text());
                $comment->setCreatedAt($faker->dateTimeThisYear($max = 'now'));
                $comment->setNbVoteUp(0);
                $comment->setNbVoteDown(0);
                $comment->setVerified(false);
        		$manager->persist($comment);
        	}
        	$manager->flush();
	}
}