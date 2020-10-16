<?php


namespace DocRep;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class FotoVal
 * @package App/Entity
 * @ORM\Table(name="fotos")
 * @ORM\Entity()
 */

class FotoVal
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */

    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $p_id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $path;

}