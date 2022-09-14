<?php

namespace App\Packages\Quiz\Question\Domain\Repository;

use App\Packages\Base\Domain\Repository\Repository;
use App\Packages\Doctrine\Extension\Query\Postgresql\Random;
use App\Packages\Quiz\Question\Domain\Model\Question;
use Doctrine\ORM\Query\Expr;

class QuestionRepository extends Repository
{
    protected string $entityName = Question::class;

    public function findOneByNameAndSubjectName(string $name, string $subjectName): ?Question
    {
        $queryBuilder = $this->createQueryBuilder('question');
        $queryBuilder
            ->join('question.subject', 'subject', Expr\Join::WITH, 'subject.name = :subjectName')
            ->where('question.name = :name')
            ->setParameters([
                'name' => $name,
                'subjectName' => $subjectName,
            ])
            ->setMaxResults(1);
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function getRandomQuestions(int $limit): array
    {
        $queryBuilder = $this->createQueryBuilder('question');
        $queryBuilder
            ->orderBy('RANDOM()')
            ->setMaxResults($limit);
        return $queryBuilder->getQuery()->getResult();
    }
}
