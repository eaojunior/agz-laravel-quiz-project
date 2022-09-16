<?php

namespace App\Packages\Quiz\Facade;

use App\Packages\Quiz\Domain\DTO\QuizDto;
use App\Packages\Quiz\Domain\Model\Quiz;
use App\Packages\Quiz\Exception\QuizNotFinishedException;
use App\Packages\Quiz\Question\Facade\QuestionFacade;
use App\Packages\Quiz\Subject\Facade\SubjectFacade;
use App\Packages\Student\Domain\Model\Student;

class QuizFacade
{
    public function __construct(
        private QuizRepository $quizRepository,
        private QuestionFacade $questionFacade,
        private SubjectFacade $subjectFacade,
    ) {}

    public function create(Student $student): QuizDto
    {
        $this->throwExceptionIfStudentHasOpenedQuiz($student);
        $subject = $this->subjectFacade->getRandomSubject();
        $quiz = $this->generateQuiz($student, $subject->getName());
        $questions = $this->questionFacade->getRandomQuestionsBySubjectAndTotalQuestions(
            $subject->getName(), $quiz->getTotalQuestions()
        );

        $quizDto = new QuizDto();
        $quizDto->setId($quiz->getId())
            ->setStudent($student)
            ->setSubjectName($subject->getName())
            ->setTotalQuestions($quiz->getTotalQuestions())
            ->setQuestions($questions);

        return $quizDto;
    }

    private function throwExceptionIfStudentHasOpenedQuiz(Student $student): void
    {
        $quiz = $this->quizRepository->findOneByStudentAndStatus($student, Quiz::OPENED);
        if ($quiz instanceof Quiz) {
            throw new QuizNotFinishedException("Please finish OPENED quiz before creating a new one!");
        }
    }

    public static function generateTotalQuestions(): int
    {
        return rand(1, 10);
    }

    private function generateQuiz(Student $student, string $subjectName): Quiz
    {
        $totalQuestions = self::generateTotalQuestions();
        $quiz = new Quiz($student, $subjectName, $totalQuestions);
        $this->quizRepository->add($quiz);

        return $quiz;
    }
}
