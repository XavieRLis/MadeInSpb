<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Person;
use BW\Vkontakte;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class VKLinkToMemberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Person|null $person
     * @return string
     */
    public function transform($person)
    {
        if (null === $person) {
            return '';
        }

        return $person->getVkId();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $vkLink
     * @return Person|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($vkLink)
    {
        $vkAPI = new Vkontakte([
            'client_id' => '5513448',
            'client_secret' => 'ldSBVOfJVgP7VIRpcdEq',
        ]);
        // no issue number? It's optional, so that's ok
        if (!$vkLink) {
            return null;
        }
        $vkId = str_replace('http://vk.com/', '', $vkLink);
        $vkId = str_replace('https://vk.com/', '', $vkId);
        $user = $vkAPI->api('users.get', [
            'user_ids' => $vkId,
            'lang' => 'ru'
        ]);
        $person = $this->manager
            ->getRepository('AppBundle:Person')
            // query for the issue with this id
            ->findOneBy(array('vkId'=>$user[0]['id']))
        ;

        if (null === $person) {
            $person = new Person();
            $person->setFirstName($user[0]['first_name']);
            $person->setLastName($user[0]['last_name']);
            $person->setVkId($user[0]['id']);
        }

        return $person;
    }
}