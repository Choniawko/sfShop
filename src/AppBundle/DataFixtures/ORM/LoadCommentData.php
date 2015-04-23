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
                $comment->setNbVoteUp($faker->numberBetween(1, 30));
                $comment->setNbVoteDown($faker->numberBetween(1, 30));
                $comment->setProduct($this->getReference('product' . $faker->numberBetween(0, 199)));
                $comment->setUser($this->getReference('user' . $faker->numberBetween(0, 11)));
                $comment->setVerified(true);
        		$manager->persist($comment);
        	}
        	$manager->flush();
	}
}