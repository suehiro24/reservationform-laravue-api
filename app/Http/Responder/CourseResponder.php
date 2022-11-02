<?php

namespace App\Http\Responder;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use RsvForm\Domain\Models\Course\Course;
use RsvForm\Presentation\CourseJsonSerializer;

class CourseResponder
{
    /**
     * @var CourseJsonSerializer
     */
    private $serializer;

    /**
     * @param  CourseJsonSerializer  $serializer
     */
    public function __construct(CourseJsonSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * エンティティでレスポンス
     *
     * @param  Course  $course
     * @param  int  $status
     * @return JsonResponse
     */
    public function withEntity(Course $course, $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            [
                'course' => $this->serializer->serialize($course),
            ],
            $status
        );
    }

    /**
     * エンティティのコレクションでレスポンス
     *
     * @param  Collection|Course[]  $courses
     * @param  int  $status
     * @return JsonResponse
     */
    public function withEntityCollection(Collection $courses, $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            [
                'courses' => $this->serializer->serializeCollection($courses),
            ],
            $status
        );
    }

    /**
     * エラーのレスポンス
     *
     * @param  Exception  $e
     * @param  int  $status
     * @return JsonResponse
     */
    public function error(Exception $e, $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ],
            $status
        );
    }
}
