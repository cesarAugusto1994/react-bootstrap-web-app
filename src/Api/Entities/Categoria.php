<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 05/09/16
 * Time: 09:19
 */

namespace Api\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Categoria
 * @package Api\Entities
 * @ORM\Table(name="categoria", options={"collate":"utf8_general_ci", "charset":"utf8"})
 * @ORM\Entity(repositoryClass="Api\Repositories\CategoriaRepository")
 */
class Categoria implements \JsonSerializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Api\Entities\Colecao", inversedBy="categorias")
     * @ORM\JoinColumn(referencedColumnName="id", name="colecao_id")
     * @var Colecao
     */
    private $colecao;

    /**
     * @ORM\Column(name="nome", type="string")
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(name="ativo", type="smallint")
     * @var int
     */
    private $ativo;

    public function __construct($nome, Colecao $colecao)
    {
        $this->nome = $nome;
        $this->colecao = $colecao;
        $colecao->setCategoria($this);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Colecao
     */
    public function getColecao()
    {
        return $this->colecao;
    }

    /**
     * @param Colecao $colecao
     */
    public function setColecao($colecao)
    {
        $this->colecao = $colecao;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return int
     */
    public function isAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
    
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "ativo" => $this->ativo
        ];
    }
}