<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderFixtureInterface
{
	public function getOrder()
	{
		return 3;
	}
	public function load(ObjectManager $manager)
	{
		$faker = Faker\Factory::create('pl_PL');

		for ($i = 0; $i < 10; $i++) {
			$user = new User();
			$manager->persist($user);
		}
		$manager->flush();
	}
}