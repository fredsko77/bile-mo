<?php

namespace App\DataFixtures;

use App\Entity\ClientUser;
use App\Entity\Product;
use App\Entity\Specification;
use App\Entity\User;
use App\Traits\HelpersTrait;
use App\Traits\ServicesTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    use ServicesTrait;
    use HelpersTrait;

    /**
     * @var UserPasswordEncoderInterface $encoder
     */
    private $encoder;

    private const ROLES = [
        ['ROLE_ADMIN'],
        ['ROLE_ADMIN', 'ROLE_SUPER_ADMIN'],
        ['ROLE_CLIENT_ADMIN', 'ROLE_CLIENT_USER'],
        ['ROLE_CLIENT_USER'],
    ];

    private const SPECIFICATIONS = [
        'memory' => [16, 32, 64, 128, 256, 512],
        'os' => ['Light OS', 'Zeus OS', 'Door OS'],
        'color' => ['Blanc', 'Noir', 'Gris', 'Bleu Marine', 'Or', 'Rose'],
        'network' => ['4g', '5g', 'Bluetooth', 'Wifi', 'NFC', 'GPS'],
        'connectivity' => ['Usb Type-c', 'Prise Jack', 'Lightning'],
    ];

    private const BRANDS = [
        'LTE Phone',
        'Super Phone',
        'Top Phone',
        'Smartel',
        'Tel+',
        'Onyx',
        'Next',
        'Shadow',
        'AndroPhone',
        'Z Phone',
        'Smart Phone',
    ];

    private const MODELS = [
        'Nebula 1',
        'Nebula 2',
        'Nebula 2 Pro',
        'Nebula 1 E',
        'Galaxy 1',
        'Galaxy 2',
        'Galaxy 2 S',
        'Galaxy 2 Pro',
        'Astra I',
        'Astra I',
        'Astra II S',
        'Moon',
        'S',
        'Zen Flip',
        '8 Pro',
        '7 Pro',
        '9 Pro',
        'Shadow S',
    ];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        $faker->company();

        for ($i = 0; $i <= random_int(111, 144); $i++) {
            $user = new User;

            $role = random_int(0, 2);

            $user->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setCompany($faker->company)
                ->setRoles(self::ROLES[$role])
                ->setPassword($this->encoder->encodePassword($user, 'Bile-Mo-00'))
                ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                ->setRef($this->generateIdentifier("USR"))
            ;

            if ($i % random_int(1, 3)) {
                $user->setUpdatedAt($faker->dateTimeBetween('-6 months'));
            }

            $manager->persist($user);

            if ($role === 2) {

                for ($c = 0; $c < mt_rand(5, 78); $c++) {
                    $client = new ClientUser;

                    $client->setFirstname($faker->firstName)
                        ->setLastname($faker->lastName)
                        ->setEmail($faker->email)
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCompany($user->getCompany())
                        ->setUser($user)
                        ->setRef($this->generateIdentifier("CLT"))
                    ;

                    if ($c % random_int(1, 5)) {
                        $client->setUpdatedAt($faker->dateTimeBetween('-6 months'));
                    }

                    $manager->persist($client);
                }

            }

        }

        foreach (self::SPECIFICATIONS as $k => $specification) {
            $spec = new Specification;
            $spec->setType($k)
                ->setSpecs($specification)
            ;

            $manager->persist($spec);
        }

        for ($p = 0; $p <= random_int(628, 678); $p++) {
            $product = new Product;

            $product->setName(self::MODELS[random_int(0, (count(self::MODELS) - 1))])
                ->setPrice($faker->numberBetween(250, 1150))
                ->setDescription($faker->text(150))
                ->setBrand(self::BRANDS[random_int(0, (count(self::BRANDS) - 1))])
                ->setWeight($faker->numberBetween(150, 250))
                ->setOs(self::SPECIFICATIONS['os'][random_int(0, (count(self::SPECIFICATIONS['os']) - 1))])
                ->setMemory($this->pickOptions(self::SPECIFICATIONS['memory']))
                ->setColor($this->pickOptions(self::SPECIFICATIONS['color']))
                ->setScreen($faker->randomFloat(2, 5.4, 6.7))
                ->setStock($faker->numberBetween(0, 150))
                ->setNetwork($this->pickOptions(self::SPECIFICATIONS['network']))
                ->setConnectivity($this->pickOptions(self::SPECIFICATIONS['connectivity']))
                ->setRef($this->generateIdentifier("PDT"))
                ->setPhoto($faker->numberBetween(8, 48))
                ->setCreatedAt($faker->dateTimeBetween('-8 months'))
                ->setUpdatedAt($faker->dateTimeBetween('-6 months'))
            ;

            $manager->persist($product);
        }

        $manager->flush();
    }
}
