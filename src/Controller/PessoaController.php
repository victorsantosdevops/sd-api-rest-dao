<?php

namespace App\Controller;

use App\Entity\Telefone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pessoa;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class PessoaController extends AbstractController
{
    #[Route('/pessoa', name: 'app_pessoa',  methods: "POST")]
    public function createPerson(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $post_data = json_decode($request->getContent(), true);

        $entityManager = $doctrine->getManager();

        $pessoa = new Pessoa();
        $pessoa->setNome($post_data['nome']);
        $pessoa->setEmail($post_data['email']);
        $pessoa->setCodNac($post_data['codNac']);

        $telefone = new Telefone();
        $telefone->setNumero($post_data['telefone']);
        $entityManager->persist($telefone);

        $pessoa->setTelefone($telefone);
        $entityManager->persist($pessoa);
        $entityManager->flush();

        return $this->json([
            'message' => 'Nova pessoa cadastra com sucesso.',
            'id'    => $pessoa->getId()
        ]);
    }

    #[Route('/pessoa/{id}', name: 'get_pessoa',  methods: "GET")]
    public function getPerson(int $id, ManagerRegistry $doctrine): JsonResponse
    {
        $pessoa = $doctrine->getRepository(Pessoa::class)->find($id);

        if (!$pessoa) {
            $json_response = [
                'message' => 'Não foi encontrada uma pessoa com esse id: '.$id
            ];
        } else {
            $json_response = [
                'nome' => $pessoa->getNome(),
                'email' => $pessoa->getEmail(),
                'codNac' => $pessoa->getCodNac()
            ];
        }

        return $this->json([$json_response]);
    }

    #[Route('/pessoa/{id}', name: 'delete_pessoa',  methods: "DELETE")]
    public function deletePerson(int $id, ManagerRegistry $doctrine): JsonResponse
    {
        $pessoa = $doctrine->getRepository(Pessoa::class)->find($id);

        if (!$pessoa) {
            $json_response = [
                'message' => 'Não foi encontrada uma pessoa com esse id: '.$id
            ];
        } else {
            $nome = $pessoa->getNome();

            $entityManager = $doctrine->getManager();
            $entityManager->remove($pessoa);
            $entityManager->flush();

            $json_response = [
                'message' => 'Pessoa '.$nome."foi removido com sucesso!"
            ];
        }

        return $this->json([$json_response]);
    }

    #[Route('/pessoas', name: 'get_pessoas',  methods: "GET")]
    public function listPersons( ManagerRegistry $doctrine): JsonResponse
    {
        $pessoas = $doctrine->getRepository(Pessoa::class)->findAll();

        $pages_array[] =
        $lista_pessoas = [];

        foreach ($pessoas as $pessoa) {
            $nova_pessoa = array(
                'nome' => $pessoa->getNome(),
                'email' => $pessoa->getEmail(),
                'codNac' => $pessoa->getCodNac()
            );

            $lista_pessoas[] = (object) $nova_pessoa;

        }


        return new JsonResponse($lista_pessoas);
    }


}
