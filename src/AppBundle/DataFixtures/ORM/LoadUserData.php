<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\User;


class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 3;
	}
	public function load(ObjectManager $manager)
	{
		$faker = \Faker\Factory::create('pl_PL');

		for ($i = 0; $i < 10; $i++) {
			$user = new User();
			$user->setUsername($faker->userName());
            $user->setEmail($faker->email());
            $user->setPlainPassword('demo');
            $user->setEnabled(true);
            $this->addReference('user'. $i, $user);
			$manager->persist($user);

			
		}
		$admin = new User();
		$admin->setUsername('admin');
		$admin->setEmail('admin@admin');
		$admin->setPlainPassword('admin');
        $admin->setEnabled(true);
        $admin->setRoles(array('ROLE_ADMIN'));
        $this->addReference('user'. 10, $admin);
        $manager->persist($admin);

        $userUser = new User();
		$userUser->setUsername('user');
		$userUser->setEmail('user@user');
		$userUser->setPlainPassword('user');
        $userUser->setEnabled(true);
        $userUser->setRoles(array('ROLE_USER'));
        $this->addReference('user'. 11, $userUser);
        $manager->persist($userUser);


		$manager->flush();
	}
}