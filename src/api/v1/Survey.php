<?php

namespace app\api\v1;

use app\lib\Repository\AnswerOptions\AnswerOptions;
use app\lib\Repository\AnswerUsers\AnswerUsers;
use app\lib\Repository\Question\Question;
use app\lib\Repository\User\User;
use app\lib\Services\AnswerUsers\AnswerUsersServices;
use Laminas\Diactoros\Response;
use app\lib\Repository\Main;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Survey extends Main
{
    public function getQuestion(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        $question = (new Question())->getQuestions($params['sort']);
        $answer = (new AnswerOptions())->getAnswerOptions($question->getId());

        $response = new Response();
        $response->getBody()->write(json_encode([
            'question' => $question,
            'answer' => $answer
        ]));
        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);

    }

    public function saveUser(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $data = json_decode($request->getBody()->getContents(), true);
        $id = (new User())->saveUser($data['fio']);

        $response->getBody()->write(json_encode(['userId' => $id]));
        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
    }

    public function saveTest(ServerRequestInterface $request): ResponseInterface
    {
        $response = new Response();
        $data = json_decode($request->getBody()->getContents(), true);
        $id = (new AnswerUsers())->saveAnswerUsers($data);

        $response->getBody()->write(json_encode(['answerUserId' => $id]));
        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
    }

    public function getResultTest(): ResponseInterface
    {
        $response = new Response();
        $resultTest = (new AnswerUsersServices())->getResultTest();

        $response->getBody()->write(json_encode(['resultTest' => $resultTest]));
        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
    }
}